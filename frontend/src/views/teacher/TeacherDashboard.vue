<template>
  <div class="flex" style="min-height:100vh;background:#f8f9fa;">
    <TeacherSidebar @new-announcement="showAnnouncementDialog = true" />

    <!-- Right column -->
    <div class="flex-1 flex flex-col" style="overflow:hidden;">

      <!-- Top header bar -->
      <header class="flex items-center justify-between px-8 py-4 bg-white border-b" style="border-color:#e5e7eb;">
        <h1 class="text-2xl font-bold" style="color:#1a1a1a;margin:0;">{{ t('teacher.academics') }}</h1>

        <div class="flex items-center gap-4">
          <!-- Search -->
          <div class="flex items-center gap-2 rounded-lg px-4 py-2" style="background:#f3f4f6;min-width:320px;">
            <i class="pi pi-search" style="color:#9ca3af;font-size:0.875rem;"></i>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search courses, students, or documents..."
              class="bg-transparent border-0 outline-0 text-sm flex-1"
              style="color:#374151;font-size:0.875rem;"
            />
          </div>

          <!-- Icons -->
          <button class="icon-btn"><i class="pi pi-bell" style="font-size:1.1rem;color:#6b7280;"></i></button>
          <button class="icon-btn"><i class="pi pi-question-circle" style="font-size:1.1rem;color:#6b7280;"></i></button>

          <!-- User -->
          <div class="flex items-center gap-3 pl-3" style="border-left:1px solid #e5e7eb;">
            <div class="text-right">
              <div class="text-sm font-semibold" style="color:#111827;line-height:1.2;">
                {{ auth.user?.full_name || auth.user?.name || 'Professor' }}
              </div>
              <div class="text-xs" style="color:#6b7280;">{{ roleLabel }}</div>
            </div>
            <div class="flex items-center justify-center rounded-full font-bold text-sm text-white"
                 style="width:38px;height:38px;background:#6B1010;flex-shrink:0;">
              {{ userInitials }}
            </div>
          </div>
        </div>
      </header>

      <!-- Main content -->
      <main class="flex-1 p-8" style="overflow-y:auto;">

        <!-- Welcome banner -->
        <div class="relative rounded-2xl mb-8 overflow-hidden"
             style="background:#6B1010;padding:2.5rem 2.5rem 2.5rem 2.5rem;min-height:160px;">
          <!-- Decorative circles -->
          <div class="absolute" style="right:-20px;top:-40px;width:220px;height:220px;border-radius:50%;background:rgba(255,255,255,0.08);"></div>
          <div class="absolute" style="right:60px;top:20px;width:160px;height:160px;border-radius:50%;background:rgba(255,255,255,0.06);"></div>

          <div class="relative" style="max-width:600px;">
            <h2 class="font-bold mb-2" style="color:#fff;font-size:2rem;line-height:1.2;margin:0 0 0.75rem;">
              {{ t('teacher.welcomeBack') }}
            </h2>
            <p class="mb-5" style="color:rgba(255,255,255,0.8);font-size:0.95rem;margin:0 0 1.5rem;line-height:1.5;">
              {{ t('teacher.welcomeDesc') }}
            </p>
            <div class="flex gap-3">
              <button class="banner-btn banner-btn--outline" @click="router.push('/teacher/grading')">{{ t('teacher.viewSemesterPlan') }}</button>
              <button class="banner-btn banner-btn--outline" @click="exportCSV">{{ t('teacher.downloadSyllabus') }}</button>
            </div>
          </div>
        </div>

        <!-- Stat cards -->
        <div class="grid gap-5 mb-8" style="grid-template-columns:repeat(4,1fr);">
          <template v-if="loading">
            <div v-for="i in 4" :key="i" class="bg-white rounded-xl p-6 animate-pulse" style="border:1px solid #e5e7eb;">
              <div style="height:36px;width:36px;background:#f3f4f6;border-radius:8px;margin-bottom:16px;"></div>
              <div style="height:28px;width:60px;background:#f3f4f6;border-radius:4px;margin-bottom:8px;"></div>
              <div style="height:14px;width:100px;background:#f9fafb;border-radius:4px;"></div>
            </div>
          </template>
          <template v-else>
            <div v-for="card in statCards" :key="card.label"
                 class="bg-white rounded-xl p-6" style="border:1px solid #e5e7eb;">
              <div class="flex items-center justify-between mb-4">
                <div class="flex items-center justify-center rounded-lg stat-icon-box"
                     :style="{ width:'42px', height:'42px', background: card.iconBg }">
                  <span v-html="card.svgIcon"></span>
                </div>
              </div>
              <div class="font-extrabold" style="font-size:1.875rem;color:#111827;line-height:1;">{{ card.value }}</div>
              <div class="mt-1 text-sm" style="color:#6b7280;">{{ card.label }}</div>
            </div>
          </template>
        </div>

        <!-- Student Progress -->
        <div class="bg-white rounded-xl mb-6" style="border:1px solid #e5e7eb;overflow:hidden;">
          <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid #e5e7eb;">
            <h3 class="font-semibold" style="color:#111827;font-size:1rem;margin:0;">{{ t('teacher.studentProgress') }}</h3>
            <RouterLink to="/teacher/students" class="text-sm font-medium" style="color:#6B1010;">{{ t('teacher.viewAll') }}</RouterLink>
          </div>
          <div v-if="studentsLoading" class="p-6 space-y-3">
            <div v-for="i in 4" :key="i" class="animate-pulse" style="height:52px;background:#f9fafb;border-radius:8px;"></div>
          </div>
          <table v-else class="w-full">
            <thead>
              <tr style="background:#f9fafb;">
                <th class="activity-th">{{ t('teacher.studentCol') }}</th>
                <th class="activity-th">{{ t('teacher.courseCol') }}</th>
                <th class="activity-th">{{ t('teacher.colLessons') }}</th>
                <th class="activity-th" style="min-width:180px;">{{ t('teacher.progressCol') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="students.length === 0">
                <td colspan="4" class="text-center py-8 text-sm" style="color:#9ca3af;">No students enrolled yet</td>
              </tr>
              <tr v-for="s in students.slice(0, 8)" :key="s.student_id + '-' + s.course_id" class="activity-row">
                <td class="activity-td">
                  <div class="flex items-center gap-3">
                    <div v-if="s.avatar_url"
                         class="rounded-full flex-shrink-0"
                         style="width:32px;height:32px;overflow:hidden;">
                      <img :src="s.avatar_url" style="width:100%;height:100%;object-fit:cover;" />
                    </div>
                    <div v-else class="flex items-center justify-center rounded-full flex-shrink-0 text-xs font-bold text-white"
                         style="width:32px;height:32px;background:#6B1010;">
                      {{ (s.student_name || '?').slice(0,2).toUpperCase() }}
                    </div>
                    <div>
                      <div class="text-sm font-medium" style="color:#111827;">{{ s.student_name }}</div>
                      <div class="text-xs" style="color:#9ca3af;">{{ s.email }}</div>
                    </div>
                  </div>
                </td>
                <td class="activity-td text-sm" style="color:#374151;">{{ s.course_title }}</td>
                <td class="activity-td text-sm" style="color:#6b7280;">{{ s.completed_lessons }}/{{ s.total_lessons }}</td>
                <td class="activity-td">
                  <div class="flex items-center gap-2">
                    <div style="flex:1;height:6px;background:#f3f4f6;border-radius:9999px;overflow:hidden;">
                      <div :style="{ width: s.progress + '%', background: '#6B1010', height: '100%', borderRadius: '9999px', transition: 'width .4s' }"></div>
                    </div>
                    <span class="text-xs font-semibold" style="color:#6B1010;min-width:36px;text-align:right;">{{ s.progress }}%</span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Bottom section: Recent Activity + Quick Actions -->
        <div class="flex gap-6">

          <!-- Recent Activity -->
          <div class="bg-white rounded-xl flex-1" style="border:1px solid #e5e7eb;overflow:hidden;">
            <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid #e5e7eb;">
              <h3 class="font-semibold" style="color:#111827;font-size:1rem;margin:0;">{{ t('teacher.recentActivity') }}</h3>
              <RouterLink to="/teacher/courses" class="text-sm font-medium" style="color:#6B1010;">{{ t('teacher.viewAll') }}</RouterLink>
            </div>

            <div v-if="coursesLoading" class="p-6 space-y-3">
              <div v-for="i in 4" :key="i" class="animate-pulse" style="height:48px;background:#f9fafb;border-radius:8px;"></div>
            </div>

            <table v-else class="w-full">
              <thead>
                <tr style="background:#f9fafb;">
                  <th class="activity-th">{{ t('teacher.studentCol') }}</th>
                  <th class="activity-th">{{ t('teacher.colAssignment') }}</th>
                  <th class="activity-th">{{ t('teacher.colDate') }}</th>
                  <th class="activity-th">{{ t('teacher.statusCol') }}</th>
                  <th class="activity-th"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="recentActivity.length === 0">
                  <td colspan="5" class="text-center py-8 text-sm" style="color:#9ca3af;">No recent activity yet</td>
                </tr>
                <tr v-for="item in recentActivity" :key="item.id" class="activity-row">
                  <td class="activity-td">
                    <div class="flex items-center gap-2">
                      <div class="flex items-center justify-center rounded-full text-xs font-bold text-white flex-shrink-0"
                           style="width:28px;height:28px;background:#6B1010;">
                        {{ (item.studentName || '?').slice(0,2).toUpperCase() }}
                      </div>
                      <span class="text-sm font-medium" style="color:#111827;">{{ item.studentName }}</span>
                    </div>
                  </td>
                  <td class="activity-td text-sm" style="color:#374151;max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ item.assignment }}</td>
                  <td class="activity-td text-sm" style="color:#6b7280;white-space:nowrap;">{{ item.date }}</td>
                  <td class="activity-td">
                    <span class="activity-badge" :class="`activity-badge--${item.statusKey}`">{{ item.status }}</span>
                  </td>
                  <td class="activity-td">
                    <RouterLink v-if="item.statusKey === 'submitted'"
                                :to="`/teacher/grading/${item.id}`"
                                class="text-xs font-semibold"
                                style="color:#6B1010;white-space:nowrap;">
                      Grade →
                    </RouterLink>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Right panel -->
          <div class="flex flex-col gap-5" style="width:280px;flex-shrink:0;">

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl p-5" style="border:1px solid #e5e7eb;">
              <h3 class="font-semibold mb-4" style="color:#111827;font-size:1rem;margin:0 0 1rem;">{{ t('teacher.quickActions') }}</h3>
              <div class="flex flex-col gap-3">
                <button v-for="action in quickActions" :key="action.label"
                        class="flex items-center gap-3 rounded-xl p-3 text-left w-full transition-colors quick-action-btn"
                        @click="action.handler">
                  <div class="flex items-center justify-center rounded-lg flex-shrink-0"
                       style="width:36px;height:36px;background:#fef2f2;">
                    <i :class="`pi ${action.icon}`" style="color:#6B1010;font-size:1rem;"></i>
                  </div>
                  <div>
                    <div class="text-sm font-semibold" style="color:#111827;">{{ action.label }}</div>
                    <div class="text-xs" style="color:#9ca3af;">{{ action.description }}</div>
                  </div>
                </button>
              </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="bg-white rounded-xl p-5" style="border:1px solid #e5e7eb;">
              <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold" style="color:#111827;font-size:1rem;margin:0;">{{ t('teacher.upcomingDeadlines') }}</h3>
                <i class="pi pi-calendar" style="color:#9ca3af;font-size:0.95rem;"></i>
              </div>
              <div class="flex flex-col gap-4">
                <div v-for="d in upcomingDeadlines" :key="d.label" class="flex gap-3">
                  <div class="flex flex-col items-center justify-center rounded-lg flex-shrink-0 text-center"
                       style="width:44px;height:44px;background:#fef2f2;">
                    <div class="text-xs font-bold uppercase" style="color:#6B1010;line-height:1;">{{ d.month }}</div>
                    <div class="font-extrabold" style="color:#6B1010;font-size:1rem;line-height:1;">{{ d.day }}</div>
                  </div>
                  <div>
                    <div class="text-sm font-semibold" style="color:#111827;">{{ d.label }}</div>
                    <div class="text-xs" style="color:#9ca3af;">{{ d.sub }}</div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- Announcement dialog -->
  <Teleport to="body">
    <div v-if="showAnnouncementDialog"
         class="fixed inset-0 flex items-center justify-center"
         style="background:rgba(0,0,0,0.45);z-index:9999;"
         @click.self="showAnnouncementDialog = false">
      <div class="bg-white rounded-2xl p-6 flex flex-col gap-4" style="width:480px;max-width:95vw;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
        <div class="flex items-center justify-between">
          <h3 class="font-bold text-base" style="color:#111827;margin:0;">Create New Post</h3>
          <button class="icon-btn" @click="showAnnouncementDialog = false">
            <i class="pi pi-times" style="color:#6b7280;"></i>
          </button>
        </div>
        <input
          v-model="announcementTitle"
          type="text"
          placeholder="Post title…"
          class="rounded-lg px-4 py-2 text-sm border outline-0"
          style="border-color:#e5e7eb;color:#111827;"
        />
        <textarea
          v-model="announcementBody"
          rows="4"
          placeholder="Write your announcement here…"
          class="rounded-lg px-4 py-2 text-sm border outline-0 resize-none"
          style="border-color:#e5e7eb;color:#111827;"
        ></textarea>
        <div class="flex justify-end gap-2">
          <button class="banner-btn" style="background:#f3f4f6;color:#374151;border:none;"
                  @click="showAnnouncementDialog = false">Cancel</button>
          <button class="banner-btn" style="background:#7B1A1A;color:#fff;border:none;"
                  @click="submitAnnouncement"
                  :disabled="!announcementTitle.trim()">Publish</button>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import TeacherSidebar from '@/components/teacher/TeacherSidebar.vue'
import { teacherApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const { t } = useI18n()
const auth   = useAuthStore()
const router = useRouter()

const loading        = ref(true)
const coursesLoading = ref(true)
const studentsLoading = ref(true)
const searchQuery    = ref('')

const showAnnouncementDialog = ref(false)
const announcementTitle      = ref('')
const announcementBody       = ref('')

let coursesCache = []

const statCards = ref([])
const recentActivity = ref([])
const students = ref([])

const roleLabel = computed(() => {
  if (auth.isAdmin) return t('teacher.roleAdmin')
  if (auth.isTeacher) return t('teacher.roleSenior')
  return t('teacher.roleTeacher')
})

const userInitials = computed(() => {
  const name = auth.user?.full_name || auth.user?.name || ''
  return name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2) || 'TP'
})

const IC_PEOPLE = `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 22 16" fill="#570013"><path d="M0 16V13.2C0 12.6333 0.145833 12.1125 0.4375 11.6375C0.729167 11.1625 1.11667 10.8 1.6 10.55C2.63333 10.0333 3.68333 9.64583 4.75 9.3875C5.81667 9.12917 6.9 9 8 9C9.1 9 10.1833 9.12917 11.25 9.3875C12.3167 9.64583 13.3667 10.0333 14.4 10.55C14.8833 10.8 15.2708 11.1625 15.5625 11.6375C15.8542 12.1125 16 12.6333 16 13.2V16H0ZM18 16V13C18 12.2667 17.7958 11.5625 17.3875 10.8875C16.9792 10.2125 16.4 9.63333 15.65 9.15C16.5 9.25 17.3 9.42083 18.05 9.6625C18.8 9.90417 19.5 10.2 20.15 10.55C20.75 10.8833 21.2083 11.2542 21.525 11.6625C21.8417 12.0708 22 12.5167 22 13V16H18ZM8 8C6.9 8 5.95833 7.60833 5.175 6.825C4.39167 6.04167 4 5.1 4 4C4 2.9 4.39167 1.95833 5.175 1.175C5.95833 0.391667 6.9 0 8 0C9.1 0 10.0417 0.391667 10.825 1.175C11.6083 1.95833 12 2.9 12 4C12 5.1 11.6083 6.04167 10.825 6.825C10.0417 7.60833 9.1 8 8 8ZM18 4C18 5.1 17.6083 6.04167 16.825 6.825C16.0417 7.60833 15.1 8 14 8C13.8167 8 13.5833 7.97917 13.3 7.9375C13.0167 7.89583 12.7833 7.85 12.6 7.8C13.05 7.26667 13.3958 6.675 13.6375 6.025C13.8792 5.375 14 4.7 14 4C14 3.3 13.8792 2.625 13.6375 1.975C13.3958 1.325 13.05 0.733333 12.6 0.2C12.8333 0.116667 13.0667 0.0625 13.3 0.0375C13.5333 0.0125 13.7667 0 14 0C15.1 0 16.0417 0.391667 16.825 1.175C17.6083 1.95833 18 2.9 18 4ZM2 14H14V13.2C14 13.0167 13.9542 12.85 13.8625 12.7C13.7708 12.55 13.65 12.4333 13.5 12.35C12.6 11.9 11.6917 11.5625 10.775 11.3375C9.85833 11.1125 8.93333 11 8 11C7.06667 11 6.14167 11.1125 5.225 11.3375C4.30833 11.5625 3.4 11.9 2.5 12.35C2.35 12.4333 2.22917 12.55 2.1375 12.7C2.04583 12.85 2 13.0167 2 13.2V14ZM8 6C8.55 6 9.02083 5.80417 9.4125 5.4125C9.80417 5.02083 10 4.55 10 4C10 3.45 9.80417 2.97917 9.4125 2.5875C9.02083 2.19583 8.55 2 8 2C7.45 2 6.97917 2.19583 6.5875 2.5875C6.19583 2.97917 6 3.45 6 4C6 4.55 6.19583 5.02083 6.5875 5.4125C6.97917 5.80417 7.45 6 8 6Z"/></svg>`

const IC_GRADING = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="#570013"><path d="M6.5 16C5.95 16 5.47917 15.8042 5.0875 15.4125C4.69583 15.0208 4.5 14.55 4.5 14V11H7.5V8.75C6.91667 8.71667 6.3625 8.5875 5.8375 8.3625C5.3125 8.1375 4.83333 7.8 4.4 7.35V6.25H3.25L0 3C0.6 2.23333 1.34167 1.69167 2.225 1.375C3.10833 1.05833 4 0.9 4.9 0.9C5.35 0.9 5.7875 0.933333 6.2125 1C6.6375 1.06667 7.06667 1.19167 7.5 1.375V0H19.5V13C19.5 13.8333 19.2083 14.5417 18.625 15.125C18.0417 15.7083 17.3333 16 16.5 16H6.5ZM9.5 11H15.5V13C15.5 13.2833 15.5958 13.5208 15.7875 13.7125C15.9792 13.9042 16.2167 14 16.5 14C16.7833 14 17.0208 13.9042 17.2125 13.7125C17.4042 13.5208 17.5 13.2833 17.5 13V2H9.5V2.6L15.5 8.6V10H14.1L11.25 7.15L11.05 7.35C10.8167 7.58333 10.5708 7.79167 10.3125 7.975C10.0542 8.15833 9.78333 8.3 9.5 8.4V11ZM4.1 4.25H6.4V6.4C6.6 6.53333 6.80833 6.625 7.025 6.675C7.24167 6.725 7.46667 6.75 7.7 6.75C8.08333 6.75 8.42917 6.69167 8.7375 6.575C9.04583 6.45833 9.35 6.25 9.65 5.95L9.85 5.75L8.45 4.35C7.96667 3.86667 7.425 3.50417 6.825 3.2625C6.225 3.02083 5.58333 2.9 4.9 2.9C4.56667 2.9 4.25 2.925 3.95 2.975C3.65 3.025 3.35 3.1 3.05 3.2L4.1 4.25ZM13.5 13H6.5V14H13.65C13.6 13.85 13.5625 13.6917 13.5375 13.525C13.5125 13.3583 13.5 13.1833 13.5 13ZM6.5 14C6.5 13.85 6.5 13.6917 6.5 13.525C6.5 13.3583 6.5 13.1833 6.5 13C6.5 13.1667 6.5 13.3333 6.5 13.5C6.5 13.6667 6.5 13.8333 6.5 14Z"/></svg>`

const IC_ENVELOPE = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="#570013"><path d="M2 16C1.45 16 0.979167 15.8042 0.5875 15.4125C0.195833 15.0208 0 14.55 0 14V2C0 1.45 0.195833 0.979167 0.5875 0.5875C0.979167 0.195833 1.45 0 2 0H18C18.55 0 19.0208 0.195833 19.4125 0.5875C19.8042 0.979167 20 1.45 20 2V14C20 14.55 19.8042 15.0208 19.4125 15.4125C19.0208 15.8042 18.55 16 18 16H2ZM10 9L2 4V14H18V4L10 9ZM10 7L18 2H2L10 7ZM2 4V2V4V14V4Z"/></svg>`

const IC_TRENDING = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12" fill="#570013"><path d="M1.4 12L0 10.6L7.4 3.15L11.4 7.15L16.6 2H14V0H20V6H18V3.4L11.4 10L7.4 6L1.4 12Z"/></svg>`


const upcomingDeadlines = ref([])

function exportCSV() {
  const headers = ['Course', 'Subject', 'Level', 'Published', 'Enrolled']
  const rows = coursesCache.map(c => [
    `"${c.title}"`, c.subject || '', c.level || '',
    c.is_published ? 'Yes' : 'No', c.enrolled_count ?? '',
  ])
  const csv = [headers.join(','), ...rows.map(r => r.join(','))].join('\n')
  const a   = Object.assign(document.createElement('a'), {
    href: URL.createObjectURL(new Blob([csv], { type: 'text/csv' })),
    download: 'courses-report.csv',
  })
  a.click()
}

function submitAnnouncement() {
  if (!announcementTitle.value.trim()) return
  // Reset and close — real sending can be added when an announcements API exists
  announcementTitle.value = ''
  announcementBody.value  = ''
  showAnnouncementDialog.value = false
}

const quickActions = computed(() => [
  { icon: 'pi-file-edit', label: t('teacher.createPost'),    description: t('teacher.createPostSub'),    handler: () => { showAnnouncementDialog.value = true } },
  { icon: 'pi-sliders-h', label: t('teacher.bulkGrade'),     description: t('teacher.bulkGradeSub'),     handler: () => router.push('/teacher/grading') },
  { icon: 'pi-download',  label: t('teacher.exportReports'), description: t('teacher.exportReportsSub'), handler: exportCSV },
])

onMounted(async () => {
  try {
    const [statsRes, coursesRes, subsRes, studentsRes] = await Promise.all([
      teacherApi.stats(),
      teacherApi.myCourses(),
      teacherApi.allSubmissions(),
      teacherApi.students(),
    ])

    const s = statsRes.data.data
    statCards.value = [
      { label: t('teacher.totalStudents'),   value: s.total_enrolled,                               svgIcon: IC_PEOPLE,   iconBg: '#fef2f2' },
      { label: t('teacher.pendingGradings'), value: s.pending_gradings,                             svgIcon: IC_GRADING,  iconBg: '#fef2f2' },
      { label: t('teacher.unreadMessages'),  value: String(s.unread_messages).padStart(2, '0'),     svgIcon: IC_ENVELOPE, iconBg: '#fef2f2' },
      { label: t('teacher.avgProgress'),     value: s.avg_progress + '%',                           svgIcon: IC_TRENDING, iconBg: '#fef2f2' },
    ]
    loading.value = false

    students.value = studentsRes.data.data || []
    studentsLoading.value = false

    // Cache courses for CSV export
    coursesCache = coursesRes.data.data || []

    // Upcoming deadlines — 2 oldest pending (ungraded) submissions
    const subs = subsRes.data.data || []
    const pending = subs.filter(s => s.status === 'submitted' || !s.score)
    const sorted = [...pending].sort((a, b) => b.hours_ago - a.hours_ago).slice(0, 2)
    upcomingDeadlines.value = sorted.map(s => {
      const d = new Date(s.submitted_at)
      return {
        month: d.toLocaleString('en-US', { month: 'short' }).toUpperCase(),
        day:   String(d.getDate()).padStart(2, '0'),
        label: s.homework_title || s.course_title,
        sub:   s.course_title + ' · overdue',
      }
    })

    const statusLabel = { submitted: 'Pending', graded: 'Graded', revision_requested: 'Revision' }
    const statusKey   = { submitted: 'submitted', graded: 'graded', revision_requested: 'in-review' }
    recentActivity.value = subs.slice(0, 8).map(s => ({
      id:          s.id,
      studentName: s.student_name,
      assignment:  s.homework_title,
      course:      s.course_title,
      date:        new Date(s.submitted_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }),
      status:      statusLabel[s.status] ?? 'Pending',
      statusKey:   statusKey[s.status]   ?? 'submitted',
    }))
    coursesLoading.value = false
  } catch {
    loading.value = false
    coursesLoading.value = false
    studentsLoading.value = false
  }
})
</script>

<style scoped>
.stat-icon-box span { display:flex; align-items:center; justify-content:center; }
.stat-icon-box svg  { display:block; }

.icon-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border: none;
  background: transparent;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.15s;
}
.icon-btn:hover { background: #f3f4f6; }

.banner-btn {
  border: none;
  border-radius: 8px;
  padding: 0.55rem 1.25rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.15s, color 0.15s;
}
.banner-btn--outline {
  background: rgba(255,255,255,0.15);
  color: #fff;
  border: 1.5px solid rgba(255,255,255,0.4);
}
.banner-btn--outline:hover { background: rgba(255,255,255,0.25); }

.activity-th {
  padding: 0.65rem 1.25rem;
  text-align: left;
  font-size: 0.75rem;
  font-weight: 600;
  color: #6b7280;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.activity-td {
  padding: 0.85rem 1.25rem;
}
.activity-row {
  border-top: 1px solid #f3f4f6;
  transition: background 0.1s;
}
.activity-row:hover { background: #fafafa; }

.activity-badge {
  display: inline-flex;
  align-items: center;
  padding: 0.25rem 0.65rem;
  border-radius: 9999px;
  font-size: 0.75rem;
  font-weight: 600;
}
.activity-badge--published { background: #dcfce7; color: #15803d; }
.activity-badge--draft     { background: #f3f4f6; color: #6b7280; }
.activity-badge--submitted { background: #fce7f3; color: #be185d; }
.activity-badge--graded    { background: #dcfce7; color: #15803d; }
.activity-badge--in-review { background: #f3f4f6; color: #6b7280; }

.quick-action-btn {
  background: transparent;
  border: 1px solid #f3f4f6;
  cursor: pointer;
}
.quick-action-btn:hover { background: #fef2f2; border-color: #fecaca; }
</style>
