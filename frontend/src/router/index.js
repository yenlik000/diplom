import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  // ── Public ──────────────────────────────────────────────────
  { path: '/',        name: 'home',    component: () => import('@/views/About.vue') },
  { path: '/about',   name: 'about',   component: () => import('@/views/AboutUs.vue') },
  { path: '/founder', name: 'founder', component: () => import('@/views/Founder.vue') },
  { path: '/courses', name: 'courses', component: () => import('@/views/student/CourseCatalog.vue') },
  { path: '/courses/:id', name: 'course-detail', component: () => import('@/views/student/CourseDetail.vue') },

  // ── Auth ────────────────────────────────────────────────────
  { path: '/login',    name: 'login',    component: () => import('@/views/auth/Login.vue'), meta: { guest: true } },
  { path: '/register', redirect: '/login' },

  // ── Student ─────────────────────────────────────────────────
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('@/views/student/Dashboard.vue'),
    meta: { requiresAuth: true, requiresStudent: true },
  },
  {
    path: '/lessons/:id',
    name: 'lesson',
    component: () => import('@/views/student/LessonView.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/quiz/:id',
    name: 'quiz',
    component: () => import('@/views/student/QuizView.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/lessons/:id/notes',
    name: 'notes',
    component: () => import('@/views/student/NotesView.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/lessons/:id/reader',
    name: 'material-reader',
    component: () => import('@/views/student/MaterialReader.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/student/progress',
    name: 'student-progress',
    component: () => import('@/views/student/ProgressView.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/student/messages',
    name: 'student-messages',
    component: () => import('@/views/student/MessagesView.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/student/settings',
    name: 'student-settings',
    component: () => import('@/views/student/SettingsView.vue'),
    meta: { requiresAuth: true },
  },

  // ── Teacher ─────────────────────────────────────────────────
  {
    path: '/teacher',
    name: 'teacher',
    component: () => import('@/views/teacher/TeacherDashboard.vue'),
    meta: { requiresAuth: true, requiresTeacher: true },
  },
  {
    path: '/teacher/courses',
    name: 'teacher-courses',
    component: () => import('@/views/teacher/TeacherCourses.vue'),
    meta: { requiresAuth: true, requiresTeacher: true },
  },
  {
    path: '/teacher/courses/:id/curriculum',
    name: 'teacher-curriculum',
    component: () => import('@/views/teacher/TeacherCurriculum.vue'),
    meta: { requiresAuth: true, requiresTeacher: true },
  },
  {
    path: '/teacher/students',
    name: 'teacher-students',
    component: () => import('@/views/teacher/TeacherStudents.vue'),
    meta: { requiresAuth: true, requiresTeacher: true },
  },
  {
    path: '/teacher/grading',
    name: 'teacher-grading',
    component: () => import('@/views/teacher/TeacherGrading.vue'),
    meta: { requiresAuth: true, requiresTeacher: true },
  },
  {
    path: '/teacher/grading/:id',
    name: 'teacher-grading-detail',
    component: () => import('@/views/teacher/TeacherGradingDetail.vue'),
    meta: { requiresAuth: true, requiresTeacher: true },
  },
  {
    path: '/teacher/messages',
    name: 'teacher-messages',
    component: () => import('@/views/teacher/TeacherMessages.vue'),
    meta: { requiresAuth: true, requiresTeacher: true },
  },
  {
    path: '/teacher/settings',
    name: 'teacher-settings',
    component: () => import('@/views/teacher/TeacherSettings.vue'),
    meta: { requiresAuth: true, requiresTeacher: true },
  },

  // ── Admin ────────────────────────────────────────────────────
  {
    path: '/admin',
    name: 'admin',
    component: () => import('@/views/admin/AdminDashboard.vue'),
    meta: { requiresAuth: true, requiresAdmin: true },
  },
  {
    path: '/admin/courses',
    name: 'admin-courses',
    component: () => import('@/views/admin/AdminCourses.vue'),
    meta: { requiresAuth: true, requiresAdmin: true },
  },
  {
    path: '/admin/users',
    name: 'admin-users',
    component: () => import('@/views/admin/AdminUsers.vue'),
    meta: { requiresAuth: true, requiresAdmin: true },
  },
  {
    path: '/admin/messages',
    name: 'admin-messages',
    component: () => import('@/views/admin/AdminMessages.vue'),
    meta: { requiresAuth: true, requiresAdmin: true },
  },

  // ── Fallback ─────────────────────────────────────────────────
  { path: '/:pathMatch(.*)*', redirect: '/' },
]

const router = createRouter({
  history: createWebHistory('/diplom/'),
  routes,
  scrollBehavior: () => ({ top: 0 }),
})

router.beforeEach(async to => {
  const auth = useAuthStore()

  // Restore user from token on first navigation
  if (!auth.user && auth.token) {
    await auth.init()
  }

  // Redirect unauthenticated users to login
  if (to.meta.requiresAuth && !auth.isLoggedIn) {
    return { name: 'login', query: { redirect: to.fullPath } }
  }

  // Role gates — redirect to the appropriate dashboard if role doesn't match
  if (to.meta.requiresAdmin && !auth.isAdmin) {
    return { name: auth.isTeacher ? 'teacher' : 'dashboard' }
  }
  if (to.meta.requiresTeacher && !auth.isTeacher && !auth.isAdmin) {
    return { name: auth.isStudent ? 'dashboard' : 'login' }
  }
  if (to.meta.requiresStudent && !auth.isStudent && !auth.isAdmin) {
    return { name: auth.isTeacher ? 'teacher' : 'admin' }
  }

  // Redirect already-logged-in users away from guest pages
  if (to.meta.guest && auth.isLoggedIn) {
    return { path: auth.dashboardRoute() }
  }
})

export default router
