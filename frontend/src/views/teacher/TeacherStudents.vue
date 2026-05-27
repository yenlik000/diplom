<template>
  <TeacherLayout>
    <template #header-left>
      <h1 class="text-xl font-bold" style="color:#111827;margin:0;">{{ t('teacher.studentLists') }}</h1>
    </template>

    <!-- Search + filter bar -->
    <div class="flex items-center gap-3 mb-5">
      <div class="search-bar">
        <i class="pi pi-search" style="color:#9ca3af;font-size:.85rem;"></i>
        <input v-model="search" type="text" :placeholder="t('teacher.searchStudents')"
               class="bg-transparent border-0 outline-0 text-sm flex-1" style="color:#374151;" />
      </div>

      <select v-model="courseFilter" class="filter-select">
        <option value="">{{ t('teacher.allCourses') }}</option>
        <option v-for="c in courses" :key="c.id" :value="c.id">{{ c.title }}</option>
      </select>

      <select v-model="statusFilter" class="filter-select">
        <option value="">{{ t('teacher.allStatuses') }}</option>
        <option value="completed">{{ t('teacher.completed') }}</option>
        <option value="active">{{ t('teacher.inProgress') }}</option>
        <option value="idle">{{ t('teacher.notStarted') }}</option>
      </select>

      <span class="text-sm ml-auto" style="color:#6b7280;">
        {{ filtered.length }} student{{ filtered.length !== 1 ? 's' : '' }}
      </span>
    </div>

    <!-- Bulk action bar -->
    <Transition name="slide-down">
      <div v-if="selected.size > 0" class="bulk-bar">
        <span class="text-sm font-semibold" style="color:#111827;">
          {{ selected.size }} selected
        </span>
        <div class="flex items-center gap-2 ml-auto">
          <button class="bulk-btn" @click="messageSelected">
            <i class="pi pi-envelope" style="font-size:.8rem;"></i> {{ t('teacher.msgBtn') }}
          </button>
          <button class="bulk-btn" @click="exportSelected">
            <i class="pi pi-download" style="font-size:.8rem;"></i> {{ t('teacher.exportBtn') }}
          </button>
          <button class="bulk-btn bulk-btn--danger" @click="clearSelection">
            <i class="pi pi-times" style="font-size:.8rem;"></i> {{ t('teacher.clearBtn') }}
          </button>
        </div>
      </div>
    </Transition>

    <!-- Table -->
    <div class="bg-white rounded-xl" style="border:1px solid #e5e7eb;overflow:hidden;">
      <div v-if="loading" class="p-6 space-y-3">
        <div v-for="i in 6" :key="i" class="animate-pulse" style="height:56px;background:#f9fafb;border-radius:8px;"></div>
      </div>

      <div v-else-if="filtered.length === 0" class="py-20 flex flex-col items-center" style="color:#9ca3af;">
        <i class="pi pi-users" style="font-size:2.5rem;display:block;margin-bottom:12px;"></i>
        <p class="text-sm font-medium" style="color:#374151;">{{ t('teacher.noStudentsFound') }}</p>
        <p class="text-xs mt-1">{{ search ? t('teacher.tryDifferentSearch') : t('teacher.noStudentsEnrolled') }}</p>
      </div>

      <table v-else class="w-full">
        <thead>
          <tr style="background:#f9fafb;">
            <!-- Select all -->
            <th class="th" style="width:44px;padding-right:0;">
              <input
                type="checkbox"
                class="row-check"
                :checked="allSelected"
                :indeterminate="someSelected"
                @change="toggleAll"
              />
            </th>
            <th class="th">{{ t('teacher.studentCol') }}</th>
            <th class="th">{{ t('teacher.emailCol') }}</th>
            <th class="th">{{ t('teacher.courseCol') }}</th>
            <th class="th">{{ t('teacher.enrolledCol') }}</th>
            <th class="th">{{ t('teacher.progressCol') }}</th>
            <th class="th">{{ t('teacher.statusCol') }}</th>
            <th class="th" style="width:80px;">{{ t('teacher.colActions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="row in filtered"
            :key="rowKey(row)"
            class="tr"
            :class="{ 'tr--selected': selected.has(rowKey(row)) }"
            @click="toggleRow(row)"
          >
            <!-- Checkbox -->
            <td class="td" style="padding-right:0;" @click.stop>
              <input
                type="checkbox"
                class="row-check"
                :checked="selected.has(rowKey(row))"
                @change="toggleRow(row)"
              />
            </td>

            <!-- Student -->
            <td class="td">
              <div class="flex items-center gap-3">
                <div class="avatar" :style="{ background: colorFor(row.student_id) }">
                  {{ initials(row.student_name) }}
                </div>
                <span class="text-sm font-semibold" style="color:#111827;">{{ row.student_name }}</span>
              </div>
            </td>

            <td class="td text-sm" style="color:#6b7280;">{{ row.email }}</td>
            <td class="td text-sm" style="color:#374151;">{{ row.course_title }}</td>
            <td class="td text-sm" style="color:#6b7280;">{{ formatDate(row.enrolled_at) }}</td>

            <!-- Progress bar -->
            <td class="td">
              <div style="min-width:110px;">
                <div style="height:6px;background:#e5e7eb;border-radius:3px;overflow:hidden;">
                  <div style="height:100%;background:#7B1A1A;border-radius:3px;transition:width .4s;"
                       :style="{ width: row.progress + '%' }"></div>
                </div>
                <span class="text-xs mt-1 block" style="color:#6b7280;">{{ row.progress }}%</span>
              </div>
            </td>

            <!-- Status badge -->
            <td class="td">
              <span class="badge" :class="statusClass(row.progress)">
                {{ statusLabel(row.progress) }}
              </span>
            </td>

            <!-- Row actions -->
            <td class="td" @click.stop>
              <div class="flex items-center gap-1">
                <button class="row-action-btn" title="Send message" @click="messageOne(row)">
                  <i class="pi pi-envelope" style="font-size:.8rem;"></i>
                </button>
                <button class="row-action-btn" title="View profile">
                  <i class="pi pi-user" style="font-size:.8rem;"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Footer: selected count + pagination hint -->
      <div v-if="filtered.length > 0" class="table-footer">
        <span style="color:#9ca3af;">
          {{ selected.size > 0 ? `${selected.size} of ${filtered.length} selected` : `${filtered.length} records` }}
        </span>
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
const rows         = ref([])
const search       = ref('')
const courseFilter = ref('')
const statusFilter = ref('')
const selected     = ref(new Set())

const COLORS = ['#7B1A1A','#3b82f6','#10b981','#f59e0b','#8b5cf6','#ec4899','#14b8a6','#6b7280']
const colorMap = {}
function colorFor(id) {
  if (!colorMap[id]) colorMap[id] = COLORS[Object.keys(colorMap).length % COLORS.length]
  return colorMap[id]
}
function initials(name) {
  return (name || 'U').split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2)
}
function formatDate(iso) {
  return new Date(iso).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}
function rowKey(row) {
  return `${row.student_id}-${row.course_id}`
}

// ── Status helpers ────────────────────────────────────────────
function statusLabel(progress) {
  if (progress === 100) return t('teacher.completed')
  if (progress > 0)    return t('teacher.inProgress')
  return t('teacher.notStarted')
}
function statusClass(progress) {
  if (progress === 100) return 'badge--done'
  if (progress > 0)    return 'badge--active'
  return 'badge--idle'
}
function statusKey(progress) {
  if (progress === 100) return 'completed'
  if (progress > 0)    return 'active'
  return 'idle'
}

// ── Derived lists ─────────────────────────────────────────────
const courses = computed(() => {
  const seen = new Set()
  return rows.value.filter(r => { if (seen.has(r.course_id)) return false; seen.add(r.course_id); return true })
    .map(r => ({ id: r.course_id, title: r.course_title }))
})

const filtered = computed(() => {
  let list = rows.value
  if (courseFilter.value) list = list.filter(r => r.course_id === Number(courseFilter.value))
  if (statusFilter.value) list = list.filter(r => statusKey(r.progress) === statusFilter.value)
  if (search.value.trim()) {
    const q = search.value.toLowerCase()
    list = list.filter(r =>
      r.student_name.toLowerCase().includes(q) ||
      r.email.toLowerCase().includes(q) ||
      r.course_title.toLowerCase().includes(q)
    )
  }
  return list
})

// ── Selection ─────────────────────────────────────────────────
const allSelected  = computed(() => filtered.value.length > 0 && filtered.value.every(r => selected.value.has(rowKey(r))))
const someSelected = computed(() => !allSelected.value && filtered.value.some(r => selected.value.has(rowKey(r))))

function toggleRow(row) {
  const key = rowKey(row)
  const next = new Set(selected.value)
  if (next.has(key)) next.delete(key)
  else               next.add(key)
  selected.value = next
}

function toggleAll() {
  if (allSelected.value) {
    const next = new Set(selected.value)
    filtered.value.forEach(r => next.delete(rowKey(r)))
    selected.value = next
  } else {
    const next = new Set(selected.value)
    filtered.value.forEach(r => next.add(rowKey(r)))
    selected.value = next
  }
}

function clearSelection() {
  selected.value = new Set()
}

// ── Actions ───────────────────────────────────────────────────
function messageOne(_row) {
  router.push('/teacher/messages')
}

function messageSelected() {
  router.push('/teacher/messages')
}

function exportSelected() {
  const keys = selected.value
  const toExport = rows.value.filter(r => keys.has(rowKey(r)))
  const csv = [
    'Name,Email,Course,Progress,Status,Enrolled',
    ...toExport.map(r =>
      `"${r.student_name}","${r.email}","${r.course_title}",${r.progress}%,"${statusLabel(r.progress)}","${formatDate(r.enrolled_at)}"`
    )
  ].join('\n')
  const blob = new Blob([csv], { type: 'text/csv' })
  const url  = URL.createObjectURL(blob)
  const a    = document.createElement('a')
  a.href     = url
  a.download = 'students.csv'
  a.click()
  URL.revokeObjectURL(url)
}

// ── Load ──────────────────────────────────────────────────────
onMounted(async () => {
  try {
    const res = await teacherApi.students()
    rows.value = res.data.data || []
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
/* Search bar */
.search-bar {
  display: flex; align-items: center; gap: 8px;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 9px;
  padding: .5rem .85rem; flex: 1; max-width: 320px;
}

/* Filter selects */
.filter-select {
  border: 1px solid #e5e7eb; border-radius: 8px;
  padding: .48rem .75rem; font-size: .875rem; color: #374151;
  outline: none; background: #fff; cursor: pointer;
  transition: border-color .15s;
}
.filter-select:focus { border-color: #7B1A1A; }

/* Bulk action bar */
.bulk-bar {
  display: flex; align-items: center; gap: 10px;
  background: #111827; border-radius: 10px;
  padding: 10px 16px; margin-bottom: 12px;
}
.bulk-btn {
  display: flex; align-items: center; gap: 6px;
  padding: .4rem .85rem; border-radius: 7px; border: none;
  background: rgba(255,255,255,.12); color: #fff;
  font-size: .8rem; font-weight: 600; cursor: pointer;
  transition: background .15s;
}
.bulk-btn:hover { background: rgba(255,255,255,.22); }
.bulk-btn--danger { background: rgba(220,38,38,.25); }
.bulk-btn--danger:hover { background: rgba(220,38,38,.4); }

/* Slide transition */
.slide-down-enter-active, .slide-down-leave-active { transition: all .2s ease; }
.slide-down-enter-from, .slide-down-leave-to { opacity: 0; transform: translateY(-8px); }

/* Table */
.th {
  padding: .65rem 1.1rem; text-align: left;
  font-size: .72rem; font-weight: 700; color: #6b7280;
  text-transform: uppercase; letter-spacing: .05em;
  white-space: nowrap;
}
.td { padding: .8rem 1.1rem; }
.tr {
  border-top: 1px solid #f3f4f6;
  transition: background .1s;
  cursor: pointer;
}
.tr:hover      { background: #fafafa; }
.tr--selected  { background: #fef2f2; }

/* Checkbox */
.row-check {
  width: 16px; height: 16px;
  accent-color: #7B1A1A; cursor: pointer;
  display: block;
}

/* Avatar */
.avatar {
  width: 36px; height: 36px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: .75rem; font-weight: 700; color: #fff; flex-shrink: 0;
}

/* Badges */
.badge { display: inline-flex; align-items: center; padding: .25rem .7rem; border-radius: 9999px; font-size: .72rem; font-weight: 600; }
.badge--done   { background: #dcfce7; color: #15803d; }
.badge--active { background: #fef3c7; color: #92400e; }
.badge--idle   { background: #f3f4f6; color: #6b7280; }

/* Row action buttons */
.row-action-btn {
  width: 30px; height: 30px; border: none; background: transparent;
  border-radius: 6px; display: flex; align-items: center; justify-content: center;
  color: #9ca3af; cursor: pointer; transition: background .12s, color .12s;
}
.row-action-btn:hover { background: #f3f4f6; color: #7B1A1A; }

/* Table footer */
.table-footer {
  padding: .75rem 1.25rem;
  border-top: 1px solid #f3f4f6;
  font-size: .8rem;
  display: flex; align-items: center;
}
</style>
