<template>
  <div class="lms-wrap">

    <!-- ── Left Sidebar ─────────────────────────────────────── -->
    <aside class="lms-sidebar">
      <!-- <div class="sidebar-logo">
        <img src="@/assets/logo.png" alt="Bridge" class="sidebar-logo-img" />
      </div> -->

      <nav class="sidebar-nav">
        <RouterLink to="/dashboard" class="nav-item" active-class="nav-item--active">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#cd-home)">
              <path d="M6.56 11.61a4.55 4.55 0 110-9.09 4.55 4.55 0 010 9.09zm.51 10.1a4.55 4.55 0 110-9.1 4.55 4.55 0 010 9.1zm10.1-10.1a4.55 4.55 0 110-9.09 4.55 4.55 0 010 9.09zm0 10.1a4.55 4.55 0 110-9.1 4.55 4.55 0 010 9.1z" fill="currentColor"/>
            </g>
            <defs><clipPath id="cd-home"><rect width="24.24" height="24.24" fill="white"/></clipPath></defs>
          </svg>
          <span>Home</span>
        </RouterLink>

        <RouterLink to="/courses" class="nav-item nav-item--active">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z" fill="currentColor"/>
          </svg>
          <span>Courses</span>
        </RouterLink>

        <RouterLink to="/student/progress" class="nav-item" active-class="nav-item--active">
          <svg width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M6 13H2a1 1 0 00-1 1v8a1 1 0 001 1h4a1 1 0 001-1v-8a1 1 0 00-1-1zm-1 8H3v-6h2v6zm17-12h-4a1 1 0 00-1 1v12a1 1 0 001 1h4a1 1 0 001-1V10a1 1 0 00-1-1zm-1 12h-2v-10h2v10zM14 1h-4a1 1 0 00-1 1v20a1 1 0 001 1h4a1 1 0 001-1V2a1 1 0 00-1-1zm-1 20h-2V3h2v18z" fill="currentColor"/>
          </svg>
          <span>Progress</span>
        </RouterLink>

        <RouterLink to="/student/messages" class="nav-item" active-class="nav-item--active">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#cd-msg)">
              <path d="M7.36 21.03l-4.18.93a.5.5 0 01-.6-.6l.93-4.18A10.1 10.1 0 012.02 12.12a10.1 10.1 0 1110.1 10.1c-1.66.002-3.29-.408-4.76-1.19zm.3-2.13l.66.35a8.18 8.18 0 004.76 1.5 8.18 8.18 0 000-16.36 8.18 8.18 0 000 16.36 8.18 8.18 0 01-4.76-1.5l-.66-.35-.56 2.51a.25.25 0 00.3.3l2.51-.56z" fill="currentColor"/>
            </g>
            <defs><clipPath id="cd-msg"><rect width="24.24" height="24.24" fill="white"/></clipPath></defs>
          </svg>
          <span>Messages</span>
        </RouterLink>

        <RouterLink to="/student/settings" class="nav-item" active-class="nav-item--active">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <path d="M21.53 9.64l-1.91-.64.9-1.8a.5.5 0 00-.1-.57l-2.15-2.15a.5.5 0 00-.57-.1l-1.8.9-.64-1.91a.5.5 0 00-.47-.33h-3.03a.5.5 0 00-.47.33l-.64 1.91-1.8-.9a.5.5 0 00-.57.1L6.06 6.63a.5.5 0 00-.1.57l.9 1.8-1.91.64a.5.5 0 00-.33.47v3.03a.5.5 0 00.33.47l1.91.64-.9 1.8a.5.5 0 00.1.57l2.15 2.15a.5.5 0 00.57.1l1.8-.9.64 1.91a.5.5 0 00.47.33h3.03a.5.5 0 00.47-.33l.64-1.91 1.8.9a.5.5 0 00.57-.1l2.15-2.15a.5.5 0 00.1-.57l-.9-1.8 1.91-.64a.5.5 0 00.33-.47v-3.03a.5.5 0 00-.33-.47zM12.12 15.16a3.04 3.04 0 110-6.08 3.04 3.04 0 010 6.08z" fill="currentColor"/>
          </svg>
          <span>Settings</span>
        </RouterLink>

      </nav>

      <!-- Support 24/7 card -->
      <div class="support-card">
        <h4 class="support-title">Support 24/7</h4>
        <p class="support-sub">Contacts us anytime</p>
        <a class="support-btn" href="https://wa.me/87766253784" target="_blank" rel="noopener">Start</a>
        <div class="support-art">
          <svg width="110" height="80" viewBox="0 0 110 80" fill="none">
            <ellipse cx="60" cy="74" rx="36" ry="5" fill="#f9c6c6" opacity="0.5"/>
            <rect x="22" y="52" width="76" height="6" rx="3" fill="#e57373"/>
            <rect x="30" y="58" width="6" height="16" rx="2" fill="#c62828"/>
            <rect x="82" y="58" width="6" height="16" rx="2" fill="#c62828"/>
            <rect x="48" y="28" width="34" height="24" rx="3" fill="#1e293b"/>
            <rect x="51" y="31" width="28" height="18" rx="2" fill="#3b82f6" opacity="0.8"/>
            <rect x="62" y="52" width="10" height="4" fill="#1e293b"/>
            <rect x="58" y="55" width="18" height="2" rx="1" fill="#1e293b"/>
            <rect x="14" y="35" width="10" height="22" rx="5" fill="#b91c1c"/>
            <rect x="20" y="46" width="18" height="14" rx="4" fill="#7f1d1d"/>
            <circle cx="29" cy="38" r="8" fill="#fcd5b0"/>
            <path d="M21 36 Q29 28 37 36" fill="#1e293b"/>
            <path d="M20 52 Q16 56 20 60" stroke="#fcd5b0" stroke-width="4" stroke-linecap="round"/>
            <path d="M38 52 Q44 54 48 50" stroke="#fcd5b0" stroke-width="4" stroke-linecap="round"/>
            <rect x="42" y="50" width="14" height="3" rx="1" fill="#94a3b8"/>
          </svg>
        </div>
      </div>

      <button class="nav-item nav-item--logout" @click="handleLogout">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
          <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <polyline points="16 17 21 12 16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <line x1="21" y1="12" x2="9" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span>Log out</span>
      </button>
    </aside>

    <!-- ── Main White Panel ──────────────────────────────────── -->
    <div class="lms-panel">

      <!-- Top bar -->
      <header class="lms-topbar">
        <div class="topbar-search">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
            <circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2"/>
            <path d="M21 21l-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <input type="text" placeholder="Search..." class="search-input"/>
        </div>
        <div class="topbar-right">
          <template v-if="auth.isLoggedIn">
            <div class="topbar-user" @click="router.push('/student/settings')">
              <div class="user-avatar">{{ userInitial }}</div>
              <span class="user-name">{{ auth.user?.name || 'Student' }}</span>
            </div>
          </template>
          <template v-else>
            <RouterLink to="/login" class="btn-login">Login</RouterLink>
          </template>
        </div>
      </header>

      <!-- Loading -->
      <div v-if="loading" class="center-spinner">
        <div class="spinner"></div>
      </div>

      <!-- Course layout (mirrors LessonView) -->
      <div v-else-if="course" class="content-grid">

        <!-- ── Left: Main content ──────────────────────────── -->
        <main class="lesson-main">

          <!-- Breadcrumb -->
          <nav class="breadcrumb">
            <RouterLink to="/courses" class="bc-link">Courses</RouterLink>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
              <path d="M9 18l6-6-6-6" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span v-if="course.subject" class="bc-link">{{ course.subject }}</span>
            <svg v-if="course.subject" width="12" height="12" viewBox="0 0 24 24" fill="none">
              <path d="M9 18l6-6-6-6" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="bc-active">{{ course.title }}</span>
          </nav>

          <!-- Title + subtitle -->
          <h1 class="lesson-h1">{{ course.title }}</h1>
          <p class="lesson-desc">{{ course.description }}</p>

          <!-- Video / thumbnail -->
          <div class="video-box">
            <video v-if="course.first_video_url"
                   controls
                   :src="course.first_video_url"
                   :poster="course.cover_image || undefined"
                   class="video-el">
            </video>
            <div v-else-if="course.cover_image" class="video-placeholder video-placeholder--img"
                 :style="{ backgroundImage: `url(${course.cover_image})` }">
              <div class="play-circle">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="white">
                  <path d="M5 3l14 9-14 9V3z"/>
                </svg>
              </div>
            </div>
            <div v-else class="video-placeholder">
              <div class="play-circle">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="white">
                  <path d="M5 3l14 9-14 9V3z"/>
                </svg>
              </div>
            </div>
          </div>

          <!-- Tab bar -->
          <div class="tab-bar">
            <button v-for="tab in tabs" :key="tab.key"
                    class="tab" :class="{ 'tab--active': activeTab === tab.key }"
                    @click="activeTab = tab.key">
              {{ tab.label }}
              <span v-if="tab.badge" class="tab-badge">{{ tab.badge }}</span>
            </button>
          </div>

          <!-- Tab: Overview -->
          <div v-if="activeTab === 'overview'" class="tab-panel">
            <div class="materials-grid">
              <!-- Stats card -->
              <div class="mat-card">
                <div class="mat-ico mat-ico--red">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="3" width="18" height="18" rx="2" stroke="#dc2626" stroke-width="2"/>
                    <path d="M3 9h18M9 21V9" stroke="#dc2626" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </div>
                <div class="mat-info">
                  <span class="mat-name">{{ course.modules?.length ?? 0 }} Modules</span>
                  <span class="mat-meta">{{ totalLessons }} total lessons</span>
                </div>
              </div>
              <!-- Level card -->
              <div class="mat-card">
                <div class="mat-ico mat-ico--blue">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
                <div class="mat-info">
                  <span class="mat-name">{{ course.level || 'All Levels' }}</span>
                  <span class="mat-meta">{{ course.subject || 'General' }}</span>
                </div>
              </div>
            </div>
            <div v-if="course.description" class="overview-body">
              <h3 class="overview-heading">About this course</h3>
              <p class="overview-text">{{ course.description }}</p>
            </div>
          </div>

          <!-- Tab: Curriculum -->
          <div v-else-if="activeTab === 'curriculum'" class="tab-panel">
            <div class="modules-list">
              <div v-for="(mod, mi) in course.modules" :key="mod.id" class="module-block">
                <button class="module-header" @click="toggleMod(mod.id)">
                  <div class="mod-left">
                    <span class="mod-num">{{ mi + 1 }}</span>
                    <span class="mod-title">{{ mod.title }}</span>
                  </div>
                  <div class="mod-right">
                    <span class="mod-count">{{ mod.lessons?.length ?? 0 }} lessons</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                         :style="{ transform: openMods.has(mod.id) ? 'rotate(180deg)' : '', transition: 'transform .2s' }">
                      <path d="M6 9l6 6 6-6" stroke="#6b7280" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                  </div>
                </button>
                <div v-if="openMods.has(mod.id)" class="mod-lessons">
                  <div v-for="lesson in mod.lessons" :key="lesson.id"
                       class="cur-lesson"
                       @click="openLesson(lesson)">
                    <div class="cur-icon"
                         :class="isCompleted(lesson.id) ? 'ci--green' : 'ci--red'">
                      <svg v-if="isCompleted(lesson.id)" width="11" height="11" viewBox="0 0 24 24" fill="none">
                        <polyline points="20 6 9 17 4 12" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round"/>
                      </svg>
                      <svg v-else width="9" height="9" viewBox="0 0 24 24" fill="#fff">
                        <path d="M5 3l14 9-14 9V3z"/>
                      </svg>
                    </div>
                    <div class="cur-text">
                      <span class="cur-label">Lesson {{ lesson.order_num }}</span>
                      <span class="cur-name" :class="{ 'cur-name--done': isCompleted(lesson.id) }">{{ lesson.title }}</span>
                    </div>
                    <span v-if="lesson.is_free_preview" class="free-tag">Free</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tab: Reviews -->
          <div v-else-if="activeTab === 'reviews'" class="tab-panel">
            <div class="empty-tab">
              <svg width="36" height="36" viewBox="0 0 24 24" fill="none">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round"/>
              </svg>
              No reviews yet.
            </div>
          </div>

          <!-- Footer: price + enroll -->
          <div class="lesson-footer">
            <RouterLink to="/courses" class="btn-prev">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              Back to Courses
            </RouterLink>

            <template v-if="isEnrolled">
              <button class="btn-complete" @click="continueLesson">
                {{ t('student.continueLearning') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                  <path d="M5 3l14 9-14 9V3z" fill="currentColor"/>
                </svg>
              </button>
            </template>
            <template v-else>
              <div class="footer-enroll">
                <span class="footer-price">{{ course.price > 0 ? `${course.price} ₸` : t('common.free') }}</span>
                <button class="btn-complete" :disabled="enrolling || !auth.isLoggedIn" @click="handleEnroll">
                  <svg v-if="enrolling" class="spin-icon" width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="9" stroke="rgba(255,255,255,.4)" stroke-width="2"/>
                    <path d="M12 3a9 9 0 019 9" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                  {{ enrolling ? t('student.enrolling') : t('student.enrollCourse') }}
                  <svg v-if="!enrolling" width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="22 4 12 14.01 9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </button>
                <RouterLink v-if="!auth.isLoggedIn" to="/login" class="btn-login-small">{{ t('student.loginToEnroll') }}</RouterLink>
              </div>
            </template>
          </div>
        </main>

        <!-- ── Right: Course Curriculum panel ─────────────── -->
        <aside class="curriculum">
          <div class="curr-head">
            <span class="curr-title">Course Curriculum</span>
            <span class="curr-pct">
              {{ isEnrolled ? `${progressPct}% Complete` : `${totalLessons} Lessons` }}
            </span>
          </div>

          <div class="curr-progress-bg">
            <div class="curr-progress-fill" :style="{ width: progressPct + '%' }"></div>
          </div>

          <div class="curr-list">
            <template v-for="mod in course.modules" :key="mod.id">
              <div class="curr-mod-label">{{ mod.title }}</div>
              <template v-for="(lesson, li) in mod.lessons" :key="lesson.id">
                <div class="curr-item"
                     :class="{ 'curr-item--done': isCompleted(lesson.id) }"
                     @click="openLesson(lesson)">
                  <div class="curr-icon"
                       :class="{
                         'curr-icon--green': isCompleted(lesson.id),
                         'curr-icon--red':   !isCompleted(lesson.id)
                       }">
                    <svg v-if="isCompleted(lesson.id)" width="11" height="11" viewBox="0 0 24 24" fill="none">
                      <polyline points="20 6 9 17 4 12" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <svg v-else width="9" height="9" viewBox="0 0 24 24" fill="#fff">
                      <path d="M5 3l14 9-14 9V3z"/>
                    </svg>
                  </div>
                  <div class="curr-text">
                    <span class="curr-label">LESSON {{ li + 1 }}</span>
                    <span class="curr-name" :class="{ 'curr-name--done': isCompleted(lesson.id) }">{{ lesson.title }}</span>
                  </div>
                  <span v-if="lesson.is_free_preview" class="curr-free">Free</span>
                </div>
              </template>
            </template>
          </div>

          <!-- AI Assistant button -->
          <button class="ai-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="ai-btn-text">
              <span class="ai-btn-label">AI ASSISTANT</span>
              <span class="ai-btn-sub">Stuck? Ask a Question</span>
            </div>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
        </aside>
      </div>

      <!-- Not found -->
      <div v-else class="center-spinner">
        <p style="color:#9ca3af">Course not found.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, reactive, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { useToast } from 'primevue/usetoast'
import { useAuthStore }    from '@/stores/auth'
import { useCoursesStore } from '@/stores/courses'
import { enrollmentsApi, progressApi } from '@/api'

const { t }  = useI18n()
const route  = useRoute()
const router = useRouter()
const toast  = useToast()
const auth   = useAuthStore()
const store  = useCoursesStore()

const userInitial  = computed(() => (auth.user?.name || 'S')[0].toUpperCase())

const loading      = ref(true)
const enrolling    = ref(false)
const course       = ref(null)
const isEnrolled   = ref(false)
const completedIds = ref([])
const progressPct  = ref(0)
const activeTab    = ref('overview')
const openMods     = reactive(new Set())

const tabs = [
  { key: 'overview',   label: 'Overview' },
  { key: 'curriculum', label: 'Curriculum' },
  { key: 'reviews',    label: 'Reviews', badge: 'New' },
]

const totalLessons = computed(() =>
  course.value?.modules?.reduce((s, m) => s + (m.lessons?.length ?? 0), 0) ?? 0
)

function toggleMod(id) {
  openMods.has(id) ? openMods.delete(id) : openMods.add(id)
}

onMounted(async () => {
  const id = Number(route.params.id)
  await store.fetchCourse(id)
  course.value = store.current
  course.value?.modules?.forEach(m => openMods.add(m.id))

  if (auth.isLoggedIn) {
    await store.fetchEnrollments()
    isEnrolled.value = store.enrollments.some(e => e.id === id)

    if (isEnrolled.value) {
      const res = await progressApi.course(id)
      completedIds.value = res.data.data.completed_ids.map(Number)
      progressPct.value  = res.data.data.percentage ?? 0
    }
  }
  loading.value = false
})


async function handleEnroll() {
  if (!auth.isLoggedIn) { router.push('/login'); return }
  enrolling.value = true
  try {
    await enrollmentsApi.enroll(course.value.id)
    isEnrolled.value = true
    toast.add({ severity: 'success', summary: t('toast.enrolled'), detail: t('toast.enrolledDetail'), life: 3000 })
  } catch (e) {
    toast.add({ severity: 'error', summary: t('toast.error'), detail: e.response?.data?.error || t('toast.enrollError'), life: 3000 })
  } finally {
    enrolling.value = false
  }
}

function handleLogout() {
  auth.logout()
  router.push('/login')
}

function continueLesson() {
  const allLessons = course.value?.modules?.flatMap(m => m.lessons) ?? []
  const next = allLessons.find(l => !isCompleted(l.id)) ?? allLessons[allLessons.length - 1]
  if (next) router.push(`/lessons/${next.id}`)
}

function openLesson(lesson) {
  router.push(`/lessons/${lesson.id}`)
}

function isCompleted(id) {
  return completedIds.value.includes(Number(id))
}
</script>

<style scoped>
* { box-sizing: border-box; margin: 0; padding: 0; }

.lms-wrap {
  display: flex;
  min-height: 100vh;
  background: #7b1f1f;
  font-family: 'Inter', system-ui, sans-serif;
}

/* ── Sidebar ────────────────────────────────────────────── */
.lms-sidebar {
  width: 240px; flex-shrink: 0;
  display: flex; flex-direction: column;
  padding: 1.75rem 1rem 1.5rem;
}
.sidebar-logo { padding: 0 .5rem 2rem; }
.sidebar-logo-img { height: 34px; width: auto; filter: brightness(0) invert(1); }
.sidebar-nav { display: flex; flex-direction: column; gap: 4px; }
.nav-item {
  display: flex; align-items: center; gap: .85rem;
  padding: .7rem 1rem; border-radius: 12px;
  color: rgba(255,255,255,.6);
  font-size: .9rem; font-weight: 500;
  text-decoration: none; transition: background .15s, color .15s;
}
.nav-item:hover { background: rgba(255,255,255,.1); color: #fff; }
.nav-item--active { background: #fff; color: #7b1f1f !important; }
.nav-item--logout { border: none; background: none; cursor: pointer; width: 100%; margin-top: 0.5rem; }


.support-card {
  margin-top: auto; background: #fff;
  border-radius: 18px; padding: 1.25rem 1.25rem 0; overflow: hidden;
}
.support-title { font-size: .95rem; font-weight: 700; color: #111; margin: 0 0 .2rem; }
.support-sub   { font-size: .75rem; color: #9ca3af; margin: 0 0 .75rem; }
.support-btn {
  background: #7b1f1f; color: #fff; border: none;
  padding: .4rem 1.1rem; border-radius: 8px;
  font-size: .82rem; font-weight: 600;
  display: block; margin-bottom: .5rem; text-decoration: none;
}
.support-art { display: block; margin: 0 auto; }

/* ── Panel ──────────────────────────────────────────────── */
.lms-panel {
  flex: 1; background: #fff;
  border-radius: 24px 0 0 0;
  display: flex; flex-direction: column;
  overflow: hidden; min-height: 100vh;
}

.lms-topbar {
  display: flex; align-items: center;
  padding: 1.25rem 2rem; gap: 1rem;
  border-bottom: 1px solid #f3f4f6; flex-shrink: 0;
}
.topbar-search {
  flex: 1; max-width: 560px;
  display: flex; align-items: center; gap: .65rem;
  background: #f3f4f6; border-radius: 14px; padding: .65rem 1.1rem;
}
.search-input { border: none; background: transparent; outline: none; font-size: .9rem; color: #374151; width: 100%; }
.search-input::placeholder { color: #9ca3af; }
.topbar-right { display: flex; align-items: center; gap: .7rem; margin-left: auto; }

.topbar-user {
  position: relative;
  display: flex; align-items: center; gap: 8px;
  padding: 5px 12px 5px 5px;
  border-radius: 999px; cursor: pointer;
  border: 1.5px solid #e5e7eb; background: #fff;
  transition: border-color .15s; user-select: none;
}
.topbar-user:hover { border-color: #d1d5db; }
.user-avatar {
  width: 30px; height: 30px; border-radius: 50%;
  background: #7b1f1f; color: #fff;
  display: flex; align-items: center; justify-content: center;
  font-size: .8rem; font-weight: 700; flex-shrink: 0;
}
.user-name { font-size: .85rem; font-weight: 600; color: #374151; }
.user-menu {
  position: absolute; top: calc(100% + 8px); right: 0;
  background: #fff; border: 1.5px solid #e5e7eb;
  border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,.1);
  min-width: 160px; z-index: 200; overflow: hidden;
}
.user-menu-item {
  display: flex; align-items: center; gap: 9px;
  width: 100%; padding: 10px 14px;
  background: none; border: none;
  font-size: .875rem; font-weight: 500; color: #374151;
  cursor: pointer; text-align: left; transition: background .12s;
}
.user-menu-item:hover { background: #f9fafb; }
.user-menu-item--danger { color: #dc2626; }
.user-menu-item--danger:hover { background: #fef2f2; }
.user-menu-divider { height: 1px; background: #f3f4f6; margin: 2px 0; }
.icon-btn {
  width: 40px; height: 40px; border-radius: 50%;
  background: transparent; border: none;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; color: #374151; text-decoration: none;
}
.icon-btn--red { background: #7b1f1f; }
.btn-login {
  padding: .4rem 1rem; border-radius: 8px;
  background: #7b1f1f; color: #fff;
  font-size: .85rem; font-weight: 600; text-decoration: none;
}

.center-spinner { flex: 1; display: flex; align-items: center; justify-content: center; }
.spinner {
  width: 36px; height: 36px; border-radius: 50%;
  border: 3px solid #f3f4f6; border-top-color: #7b1f1f;
  animation: spin .7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }
.spin-icon { animation: spin .7s linear infinite; }

/* ── Content grid (same as LessonView) ─────────────────── */
.content-grid {
  flex: 1; display: grid;
  grid-template-columns: 1fr 290px;
  overflow: hidden;
}

/* ── Left: lesson-style main ────────────────────────────── */
.lesson-main {
  padding: 2rem 2rem 1.5rem;
  overflow-y: auto;
  display: flex; flex-direction: column;
}

.breadcrumb {
  display: flex; align-items: center; flex-wrap: wrap;
  gap: .35rem; margin-bottom: .85rem;
  font-size: .78rem; color: #6b7280;
}
.bc-link { color: #6b7280; text-decoration: none; transition: color .15s; }
.bc-link:hover { color: #374151; }
.bc-active { color: #374151; font-weight: 500; }

.lesson-h1 { font-size: 1.75rem; font-weight: 800; color: #111827; margin: 0 0 .4rem; line-height: 1.2; }
.lesson-desc { font-size: .85rem; color: #6b7280; margin: 0 0 1.5rem; line-height: 1.6; }

.video-box {
  border-radius: 14px; overflow: hidden; background: #c8c8c8;
  aspect-ratio: 16/9; margin-bottom: 1.5rem; flex-shrink: 0;
}
.video-el { width: 100%; height: 100%; object-fit: cover; display: block; }
.video-placeholder {
  width: 100%; height: 100%;
  display: flex; align-items: center; justify-content: center;
}
.video-placeholder--img {
  background-size: cover;
  background-position: center;
}
.play-circle {
  width: 54px; height: 54px; border-radius: 50%;
  background: rgba(255,255,255,.88); border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 4px 20px rgba(0,0,0,.2); transition: transform .15s;
}
.play-circle:hover { transform: scale(1.08); }
.play-circle svg { margin-left: 3px; }

.tab-bar {
  display: flex; gap: 0;
  border-bottom: 1.5px solid #f3f4f6; margin-bottom: 1.25rem;
}
.tab {
  background: none; border: none;
  padding: .6rem 1.2rem; font-size: .88rem; font-weight: 500; color: #6b7280;
  cursor: pointer; border-bottom: 2.5px solid transparent; margin-bottom: -1.5px;
  display: flex; align-items: center; gap: .4rem; transition: color .15s, border-color .15s;
}
.tab:hover { color: #374151; }
.tab--active { color: #7b1f1f; border-bottom-color: #7b1f1f; }
.tab-badge {
  background: #7b1f1f; color: #fff;
  font-size: .62rem; font-weight: 700; padding: 1px 6px; border-radius: 10px;
}

.tab-panel { margin-bottom: 1rem; }

/* Materials grid (same as LessonView) */
.materials-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem; margin-bottom: 1.25rem; }
.mat-card {
  display: flex; align-items: center; gap: .85rem;
  padding: 1.1rem; text-decoration: none; color: #111827;
  border: 1.5px solid #f3f4f6; border-radius: 14px; background: #fff;
  transition: background .15s, border-color .15s, box-shadow .15s;
}
.mat-card:hover { background: #fafafa; border-color: #e5e7eb; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
.mat-ico {
  width: 40px; height: 40px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.mat-ico--red  { background: #fef2f2; }
.mat-ico--blue { background: #eff6ff; }
.mat-info { flex: 1; min-width: 0; }
.mat-name { display: block; font-size: .85rem; font-weight: 600; color: #111827; }
.mat-meta { display: block; font-size: .75rem; color: #9ca3af; margin-top: 1px; }

/* Overview text */
.overview-body { margin-top: .5rem; }
.overview-heading { font-size: 1rem; font-weight: 700; color: #111827; margin-bottom: .5rem; }
.overview-text { font-size: .88rem; color: #374151; line-height: 1.75; }

/* Curriculum tab */
.modules-list { display: flex; flex-direction: column; gap: .5rem; }
.module-block { border: 1.5px solid #f3f4f6; border-radius: 12px; overflow: hidden; }
.module-header {
  width: 100%; background: #fafafa; border: none;
  padding: .85rem 1rem; display: flex; align-items: center;
  justify-content: space-between; cursor: pointer; font-family: inherit;
  transition: background .15s;
}
.module-header:hover { background: #f3f4f6; }
.mod-left { display: flex; align-items: center; gap: .65rem; }
.mod-num {
  width: 24px; height: 24px; border-radius: 50%;
  background: #7b1f1f; color: #fff; font-size: .7rem; font-weight: 700;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.mod-title { font-size: .875rem; font-weight: 600; color: #111827; text-align: left; }
.mod-right { display: flex; align-items: center; gap: .5rem; }
.mod-count { font-size: .72rem; color: #9ca3af; }
.mod-lessons { padding: .35rem .6rem .4rem; }
.cur-lesson {
  display: flex; align-items: center; gap: .7rem;
  padding: .55rem .5rem; border-radius: 8px; cursor: pointer;
  transition: background .15s;
}
.cur-lesson:hover { background: #f9fafb; }
.cur-lesson--locked { opacity: .55; cursor: not-allowed; }
.cur-lesson--locked:hover { background: transparent; }
.cur-icon {
  width: 26px; height: 26px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.ci--green { background: #f0fdf4; }
.ci--red   { background: #7b1f1f; }
.ci--gray  { background: #f3f4f6; }
.cur-text { flex: 1; min-width: 0; }
.cur-label { display: block; font-size: .62rem; font-weight: 700; text-transform: uppercase; color: #9ca3af; }
.cur-name { display: block; font-size: .82rem; font-weight: 500; color: #374151; }
.cur-name--done { text-decoration: line-through; color: #9ca3af; }
.free-tag { font-size: .62rem; font-weight: 700; background: #f0fdf4; color: #16a34a; padding: 2px 7px; border-radius: 20px; }

.empty-tab {
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  gap: .65rem; padding: 2.5rem 1rem;
  color: #9ca3af; font-size: .875rem; text-align: center;
}

/* Footer */
.lesson-footer {
  display: flex; align-items: center; justify-content: space-between;
  padding-top: 1.25rem; border-top: 1px solid #f3f4f6; margin-top: auto;
}
.btn-prev {
  display: flex; align-items: center; gap: .5rem;
  background: none; border: none;
  font-size: .88rem; font-weight: 500; color: #6b7280;
  cursor: pointer; transition: color .15s; text-decoration: none;
}
.btn-prev:hover { color: #111; }
.footer-enroll { display: flex; align-items: center; gap: .85rem; }
.footer-price { font-size: 1.4rem; font-weight: 800; color: #111827; }
.btn-complete {
  display: flex; align-items: center; gap: .55rem;
  background: #7b1f1f; color: #fff; border: none;
  padding: .7rem 1.5rem; border-radius: 12px;
  font-size: .88rem; font-weight: 600; cursor: pointer;
  transition: background .15s;
}
.btn-complete:hover:not(:disabled) { background: #6b1a1a; }
.btn-complete:disabled { opacity: .6; cursor: not-allowed; }
.btn-login-small {
  font-size: .8rem; color: #7b1f1f; font-weight: 600;
  text-decoration: none;
}
.btn-login-small:hover { text-decoration: underline; }

/* ── Curriculum sidebar (same as LessonView) ────────────── */
.curriculum {
  border-left: 1.5px solid #f3f4f6;
  display: flex; flex-direction: column; overflow: hidden;
}
.curr-head {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1.5rem 1.25rem .6rem; flex-shrink: 0;
}
.curr-title { font-size: .9rem; font-weight: 700; color: #111827; }
.curr-pct {
  font-size: .7rem; font-weight: 700; color: #7b1f1f;
  background: #fef2f2; padding: 2px 8px; border-radius: 20px;
}
.curr-progress-bg {
  height: 4px; background: #f3f4f6;
  margin: 0 1.25rem .75rem; border-radius: 99px; flex-shrink: 0;
}
.curr-progress-fill {
  height: 100%; background: #7b1f1f; border-radius: 99px;
  transition: width .4s ease;
}
.curr-list { flex: 1; overflow-y: auto; padding: 0 .75rem; }
.curr-mod-label {
  font-size: .65rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .07em; color: #9ca3af;
  padding: .65rem .75rem .25rem;
}
.curr-item {
  display: flex; align-items: center; gap: .65rem;
  padding: .6rem .75rem; border-radius: 10px;
  margin-bottom: 2px; cursor: pointer;
  transition: background .15s;
}
.curr-item:hover { background: #f9fafb; }
.curr-item--locked { opacity: .55; cursor: not-allowed; }
.curr-item--locked:hover { background: transparent; }
.curr-icon {
  width: 28px; height: 28px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.curr-icon--green { background: #f0fdf4; }
.curr-icon--red   { background: #7b1f1f; }
.curr-icon--gray  { background: #f3f4f6; }
.curr-text { flex: 1; min-width: 0; }
.curr-label {
  display: block; font-size: .6rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .05em; color: #9ca3af; margin-bottom: 1px;
}
.curr-name { display: block; font-size: .8rem; font-weight: 500; color: #374151; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.curr-name--done { text-decoration: line-through; color: #9ca3af; }
.curr-free { font-size: .6rem; font-weight: 700; background: #f0fdf4; color: #16a34a; padding: 1px 6px; border-radius: 20px; flex-shrink: 0; }

.ai-btn {
  display: flex; align-items: center; gap: .8rem;
  padding: 1.1rem 1.25rem;
  background: #1e3a5f; color: #fff;
  border: none; cursor: pointer; text-align: left; flex-shrink: 0;
  transition: background .15s;
}
.ai-btn:hover { background: #1a3352; }
.ai-btn-text { flex: 1; display: flex; flex-direction: column; }
.ai-btn-label { font-size: .62rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.55); }
.ai-btn-sub { font-size: .875rem; font-weight: 600; }
</style>
