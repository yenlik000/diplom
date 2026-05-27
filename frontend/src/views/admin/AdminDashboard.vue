<template>
  <AdminLayout>
    <template #header-left>
      <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-sub">Welcome back, <strong>{{ auth.user?.full_name || auth.user?.name || 'Admin' }}</strong></p>
      </div>
    </template>

    <!-- ── Stat cards ───────────────────────────────────────── -->
    <div class="stats-grid mb-8">
      <template v-if="loading">
        <div v-for="i in 6" :key="i" class="stat-card animate-pulse">
          <div style="height:40px;background:#f3f4f6;border-radius:8px;margin-bottom:16px;"></div>
          <div style="height:32px;background:#f9fafb;border-radius:6px;width:60%;margin-bottom:8px;"></div>
          <div style="height:16px;background:#f9fafb;border-radius:4px;width:80%;"></div>
        </div>
      </template>
      <template v-else>
        <div v-for="card in statCards" :key="card.label" class="stat-card">
          <div class="stat-icon-wrap" :style="{ background: card.bgColor }">
            <i :class="`pi ${card.icon}`" :style="{ color: card.color, fontSize: '1.1rem' }"></i>
          </div>
          <div class="stat-value">{{ card.value }}</div>
          <div class="stat-label">{{ card.label }}</div>
          <div class="stat-change" :style="{ color: card.changeColor }">
            <i :class="`pi pi-arrow-${card.trend}`" style="font-size:.65rem;"></i>
            {{ card.change }}
          </div>
        </div>
      </template>
    </div>

    <!-- ── Two-column section ───────────────────────────────── -->
    <div class="flex gap-6 items-start">

      <!-- Left: recent users + recent courses -->
      <div class="flex-1 min-w-0 flex flex-col gap-6">

        <!-- Recent Users -->
        <div class="panel">
          <div class="flex items-center justify-between mb-5">
            <h3 class="panel-title">Recent Users</h3>
            <RouterLink to="/admin/users" class="view-all">View all →</RouterLink>
          </div>

          <div v-if="loading" class="flex flex-col gap-3">
            <div v-for="i in 5" :key="i" class="animate-pulse" style="height:48px;background:#f9fafb;border-radius:8px;"></div>
          </div>

          <table v-else class="w-full">
            <thead>
              <tr>
                <th class="th">User</th>
                <th class="th">Username</th>
                <th class="th">Role</th>
                <th class="th">Joined</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="u in recentUsers" :key="u.id" class="tr">
                <td class="td">
                  <div class="flex items-center gap-3">
                    <div class="u-avatar" :style="{ background: roleColor(u.role) }">
                      {{ initials(u.full_name) }}
                    </div>
                    <span class="text-sm font-semibold" style="color:#111827;">{{ u.full_name }}</span>
                  </div>
                </td>
                <td class="td" style="color:#6b7280;font-size:.85rem;font-family:monospace;">@{{ u.username }}</td>
                <td class="td">
                  <span class="role-badge" :class="`role-badge--${u.role}`">{{ u.role }}</span>
                </td>
                <td class="td" style="color:#9ca3af;font-size:.82rem;">{{ fmtDate(u.created_at) }}</td>
              </tr>
              <tr v-if="!recentUsers.length">
                <td colspan="4" class="td" style="text-align:center;color:#9ca3af;">No users yet</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Recent Courses -->
        <div class="panel">
          <div class="flex items-center justify-between mb-5">
            <h3 class="panel-title">Courses</h3>
            <RouterLink to="/admin/courses" class="view-all">Manage →</RouterLink>
          </div>

          <div v-if="loading" class="flex flex-col gap-3">
            <div v-for="i in 3" :key="i" class="animate-pulse" style="height:56px;background:#f9fafb;border-radius:8px;"></div>
          </div>

          <div v-else class="flex flex-col gap-3">
            <div v-for="c in recentCourses" :key="c.id" class="course-row">
              <div class="course-dot" :style="{ background: subjectColor(c.subject) }"></div>
              <div class="flex-1 min-w-0">
                <div class="text-sm font-semibold" style="color:#111827;">{{ c.title }}</div>
                <div class="text-xs" style="color:#9ca3af;">
                  {{ c.subject || 'General' }}{{ c.teacher_name ? ' • ' + c.teacher_name : '' }}
                </div>
              </div>
              <span class="pub-badge" :class="c.is_published ? 'pub-badge--on' : 'pub-badge--off'">
                {{ c.is_published ? 'Published' : 'Draft' }}
              </span>
            </div>
            <div v-if="!recentCourses.length" class="text-sm text-center" style="color:#9ca3af;padding:12px 0;">
              No courses yet
            </div>
          </div>
        </div>

      </div>

      <!-- Right sidebar -->
      <div class="flex flex-col gap-6" style="width:280px;flex-shrink:0;">

        <!-- Quick Actions -->
        <div class="panel">
          <h3 class="panel-title mb-4">Quick Actions</h3>
          <div class="flex flex-col gap-2">
            <RouterLink to="/admin/users" class="qa-btn qa-btn--primary">
              <i class="pi pi-user-plus" style="font-size:.85rem;"></i>
              Create New User
            </RouterLink>
            <RouterLink to="/admin/courses" class="qa-btn qa-btn--outline">
              <i class="pi pi-book" style="font-size:.85rem;"></i>
              Manage Courses
            </RouterLink>
            <RouterLink to="/courses" class="qa-btn qa-btn--outline">
              <i class="pi pi-eye" style="font-size:.85rem;"></i>
              View Student Site
            </RouterLink>
          </div>
        </div>

        <!-- Platform breakdown -->
        <div class="panel">
          <h3 class="panel-title mb-4">Platform Breakdown</h3>
          <div class="flex flex-col gap-3">
            <div v-for="item in breakdown" :key="item.label">
              <div class="flex items-center justify-between mb-1">
                <span class="text-sm" style="color:#374151;">{{ item.label }}</span>
                <span class="text-sm font-bold" style="color:#111827;">{{ item.value }}</span>
              </div>
              <div style="height:6px;background:#f3f4f6;border-radius:9999px;overflow:hidden;">
                <div style="height:100%;border-radius:9999px;transition:width .5s ease;"
                     :style="{ width: item.pct + '%', background: item.color }"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Role distribution -->
        <div class="panel">
          <h3 class="panel-title mb-4">User Roles</h3>
          <div class="flex flex-col gap-3">
            <div v-for="r in roleBreakdown" :key="r.label" class="flex items-center gap-3">
              <div style="width:10px;height:10px;border-radius:50%;flex-shrink:0;"
                   :style="{ background: r.color }"></div>
              <span class="text-sm flex-1" style="color:#374151;">{{ r.label }}</span>
              <span class="text-sm font-bold" style="color:#111827;">{{ r.value }}</span>
            </div>
          </div>
        </div>

      </div>
    </div>

  </AdminLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import AdminLayout from '@/components/admin/AdminLayout.vue'
import { adminApi, teacherApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const auth    = useAuthStore()
const loading = ref(true)
const stats   = ref({})
const allUsers   = ref([])
const allCourses = ref([])

// ── Helpers ───────────────────────────────────────────────────
function initials(name) {
  return (name || 'U').split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2)
}
function fmtDate(iso) {
  return new Date(iso).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}
function roleColor(role) {
  return role === 'admin' ? '#1e293b' : role === 'teacher' ? '#7B1A1A' : '#3b82f6'
}
const SUBJECT_COLORS = ['#7B1A1A','#3b82f6','#10b981','#f59e0b','#8b5cf6','#ec4899']
function subjectColor(sub) {
  const idx = (sub || 'x').charCodeAt(0) % SUBJECT_COLORS.length
  return SUBJECT_COLORS[idx]
}

// ── Derived data ──────────────────────────────────────────────
const recentUsers   = computed(() => [...allUsers.value].slice(0, 6))
const recentCourses = computed(() => [...allCourses.value].slice(0, 5))

const statCards = computed(() => {
  const s = stats.value
  const total = (s.total_students || 0) + (s.total_teachers || 0)
  return [
    { label: 'Total Students',   value: s.total_students || 0, icon: 'pi-users',     bgColor: '#eff6ff', color: '#3b82f6', change: 'All enrolled students',    changeColor: '#6b7280', trend: 'up' },
    { label: 'Total Teachers',   value: s.total_teachers || 0, icon: 'pi-user',      bgColor: '#fef2f2', color: '#7B1A1A', change: 'Active instructors',        changeColor: '#6b7280', trend: 'up' },
    { label: 'Courses',          value: s.total_courses  || 0, icon: 'pi-book',      bgColor: '#f0fdf4', color: '#10b981', change: 'Published & draft',         changeColor: '#6b7280', trend: 'up' },
    { label: 'Enrollments',      value: s.total_enrolled || 0, icon: 'pi-user-plus', bgColor: '#fefce8', color: '#f59e0b', change: 'Total course enrollments',   changeColor: '#6b7280', trend: 'up' },
    { label: 'Lessons',          value: s.total_lessons  || 0, icon: 'pi-video',     bgColor: '#f5f3ff', color: '#8b5cf6', change: 'Across all courses',         changeColor: '#6b7280', trend: 'up' },
    { label: 'Groups',           value: s.total_groups   || 0, icon: 'pi-th-large',  bgColor: '#fff7ed', color: '#f97316', change: 'Learning groups',            changeColor: '#6b7280', trend: 'up' },
  ]
})

const breakdown = computed(() => {
  const s = stats.value
  const maxVal = Math.max(s.total_students || 1, s.total_teachers || 1, s.total_courses || 1, 1)
  return [
    { label: 'Students',   value: s.total_students || 0, pct: Math.round(((s.total_students || 0) / maxVal) * 100), color: '#3b82f6' },
    { label: 'Teachers',   value: s.total_teachers || 0, pct: Math.round(((s.total_teachers || 0) / maxVal) * 100), color: '#7B1A1A' },
    { label: 'Courses',    value: s.total_courses  || 0, pct: Math.round(((s.total_courses  || 0) / maxVal) * 100), color: '#10b981' },
    { label: 'Enrollments',value: s.total_enrolled || 0, pct: Math.round(((s.total_enrolled || 0) / maxVal) * 100), color: '#f59e0b' },
  ]
})

const roleBreakdown = computed(() => {
  const students = allUsers.value.filter(u => u.role === 'student').length
  const teachers = allUsers.value.filter(u => u.role === 'teacher').length
  const admins   = allUsers.value.filter(u => u.role === 'admin').length
  return [
    { label: 'Students', value: students, color: '#3b82f6' },
    { label: 'Teachers', value: teachers, color: '#7B1A1A' },
    { label: 'Admins',   value: admins,   color: '#1e293b' },
  ]
})

// ── Load ──────────────────────────────────────────────────────
onMounted(async () => {
  try {
    const [sRes, uRes, cRes] = await Promise.all([
      adminApi.stats(),
      adminApi.users(),
      teacherApi.myCourses(),
    ])
    stats.value      = sRes.data.data || {}
    allUsers.value   = uRes.data.data || []
    allCourses.value = cRes.data.data || []
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
.page-title { font-size: 1.6rem; font-weight: 800; color: #111827; margin: 0 0 2px; }
.page-sub   { font-size: .875rem; color: #6b7280; margin: 0; }
.page-sub strong { color: #374151; }

/* Stats grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 14px;
}
@media (max-width: 1400px) { .stats-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 900px)  { .stats-grid { grid-template-columns: repeat(2, 1fr); } }

.stat-card {
  background: #fff; border: 1px solid #e5e7eb; border-radius: 14px; padding: 20px;
  transition: box-shadow .15s;
}
.stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.06); }
.stat-icon-wrap {
  width: 40px; height: 40px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center; margin-bottom: 14px;
}
.stat-value  { font-size: 1.9rem; font-weight: 800; color: #111827; line-height: 1; margin-bottom: 4px; }
.stat-label  { font-size: .78rem; color: #6b7280; margin-bottom: 6px; }
.stat-change { font-size: .72rem; display: flex; align-items: center; gap: 4px; }

/* Panels */
.panel {
  background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 22px;
}
.panel-title { font-size: 1rem; font-weight: 700; color: #111827; margin: 0; }
.view-all { font-size: .82rem; font-weight: 600; color: #7B1A1A; text-decoration: none; }
.view-all:hover { text-decoration: underline; }

/* Table */
.th { padding: .55rem .85rem; text-align: left; font-size: .68rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: .05em; }
.td { padding: .75rem .85rem; }
.tr { border-top: 1px solid #f3f4f6; }
.tr:hover { background: #fafafa; }

.u-avatar {
  width: 32px; height: 32px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: .68rem; font-weight: 700; color: #fff; flex-shrink: 0;
}

.role-badge {
  display: inline-flex; align-items: center; padding: .2rem .6rem;
  border-radius: 9999px; font-size: .7rem; font-weight: 700; text-transform: capitalize;
}
.role-badge--student { background: #eff6ff; color: #1d4ed8; }
.role-badge--teacher { background: #fef2f2; color: #7B1A1A; }
.role-badge--admin   { background: #f1f5f9; color: #1e293b; }

/* Course rows */
.course-row {
  display: flex; align-items: center; gap: 12px;
  padding: 10px 0; border-bottom: 1px solid #f3f4f6;
}
.course-row:last-child { border-bottom: none; }
.course-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

.pub-badge {
  font-size: .68rem; font-weight: 700; padding: .2rem .55rem;
  border-radius: 9999px; white-space: nowrap; flex-shrink: 0;
}
.pub-badge--on  { background: #dcfce7; color: #15803d; }
.pub-badge--off { background: #f3f4f6; color: #6b7280; }

/* Quick action buttons */
.qa-btn {
  display: flex; align-items: center; gap: 8px;
  padding: .6rem 1rem; border-radius: 9px;
  font-size: .875rem; font-weight: 600; cursor: pointer;
  text-decoration: none; transition: all .15s;
}
.qa-btn--primary {
  background: #1e293b; color: #fff; border: none;
}
.qa-btn--primary:hover { background: #0f172a; }
.qa-btn--outline {
  background: #fff; color: #374151; border: 1.5px solid #e5e7eb;
}
.qa-btn--outline:hover { border-color: #7B1A1A; color: #7B1A1A; }
</style>
