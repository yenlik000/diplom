import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  // ── Public ──────────────────────────────────────────────────
  { path: '/',        name: 'about',   component: () => import('@/views/About.vue') },
  { path: '/landing', name: 'landing', component: () => import('@/views/Landing.vue') },
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

  // ── Fallback ─────────────────────────────────────────────────
  { path: '/:pathMatch(.*)*', redirect: '/diplom/' },
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
