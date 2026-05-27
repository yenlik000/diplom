<template>
  <TeacherLayout>

    <!-- Search bar in header (matches screenshot top bar) -->
    <template #header-left>
      <div class="header-search">
        <i class="pi pi-search" style="color:#9ca3af;font-size:.85rem;flex-shrink:0;"></i>
        <input v-model="headerSearch" type="text" placeholder="Search courses or students..."
               class="header-search-input" />
      </div>
    </template>

    <!-- Page title + Create button -->
    <div class="flex items-start justify-between mb-7">
      <div>
        <h1 class="page-title">Course Management</h1>
        <p class="page-sub">Oversee your active curriculum and student engagement.</p>
      </div>
      <button class="btn-create" @click="openCreate">
        <i class="pi pi-plus" style="font-size:.78rem;"></i>
        Create New Course
      </button>
    </div>

    <!-- Two-column layout -->
    <div class="flex gap-6 items-start">

      <!-- ── Left: course cards ───────────────────────────────── -->
      <div class="flex-1 min-w-0 flex flex-col gap-5">

        <!-- Loading skeleton -->
        <div v-if="loading" class="flex flex-col gap-4">
          <div class="animate-pulse bg-white rounded-2xl" style="height:280px;border:1px solid #e5e7eb;"></div>
          <div class="flex gap-4">
            <div class="animate-pulse bg-white rounded-2xl flex-1" style="height:220px;border:1px solid #e5e7eb;"></div>
            <div class="animate-pulse bg-white rounded-2xl flex-1" style="height:220px;border:1px solid #e5e7eb;"></div>
          </div>
        </div>

        <template v-else-if="displayCourses.length">

          <!-- ── Featured card (first course) ── -->
          <div class="featured-card">
            <div class="flex items-start justify-between mb-5">
              <div class="flex items-center gap-4">
                <div class="featured-icon" :style="{ background: iconBg(displayCourses[0]) }">
                  {{ iconChar(displayCourses[0]) }}
                </div>
                <div>
                  <h2 class="featured-title">{{ displayCourses[0].title }}</h2>
                  <p class="featured-sub">{{ subtitle(displayCourses[0], 0) }}</p>
                </div>
              </div>
              <div class="flex items-center gap-0.5">
                <button class="icon-btn" @click.stop="openEdit(displayCourses[0])">
                  <i class="pi pi-pencil" style="font-size:.82rem;"></i>
                </button>
                <button class="icon-btn" @click.stop="showMenu(displayCourses[0])">
                  <i class="pi pi-ellipsis-v" style="font-size:.82rem;"></i>
                </button>
              </div>
            </div>

            <!-- Stats -->
            <div class="stats-row">
              <div class="stat-box">
                <div class="stat-label">STUDENTS</div>
                <div class="stat-val">{{ cs(displayCourses[0]).enrolled }}</div>
              </div>
              <div class="stat-box">
                <div class="stat-label">AVG. GRADE</div>
                <div class="stat-val">{{ cs(displayCourses[0]).avgGrade }}</div>
              </div>
              <div class="stat-box">
                <div class="stat-label">LESSONS</div>
                <div class="stat-val">{{ cs(displayCourses[0]).lessons }}</div>
              </div>
            </div>

            <!-- Progress -->
            <div class="mt-5 mb-5">
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-semibold" style="color:#374151;">Syllabus Progress</span>
                <span class="text-sm font-semibold" style="color:#374151;">{{ cs(displayCourses[0]).progress }}% Complete</span>
              </div>
              <div class="prog-track">
                <div class="prog-fill" :style="{ width: cs(displayCourses[0]).progress + '%' }"></div>
              </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-3">
              <button class="btn-manage" @click="router.push(`/teacher/courses/${displayCourses[0].id}/curriculum`)">Manage Curriculum</button>
              <button class="btn-announce">Post Announcement</button>
            </div>
          </div>

          <!-- ── Mini cards grid (remaining courses) ── -->
          <div v-if="displayCourses.length > 1" class="grid grid-cols-2 gap-4">
            <div v-for="(course, i) in displayCourses.slice(1)" :key="course.id" class="mini-card">
              <!-- Top row -->
              <div class="flex items-start justify-between mb-4">
                <div class="mini-icon">
                  <i :class="iconClass(course)" style="font-size:1rem;color:#6b7280;"></i>
                </div>
                <span class="active-label">ACTIVE</span>
              </div>

              <!-- Title -->
              <h3 class="mini-title">{{ course.title }}</h3>
              <p class="mini-sub">{{ subtitle(course, i + 1) }}</p>

              <!-- Avatar stack + enrolled count -->
              <div class="flex items-center gap-2 mt-3 mb-4">
                <div class="avatar-stack">
                  <div v-for="j in 3" :key="j"
                       class="av-chip"
                       :style="{ background: avColor(course.id, j), marginLeft: j === 1 ? '0' : '-8px', zIndex: 4 - j }">
                    {{ avLetter(course.id, j) }}
                  </div>
                </div>
                <span class="text-xs font-semibold" style="color:#374151;">
                  +{{ Math.max(0, cs(course).enrolled - 3) }}&nbsp;&nbsp;{{ cs(course).enrolled }} Enrolled
                </span>
              </div>

              <!-- Curriculum progress -->
              <div class="mb-4">
                <div class="flex items-center justify-between mb-1.5">
                  <span class="text-xs font-semibold" style="color:#374151;">Curriculum</span>
                  <span class="text-xs font-semibold" style="color:#374151;">{{ cs(course).progress }}%</span>
                </div>
                <div class="prog-track">
                  <div class="prog-fill" :style="{ width: cs(course).progress + '%' }"></div>
                </div>
              </div>

              <button class="btn-details" @click="router.push(`/teacher/courses/${course.id}/curriculum`)">Manage Curriculum</button>
            </div>
          </div>

        </template>

        <!-- Empty state -->
        <div v-else-if="!loading" class="flex flex-col items-center justify-center py-24 bg-white rounded-2xl"
             style="border:1px solid #e5e7eb;">
          <i class="pi pi-book" style="font-size:2.8rem;color:#d1d5db;display:block;margin-bottom:14px;"></i>
          <p class="font-bold" style="color:#374151;font-size:1rem;">No courses yet</p>
          <p class="text-sm mt-1 mb-5" style="color:#9ca3af;">Create your first course to get started</p>
          <button class="btn-create" @click="openCreate">
            <i class="pi pi-plus" style="font-size:.78rem;"></i> Create New Course
          </button>
        </div>
      </div>

      <!-- ── Right sidebar ─────────────────────────────────────── -->
      <div class="flex flex-col gap-5" style="width:262px;flex-shrink:0;">

        <!-- Academic Overview -->
        <div class="overview-card">
          <h4 class="ov-title">Academic Overview</h4>
          <p class="ov-body">
            You have <strong>{{ globalStats.pending_gradings || 0 }}</strong> pending grading
            request{{ globalStats.pending_gradings !== 1 ? 's' : '' }} and
            <strong>{{ Math.max(0, displayCourses.length - 1) }}</strong> curriculum
            review{{ displayCourses.length - 1 !== 1 ? 's' : '' }} scheduled for today.
          </p>
          <div class="flex flex-col gap-2">
            <button class="ov-item" @click="router.push('/teacher/grading')">
              <div class="ov-icon"><i class="pi pi-file-edit" style="font-size:.82rem;"></i></div>
              <span>Grade Midterm Submissions</span>
            </button>
            <button v-if="displayCourses[1]" class="ov-item">
              <div class="ov-icon"><i class="pi pi-calendar" style="font-size:.82rem;"></i></div>
              <span>{{ displayCourses[1].title }} Seminar</span>
            </button>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="activity-card">
          <h4 class="act-title">Recent Activity</h4>
          <div class="flex flex-col gap-4">
            <div v-for="(item, i) in activityItems" :key="i" class="flex gap-3 items-start">
              <div class="act-dot"
                   :style="{ background: item.status === 'graded' ? '#10b981' : item.status === 'submitted' ? '#7B1A1A' : '#d1d5db', marginTop: '6px' }">
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2">
                  <div class="text-sm font-bold" style="color:#111827;">{{ item.title }}</div>
                  <span v-if="item.status" class="act-status" :class="`act-status--${item.status}`">
                    {{ item.status }}
                  </span>
                </div>
                <div class="text-xs mt-0.5" style="color:#6b7280;line-height:1.4;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ item.subtitle }}</div>
                <div class="text-xs mt-1" style="color:#9ca3af;">{{ item.time }}</div>
              </div>
            </div>
            <div v-if="!activityItems.length" class="text-sm" style="color:#9ca3af;padding:4px 0;">No recent activity</div>
          </div>
        </div>

      </div>
    </div>

    <!-- ── Create / Edit modal ───────────────────────────────── -->
    <div v-if="dialogVisible" class="modal-overlay" @click.self="dialogVisible = false">
      <div class="modal-box">
        <div class="flex items-center justify-between mb-5">
          <h3 style="font-size:1.1rem;font-weight:800;color:#111827;margin:0;">
            {{ editingId ? 'Edit Course' : 'Create New Course' }}
          </h3>
          <button class="icon-btn" @click="dialogVisible = false">
            <i class="pi pi-times"></i>
          </button>
        </div>

        <form @submit.prevent="handleSave" class="flex flex-col gap-4">
          <div class="f-field">
            <label>Title</label>
            <input v-model="form.title" required class="f-input" placeholder="e.g. Advanced Calculus" />
          </div>
          <div class="f-field">
            <label>Description</label>
            <textarea v-model="form.description" rows="3" class="f-input" placeholder="Course description…"></textarea>
          </div>
          <div class="flex gap-3">
            <div class="f-field flex-1">
              <label>Subject</label>
              <input v-model="form.subject" class="f-input" placeholder="e.g. Mathematics" />
            </div>
            <div class="f-field flex-1">
              <label>Level</label>
              <input v-model="form.level" class="f-input" placeholder="e.g. Grade 11" />
            </div>
          </div>
          <div class="flex gap-3 items-end">
            <div class="f-field flex-1">
              <label>Price</label>
              <input v-model.number="form.price" type="number" min="0" step="0.01" class="f-input" />
            </div>
            <div class="f-field flex-1" style="padding-bottom:2px;">
              <label class="flex items-center gap-2" style="cursor:pointer;font-weight:600;">
                <input type="checkbox" v-model="form.is_published" style="width:15px;height:15px;accent-color:#7B1A1A;cursor:pointer;" />
                Published
              </label>
            </div>
          </div>
          <p v-if="saveError" style="font-size:.85rem;color:#dc2626;">{{ saveError }}</p>
          <div class="flex justify-end gap-3 mt-1">
            <button type="button" class="btn-cancel" @click="dialogVisible = false">Cancel</button>
            <button type="submit" class="btn-save" :disabled="saving">
              {{ saving ? 'Saving…' : editingId ? 'Save Changes' : 'Create Course' }}
            </button>
          </div>
        </form>
      </div>
    </div>

  </TeacherLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import TeacherLayout from '@/components/teacher/TeacherLayout.vue'
import { teacherApi, coursesApi } from '@/api'

const router = useRouter()

// ── State ─────────────────────────────────────────────────────
const loading     = ref(true)
const rawCourses  = ref([])
const globalStats = ref({})
const recentSubs  = ref([])
const statsMap    = ref({})   // courseId → { enrolled, totalL, completedSum, avgScore }

const headerSearch  = ref('')
const dialogVisible = ref(false)
const editingId     = ref(null)
const saving        = ref(false)
const saveError     = ref('')
const form          = ref(emptyForm())

function emptyForm() {
  return { title: '', description: '', subject: '', level: '', price: 0, is_published: false }
}

// ── Filtered courses (header search) ─────────────────────────
const displayCourses = computed(() => {
  const q = headerSearch.value.toLowerCase().trim()
  return q
    ? rawCourses.value.filter(c =>
        c.title.toLowerCase().includes(q) ||
        (c.subject || '').toLowerCase().includes(q)
      )
    : rawCourses.value
})

// ── Icon helpers ──────────────────────────────────────────────
const SUBJECT_SYMBOLS = {
  calculus: 'Σ', math: '∑', algebra: '∝', statistics: 'σ',
  physics: 'φ', chemistry: 'C', biology: 'B', english: 'E',
  history: 'H', economics: '€', programming: '</>',
}
const ICON_COLORS = ['#7B1A1A', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#0ea5e9']
const MINI_ICONS = {
  algebra: 'pi pi-th-large', statistics: 'pi pi-chart-bar', calculus: 'pi pi-chart-line',
  physics: 'pi pi-bolt', math: 'pi pi-calculator', english: 'pi pi-book',
  history: 'pi pi-clock', default: 'pi pi-th-large',
}

function iconBg(course) {
  return ICON_COLORS[(course.id - 1) % ICON_COLORS.length]
}
function iconChar(course) {
  const key = (course.subject || course.title || '').toLowerCase()
  for (const [k, sym] of Object.entries(SUBJECT_SYMBOLS)) {
    if (key.includes(k)) return sym
  }
  return (course.subject || course.title || '?')[0].toUpperCase()
}
function iconClass(course) {
  const key = (course.subject || course.title || '').toLowerCase()
  for (const [k, cls] of Object.entries(MINI_ICONS)) {
    if (k !== 'default' && key.includes(k)) return cls
  }
  return MINI_ICONS.default
}

const SECTIONS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
function subtitle(course, index) {
  const left  = course.subject  || `Section ${SECTIONS[index % 26]}`
  const right = course.level    || 'Semester 1'
  return `${left} • ${right}`
}

// ── Per-course stats ──────────────────────────────────────────
function cs(course) {
  const s = statsMap.value[course.id] || {}
  const enrolled    = s.enrolled    ?? 0
  const totalL      = s.totalL      ?? 0
  const completedSum = s.completedSum ?? 0
  const avgCompleted = enrolled > 0 ? completedSum / enrolled : 0
  const progress    = totalL > 0 ? Math.round(avgCompleted / totalL * 100) : 0
  return {
    enrolled,
    avgGrade:  s.avgScore != null ? Math.round(s.avgScore) + '%' : globalStats.value.avg_progress ? globalStats.value.avg_progress + '%' : '—',
    lessons:   totalL > 0 ? `${Math.round(avgCompleted)}/${totalL}` : '—',
    progress:  Math.min(100, progress),
  }
}

// ── Avatar stack helpers ──────────────────────────────────────
const AV_COLORS = ['#7B1A1A', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6']
const AV_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
function avColor(courseId, j) { return AV_COLORS[(courseId * 3 + j) % AV_COLORS.length] }
function avLetter(courseId, j) { return AV_LETTERS[(courseId * 7 + j) % 26] }

// ── Recent Activity ───────────────────────────────────────────
function hoursAgo(isoStr) {
  if (!isoStr) return 0
  return (Date.now() - new Date(isoStr).getTime()) / 3_600_000
}
function formatAgo(hours) {
  if (hours < 0.1) return 'just now'
  if (hours < 1)   return `${Math.round(hours * 60)} min ago`
  if (hours < 24)  return `${Math.round(hours)} hours ago`
  const d = Math.floor(hours / 24)
  return d === 1 ? 'Yesterday' : `${d} days ago`
}

const activityItems = computed(() => {
  return recentSubs.value.slice(0, 4).map(sub => ({
    title:    `${sub.student_name || 'Student'} submitted`,
    subtitle: `${sub.course_title || 'Course'}: ${sub.homework_title || 'Assignment'}`,
    time:     formatAgo(hoursAgo(sub.submitted_at)),
    status:   sub.status,
  }))
})

// ── Load ──────────────────────────────────────────────────────
onMounted(async () => {
  try {
    const [cRes, sRes, subRes, studRes] = await Promise.all([
      teacherApi.myCourses(),
      teacherApi.stats(),
      teacherApi.submissions(),
      teacherApi.students(),
    ])
    rawCourses.value  = cRes.data.data    || []
    globalStats.value = sRes.data.data    || {}
    recentSubs.value  = (subRes.data.data || []).slice(0, 5)

    // Build per-course stats from student rows
    const map = {}
    for (const row of (studRes.data.data || [])) {
      const cid = row.course_id
      if (!map[cid]) map[cid] = { enrolled: 0, totalL: Number(row.total_lessons) || 0, completedSum: 0, avgScore: null }
      map[cid].enrolled++
      map[cid].completedSum += Number(row.completed_lessons) || 0
    }
    statsMap.value = map
  } finally {
    loading.value = false
  }
})

// ── Dialog ────────────────────────────────────────────────────
function openCreate() {
  editingId.value = null
  form.value = emptyForm()
  saveError.value = ''
  dialogVisible.value = true
}
function openEdit(course) {
  editingId.value = course.id
  form.value = { ...course, price: Number(course.price) }
  saveError.value = ''
  dialogVisible.value = true
}
function showMenu(course) {
  if (confirm(`Delete "${course.title}"?`)) confirmDelete(course)
}
async function handleSave() {
  saveError.value = ''
  saving.value = true
  try {
    if (editingId.value) await coursesApi.update(editingId.value, form.value)
    else                 await coursesApi.create(form.value)
    dialogVisible.value = false
    const res = await teacherApi.myCourses()
    rawCourses.value = res.data.data || []
  } catch (e) {
    saveError.value = e.response?.data?.error || 'Failed to save course.'
  } finally {
    saving.value = false
  }
}
async function confirmDelete(course) {
  await coursesApi.remove(course.id)
  const res = await teacherApi.myCourses()
  rawCourses.value = res.data.data || []
}
</script>

<style scoped>
/* Header search */
.header-search {
  display: flex; align-items: center; gap: 10px;
  background: #f3f4f6; border-radius: 9999px;
  padding: .55rem 1.2rem; min-width: 340px;
}
.header-search-input {
  border: none; background: transparent; outline: none;
  font-size: .875rem; color: #374151; flex: 1;
}
.header-search-input::placeholder { color: #9ca3af; }

/* Page title */
.page-title { font-size: 1.85rem; font-weight: 800; color: #111827; margin: 0 0 4px; }
.page-sub   { font-size: .9rem;  color: #6b7280; margin: 0; }

/* Create button */
.btn-create {
  display: flex; align-items: center; gap: 7px;
  padding: .6rem 1.2rem;
  background: #7B1A1A; color: #fff;
  border: none; border-radius: 10px;
  font-size: .875rem; font-weight: 700; cursor: pointer;
  white-space: nowrap; transition: background .15s;
}
.btn-create:hover { background: #6a1616; }

/* Icon button */
.icon-btn {
  width: 32px; height: 32px; border: none; background: transparent;
  border-radius: 7px; display: flex; align-items: center; justify-content: center;
  color: #6b7280; cursor: pointer; transition: background .12s;
}
.icon-btn:hover { background: #f3f4f6; color: #374151; }

/* ── Featured card ── */
.featured-card {
  background: #fff; border: 1px solid #e5e7eb; border-radius: 18px; padding: 26px 28px;
}
.featured-icon {
  width: 52px; height: 52px; border-radius: 12px; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.45rem; font-weight: 800; color: #fff;
}
.featured-title { font-size: 1.25rem; font-weight: 800; color: #111827; margin: 0 0 3px; }
.featured-sub   { font-size: .82rem;  color: #6b7280; margin: 0; }

.stats-row { display: flex; gap: 12px; }
.stat-box  { flex: 1; background: #f9fafb; border-radius: 10px; padding: 14px 16px; }
.stat-label { font-size: .65rem; font-weight: 700; color: #9ca3af; letter-spacing: .07em; text-transform: uppercase; margin-bottom: 7px; }
.stat-val   { font-size: 1.6rem; font-weight: 800; color: #111827; line-height: 1; }

/* Progress */
.prog-track { height: 7px; background: #e5e7eb; border-radius: 9999px; overflow: hidden; }
.prog-fill  { height: 100%; background: #7B1A1A; border-radius: 9999px; transition: width .45s ease; }

.btn-manage {
  padding: .6rem 1.3rem;
  background: #7B1A1A; border: none; border-radius: 9px;
  color: #fff; font-size: .875rem; font-weight: 700; cursor: pointer;
  transition: background .15s;
}
.btn-manage:hover { background: #6a1616; }
.btn-announce {
  padding: .6rem 1.3rem;
  background: #fff; border: 1.5px solid #7B1A1A; border-radius: 9px;
  color: #7B1A1A; font-size: .875rem; font-weight: 700; cursor: pointer;
  transition: background .15s;
}
.btn-announce:hover { background: #fef2f2; }

/* ── Mini cards ── */
.mini-card {
  background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 20px 22px;
}
.mini-icon {
  width: 44px; height: 44px; border-radius: 11px; background: #f3f4f6;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.active-label { font-size: .67rem; font-weight: 700; color: #059669; letter-spacing: .07em; }
.mini-title   { font-size: 1.05rem; font-weight: 800; color: #111827; margin: 0 0 2px; }
.mini-sub     { font-size: .8rem;   color: #6b7280; margin: 0; }

/* Avatar stack */
.avatar-stack { display: flex; }
.av-chip {
  width: 26px; height: 26px; border-radius: 50%;
  border: 2px solid #fff;
  display: flex; align-items: center; justify-content: center;
  font-size: .62rem; font-weight: 700; color: #fff;
}

.btn-details {
  width: 100%; padding: .55rem;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 9px;
  font-size: .85rem; font-weight: 600; color: #374151;
  cursor: pointer; transition: border-color .15s, color .15s;
}
.btn-details:hover { border-color: #7B1A1A; color: #7B1A1A; }

/* ── Academic Overview ── */
.overview-card { background: #7B1A1A; border-radius: 16px; padding: 22px; }
.ov-title { font-size: 1rem; font-weight: 800; color: #fff; margin: 0 0 10px; }
.ov-body  { font-size: .82rem; color: rgba(255,255,255,.8); line-height: 1.55; margin: 0 0 16px; }
.ov-body strong { color: #fff; }
.ov-item {
  display: flex; align-items: center; gap: 10px;
  background: rgba(255,255,255,.12); border: none; border-radius: 10px;
  padding: 10px 12px; cursor: pointer; text-align: left; width: 100%;
  font-size: .82rem; font-weight: 600; color: #fff; transition: background .15s;
}
.ov-item:hover { background: rgba(255,255,255,.22); }
.ov-icon {
  width: 28px; height: 28px; border-radius: 7px;
  background: rgba(255,255,255,.15);
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}

/* ── Recent Activity ── */
.activity-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 22px; }
.act-title { font-size: 1rem; font-weight: 800; color: #111827; margin: 0 0 16px; }
.act-dot   { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

/* ── Modal ── */
.modal-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,.35); z-index: 1000;
  display: flex; align-items: center; justify-content: center;
}
.modal-box {
  background: #fff; border-radius: 16px; padding: 28px;
  width: 520px; max-width: calc(100vw - 40px);
  max-height: calc(100vh - 80px); overflow-y: auto;
}
.f-field { display: flex; flex-direction: column; gap: 5px; }
.f-field label { font-size: .85rem; font-weight: 600; color: #374151; }
.f-input {
  padding: .55rem .75rem;
  border: 1.5px solid #e5e7eb; border-radius: 8px;
  font-size: .875rem; color: #111827; font-family: inherit;
  outline: none; transition: border-color .15s; resize: vertical;
}
.f-input:focus { border-color: #7B1A1A; }
.btn-cancel {
  padding: .55rem 1.1rem; border: 1.5px solid #e5e7eb; border-radius: 8px;
  background: #fff; color: #374151; font-size: .875rem; font-weight: 600; cursor: pointer;
}
.btn-save {
  padding: .55rem 1.25rem; border: none; border-radius: 8px;
  background: #7B1A1A; color: #fff; font-size: .875rem; font-weight: 700; cursor: pointer;
  transition: background .15s;
}
.btn-save:hover:not(:disabled) { background: #6a1616; }
.btn-save:disabled { opacity: .5; cursor: not-allowed; }
</style>
