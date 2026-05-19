import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { authApi } from '@/api'

export const useAuthStore = defineStore('auth', () => {
  const user  = ref(null)
  const token = ref(localStorage.getItem('token'))

  // ── Computed flags ─────────────────────────────────────────
  const isLoggedIn = computed(() => !!token.value && !!user.value)
  const isAdmin    = computed(() => user.value?.role === 'admin')
  const isTeacher  = computed(() => user.value?.role === 'teacher')
  const isStudent  = computed(() => user.value?.role === 'student')

  // ── Actions ────────────────────────────────────────────────

  async function init() {
    if (token.value && !user.value) {
      try {
        const res  = await authApi.me()
        user.value = res.data.data
      } catch {
        logout()
      }
    }
  }

  // Login with username + password
  async function login(username, password) {
    const res  = await authApi.login({ username, password })
    const data = res.data.data
    token.value = data.token
    user.value  = data.user
    localStorage.setItem('token', data.token)
  }

  // Used by Google, Facebook, and email-register flows
  function setSession(data) {
    token.value = data.token
    user.value  = data.user
    localStorage.setItem('token', data.token)
  }

  function logout() {
    user.value  = null
    token.value = null
    localStorage.removeItem('token')
  }

  // ── Dashboard route based on role ──────────────────────────
  function dashboardRoute() {
    if (isAdmin.value)   return '/admin'
    if (isTeacher.value) return '/teacher'
    return '/dashboard'
  }

  return {
    user, token,
    isLoggedIn, isAdmin, isTeacher, isStudent,
    init, login, logout, dashboardRoute, setSession,
  }
})
