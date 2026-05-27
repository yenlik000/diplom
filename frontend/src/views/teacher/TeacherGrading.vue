<template>
  <TeacherLayout>

    <!-- Search bar in header -->
    <template #header-left>
      <div class="header-search">
        <i class="pi pi-search" style="color:#9ca3af;font-size:.85rem;flex-shrink:0;"></i>
        <input v-model="search" type="text" placeholder="Search students or courses..." class="header-search-input" />
      </div>
    </template>

    <!-- Page title + subtitle -->
    <div class="flex items-start justify-between mb-6">
      <div>
        <h1 class="queue-title">{{ t('teacher.gradingQueue') }}</h1>
        <p class="queue-sub">
          You have <strong>{{ submissions.length }}</strong>
          assignment{{ submissions.length !== 1 ? 's' : '' }} awaiting evaluation
          across {{ courseCount }} course{{ courseCount !== 1 ? 's' : '' }}.
        </p>
      </div>
      <div class="flex gap-2">
        <div class="relative">
          <button class="ctrl-btn" @click="filterOpen = !filterOpen">
            <i class="pi pi-filter" style="font-size:.8rem;"></i> {{ t('teacher.filter') }}
          </button>
          <div v-if="filterOpen" class="dropdown" @mouseleave="filterOpen = false">
            <button class="dropdown-item" :class="{ 'dropdown-item--active': activeCourse === null }"
                    @click="activeCourse = null; filterOpen = false">{{ t('teacher.allCourses') }}</button>
            <button v-for="c in courses" :key="c.id"
                    class="dropdown-item" :class="{ 'dropdown-item--active': activeCourse === c.id }"
                    @click="activeCourse = c.id; filterOpen = false">{{ c.title }}</button>
          </div>
        </div>
        <button class="ctrl-btn" @click="cycleSortOrder">
          <i class="pi pi-sort-alt" style="font-size:.8rem;"></i> {{ t('teacher.sort') }}: {{ sortLabel }}
        </button>
      </div>
    </div>

    <!-- Loading -->
    <div v-if="loading" class="flex flex-col gap-3 mb-6">
      <div v-for="i in 3" :key="i"
           class="animate-pulse bg-white rounded-2xl"
           style="height:100px;border:1px solid #e5e7eb;"></div>
    </div>

    <!-- Empty state -->
    <div v-else-if="sorted.length === 0"
         class="flex flex-col items-center justify-center py-20 bg-white rounded-2xl mb-6"
         style="border:1px solid #e5e7eb;">
      <i class="pi pi-check-circle" style="font-size:3rem;color:#10b981;display:block;margin-bottom:12px;"></i>
      <p class="font-semibold" style="color:#111827;">{{ t('teacher.allCaughtUp') }}</p>
      <p class="text-sm mt-1" style="color:#9ca3af;">{{ t('teacher.noPendingSubmissions') }}</p>
    </div>

    <!-- Submission cards -->
    <div v-else class="flex flex-col gap-3 mb-6">
      <div v-for="item in visible" :key="item.id" class="sub-card"
           @click="router.push(`/teacher/grading/${item.id}`)">

        <!-- Avatar -->
        <div class="sub-avatar" :style="{ background: item.color }">{{ item.initials }}</div>

        <!-- Info -->
        <div class="flex-1 min-w-0">
          <div class="flex items-center gap-2 mb-1 flex-wrap">
            <span class="font-bold" style="font-size:1rem;color:#111827;">{{ item.student_name }}</span>
            <span class="course-tag"
                  :style="{ background: item.tagBg, color: item.tagColor }">
              {{ item.course_title }}
            </span>
          </div>
          <p class="text-sm font-medium mb-2" style="color:#374151;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:480px;">
            {{ item.homework_title || 'Assignment' }}
          </p>
          <div class="flex items-center gap-5 text-xs" style="color:#9ca3af;">
            <span class="flex items-center gap-1">
              <i class="pi pi-clock"></i>
              Submitted {{ formatAgo(item.hours_ago) }}
            </span>
            <span class="flex items-center gap-1">
              <i class="pi pi-paperclip"></i>
              {{ fileNameFor(item) }}
            </span>
          </div>
        </div>

        <!-- Status + action -->
        <div class="flex items-center gap-5 flex-shrink-0" @click.stop>
          <div class="flex items-center gap-1.5">
            <span class="pending-dot"></span>
            <span class="text-sm font-medium" style="color:#374151;">{{ t('teacher.pending') }}</span>
          </div>
          <button class="grade-btn" @click="router.push(`/teacher/grading/${item.id}`)">
            {{ t('teacher.gradeNow') }} <i class="pi pi-arrow-right" style="font-size:.72rem;"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Load more -->
    <div v-if="sorted.length > visible.length" class="flex justify-center mb-6">
      <button class="load-more-btn" @click="pageSize += 10">
        Load {{ Math.min(10, sorted.length - visible.length) }} More
        <i class="pi pi-chevron-down" style="font-size:.75rem;"></i>
      </button>
    </div>

    <!-- Bottom row -->
    <div class="flex gap-5">

      <!-- Queue Efficiency -->
      <div class="bg-white rounded-2xl p-6 flex-1" style="border:1px solid #e5e7eb;">
        <h4 class="font-bold mb-1" style="color:#111827;font-size:1rem;margin:0;">{{ t('teacher.queueEfficiency') }}</h4>
        <p class="text-sm mt-1 mb-5" style="color:#6b7280;">{{ efficiencyText }}</p>
        <!-- Bar chart -->
        <div class="flex items-end gap-2" style="height:90px;">
          <div v-for="(bar, i) in chartBars" :key="i"
               class="flex-1 rounded-t-lg"
               :title="`${dayLabels[i]}: ${bar.count} graded`"
               :style="{ height: bar.h + '%', background: bar.color, transition: `height .4s ease ${i * 0.05}s`, cursor: 'default' }">
          </div>
        </div>
        <!-- Day labels -->
        <div class="flex gap-2 mt-1">
          <div v-for="(label, i) in dayLabels" :key="i"
               class="flex-1 text-center"
               style="font-size:.65rem;color:#9ca3af;">{{ label }}</div>
        </div>
      </div>

      <!-- Smart Assistant -->
      <div class="smart-card" style="width:260px;flex-shrink:0;">
        <div class="smart-sparkles">
          <span>✦</span><span style="font-size:1.5rem;line-height:1;">✦</span><span>✦</span>
        </div>
        <h4 class="font-bold text-white mb-2 text-center" style="font-size:1rem;margin:0;">{{ t('teacher.smartAssistant') }}</h4>
        <p class="text-sm text-center mb-5" style="color:rgba(255,255,255,.8);line-height:1.5;margin:.5rem 0 1.25rem;">
          AI-suggested rubrics are available for
          <strong>{{ submissions.length }}</strong> pending assignments.
        </p>
        <button class="smart-btn" @click="router.push(`/teacher/grading/${sorted[0]?.id}`)">
          {{ t('teacher.viewSuggestions') }}
        </button>
      </div>

    </div>

  </TeacherLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import TeacherLayout from '@/components/teacher/TeacherLayout.vue'
import { teacherApi } from '@/api'

const { t } = useI18n()

const router = useRouter()

const loading      = ref(true)
const submissions  = ref([])
const courses      = ref([])
const activeCourse = ref(null)
const sortOrder    = ref('newest')
const pageSize     = ref(10)
const search       = ref('')
const filterOpen   = ref(false)

// ── Tag colors (consistent per course) ───────────────────────
const TAG_PALETTES = [
  { bg: '#f0f4ff', color: '#3730a3' },
  { bg: '#fdf2f8', color: '#9d174d' },
  { bg: '#f0fdfa', color: '#0f766e' },
  { bg: '#fff7ed', color: '#c2410c' },
  { bg: '#f5f3ff', color: '#6d28d9' },
  { bg: '#fef9c3', color: '#854d0e' },
  { bg: '#f0fdf4', color: '#15803d' },
  { bg: '#fef2f2', color: '#991b1b' },
]
const AVATAR_COLORS = ['#7B1A1A', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#14b8a6', '#6b7280']

const tagMap    = {}
const colorMap  = {}

function tagFor(courseId) {
  if (!tagMap[courseId]) {
    const idx = Object.keys(tagMap).length % TAG_PALETTES.length
    tagMap[courseId] = TAG_PALETTES[idx]
  }
  return tagMap[courseId]
}
function colorFor(studentId) {
  if (!colorMap[studentId]) {
    const idx = Object.keys(colorMap).length % AVATAR_COLORS.length
    colorMap[studentId] = AVATAR_COLORS[idx]
  }
  return colorMap[studentId]
}

function fileNameFor(item) {
  const title = (item.homework_title || item.course_title || 'assignment')
    .toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_|_$/g, '')
  const ext = ['pdf', 'zip', 'pdf'][item.id % 3]
  return `${title}.${ext}`
}

// ── Stats ────────────────────────────────────────────────────
const courseCount = computed(() => new Set(submissions.value.map(s => s.course_id)).size)

// ── Sort label ───────────────────────────────────────────────
const sortLabel = computed(() => ({
  newest: t('teacher.sortNewest'),
  oldest: t('teacher.sortOldest'),
  urgent: t('teacher.sortUrgent'),
}[sortOrder.value]))
function cycleSortOrder() {
  const order = ['newest', 'oldest', 'urgent']
  sortOrder.value = order[(order.indexOf(sortOrder.value) + 1) % order.length]
}

// ── Filtering + sorting ──────────────────────────────────────
const filtered = computed(() => {
  let list = submissions.value
  if (activeCourse.value !== null) list = list.filter(s => s.course_id === activeCourse.value)
  if (search.value.trim()) {
    const q = search.value.toLowerCase()
    list = list.filter(s =>
      s.student_name?.toLowerCase().includes(q) ||
      s.course_title?.toLowerCase().includes(q) ||
      s.homework_title?.toLowerCase().includes(q)
    )
  }
  return list
})

const sorted = computed(() => {
  const arr = [...filtered.value]
  if (sortOrder.value === 'newest') arr.sort((a, b) => a.hours_ago - b.hours_ago)
  else if (sortOrder.value === 'oldest') arr.sort((a, b) => b.hours_ago - a.hours_ago)
  else arr.sort((a, b) => (b.is_urgent ? 1 : 0) - (a.is_urgent ? 1 : 0))
  return arr
})

const visible = computed(() => sorted.value.slice(0, pageSize.value))

function formatAgo(hours) {
  if (!hours || hours < 0.1) return 'just now'
  if (hours < 24) return `${Math.round(hours)}h ago`
  const d = Math.floor(hours / 24)
  return d === 1 ? 'Yesterday' : `${d} days ago`
}

// ── Queue efficiency ─────────────────────────────────────────
const efficiency = ref(null)

const chartBars = computed(() => {
  const daily = efficiency.value?.daily_graded
  // If we have real data use it; otherwise fall back to placeholder ascending bars
  const raw = (daily && daily.some(v => v > 0))
    ? daily
    : [1, 2, 3, 3, 4, 6, 8]          // placeholder shape

  const max = Math.max(...raw, 1)
  return raw.map((v, i) => ({
    h:     Math.max(8, Math.round((v / max) * 100)),
    color: i >= raw.length - 2 ? '#7B1A1A'
         : i >= raw.length - 4 ? '#b85a5a'
         : i >= raw.length - 6 ? '#d4a0a0'
         : '#edd4d4',
    count: v,
  }))
})

const efficiencyText = computed(() => {
  if (!efficiency.value) return 'Calculating response time...'
  const pct = efficiency.value.improvement_pct
  if (pct > 0)  return `Average response time this week has improved by ${pct}%.`
  if (pct < 0)  return `Average response time this week increased by ${Math.abs(pct)}%.`
  return `Average response time this week is unchanged from last week.`
})

const DAY_LABELS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
const dayLabels = computed(() => {
  const today = new Date().getDay()         // 0=Sun … 6=Sat
  return Array.from({ length: 7 }, (_, i) => {
    const d = (today - 6 + i + 7) % 7      // shift so index 0 = 6 days ago
    return DAY_LABELS[d === 0 ? 6 : d - 1] // JS: 0=Sun, our array: 0=Mon
  })
})

// ── Data load ────────────────────────────────────────────────
async function loadSubmissions() {
  try {
    const [subRes, courseRes, effRes] = await Promise.all([
      teacherApi.submissions(),
      teacherApi.myCourses(),
      teacherApi.efficiency(),
    ])
    const raw = subRes.data.data || []
    submissions.value = raw.map(s => {
      const tag = tagFor(s.course_id)
      return {
        ...s,
        initials: (s.student_name || 'U').split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2),
        color:    colorFor(s.student_id),
        tagBg:    tag.bg,
        tagColor: tag.color,
      }
    })
    const allCourses = courseRes.data.data || []
    const courseIds  = new Set(raw.map(s => s.course_id))
    courses.value    = allCourses.filter(c => courseIds.has(c.id))
    efficiency.value = effRes.data.data
  } finally {
    loading.value = false
  }
}

onMounted(loadSubmissions)
</script>

<style scoped>
/* Header search */
.header-search {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #f3f4f6;
  border-radius: 9999px;
  padding: .55rem 1.1rem;
  min-width: 300px;
}
.header-search-input {
  border: none;
  background: transparent;
  outline: none;
  font-size: .875rem;
  color: #374151;
  flex: 1;
}
.header-search-input::placeholder { color: #9ca3af; }

/* Page title */
.queue-title { font-size: 1.75rem; font-weight: 800; color: #111827; margin: 0 0 4px; }
.queue-sub   { font-size: .9rem; color: #6b7280; margin: 0; }

/* Control buttons */
.ctrl-btn {
  display: flex; align-items: center; gap: 6px;
  padding: .5rem 1rem;
  border: 1.5px solid #e5e7eb; border-radius: 9999px;
  background: #fff; font-size: .85rem; font-weight: 600; color: #374151;
  cursor: pointer; transition: border-color .15s, color .15s;
  position: relative;
}
.ctrl-btn:hover { border-color: #7B1A1A; color: #7B1A1A; }

/* Dropdown */
.dropdown {
  position: absolute; top: calc(100% + 6px); right: 0;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
  box-shadow: 0 8px 24px rgba(0,0,0,.1); z-index: 100;
  min-width: 180px; padding: 6px;
}
.dropdown-item {
  display: block; width: 100%; text-align: left;
  padding: .5rem .75rem; border: none; background: none;
  border-radius: 6px; font-size: .85rem; color: #374151; cursor: pointer;
}
.dropdown-item:hover { background: #f9fafb; }
.dropdown-item--active { background: #fef2f2; color: #7B1A1A; font-weight: 600; }

/* Submission card */
.sub-card {
  display: flex; align-items: center; gap: 16px;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
  padding: 20px 24px;
  cursor: pointer;
  transition: box-shadow .15s, border-color .15s;
}
.sub-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); border-color: #d1d5db; }

.sub-avatar {
  width: 50px; height: 50px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: .9rem; font-weight: 700; color: #fff; flex-shrink: 0;
}

.course-tag {
  font-size: .75rem; font-weight: 600;
  padding: .2rem .65rem; border-radius: 9999px;
}

.pending-dot {
  width: 7px; height: 7px; border-radius: 50%; background: #374151; flex-shrink: 0;
}

.grade-btn {
  display: flex; align-items: center; gap: 6px;
  padding: .55rem 1.15rem;
  background: #7B1A1A; border: none; border-radius: 9999px;
  font-size: .85rem; font-weight: 700; color: #fff;
  cursor: pointer; white-space: nowrap;
  transition: background .15s;
}
.grade-btn:hover { background: #6a1616; }

/* Load more */
.load-more-btn {
  display: flex; align-items: center; gap: 8px;
  padding: .6rem 1.5rem;
  background: #fff; border: 1.5px solid #e5e7eb; border-radius: 9999px;
  font-size: .875rem; font-weight: 600; color: #374151;
  cursor: pointer; transition: border-color .15s, color .15s;
}
.load-more-btn:hover { border-color: #7B1A1A; color: #7B1A1A; }

/* Smart Assistant card */
.smart-card {
  background: #7B1A1A;
  border-radius: 16px;
  padding: 28px 24px;
  display: flex; flex-direction: column; align-items: center;
}
.smart-sparkles {
  display: flex; align-items: center; gap: 4px;
  margin-bottom: 12px; color: #fff; font-size: 1rem;
}
.smart-btn {
  width: 100%; padding: .65rem;
  background: #fff; border: none; border-radius: 9999px;
  font-size: .875rem; font-weight: 700; color: #7B1A1A;
  cursor: pointer; transition: background .15s;
}
.smart-btn:hover { background: #f9fafb; }
</style>
