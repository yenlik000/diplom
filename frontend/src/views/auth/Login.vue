<template>
  <div class="page">
    <div class="card">

      <h1 class="title">Welcome Back</h1>

      <!-- Student / Instructor tabs -->
      <div class="tabs">
        <button class="tab" :class="{ active: tab === 'student' }" @click="tab = 'student'">
          Student
        </button>
        <button class="tab" :class="{ active: tab === 'instructor' }" @click="tab = 'instructor'">
          Instructor
        </button>
      </div>

      <!-- Login form -->
      <form @submit.prevent="handleSubmit" class="form">

        <div class="field">
          <label>Username or Email</label>
          <div class="inp-wrap">
            <svg class="inp-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="#9ca3af" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="4" width="20" height="16" rx="2"/>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
            </svg>
            <input
              v-model="form.username"
              type="text"
              class="inp"
              placeholder="Enter your ID"
              autocomplete="username"
              required
            />
          </div>
        </div>

        <div class="field">
          <label>Password</label>
          <div class="inp-wrap">
            <svg class="inp-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="#9ca3af" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input
              v-model="form.password"
              :type="showPass ? 'text' : 'password'"
              class="inp"
              autocomplete="current-password"
              required
            />
            <button type="button" class="eye-btn" @click="showPass = !showPass">
              <svg v-if="showPass" width="18" height="18" viewBox="0 0 24 24" fill="none"
                   stroke="#9ca3af" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
              </svg>
              <svg v-else width="18" height="18" viewBox="0 0 24 24" fill="none"
                   stroke="#9ca3af" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="remember-row">
          <input type="checkbox" id="rem" v-model="rememberMe" class="checkbox" />
          <label for="rem">Remember me for 30 days</label>
        </div>

        <p v-if="loginError" class="err-msg">{{ loginError }}</p>

        <button type="submit" class="btn-signin" :disabled="loginLoading">
          {{ loginLoading ? 'Signing in…' : 'Sign In' }}
        </button>

      </form>

      <!-- Divider -->
      <div class="or-row">
        <div class="or-line"></div>
        <span class="or-text">Or continue with</span>
        <div class="or-line"></div>
      </div>

      <!-- Social buttons -->
      <div class="social-row">
        <button class="social-btn" :disabled="socialLoading" @click="handleGoogle">
          <svg width="20" height="20" viewBox="0 0 24 24">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
          </svg>
          <span>Google</span>
        </button>

        <button class="social-btn" @click="handleSSO">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 3L1 9l4 2.18V16c0 .88.48 1.65 1.2 2.06C7.55 18.83 9.68 20 12 20s4.45-1.17 5.8-1.94c.72-.41 1.2-1.18 1.2-2.06v-4.82L20 11v5h2V9L12 3zm6 10.82V16c0 .25-.14.48-.35.6C16.39 17.45 14.39 18.5 12 18.5s-4.39-1.05-5.65-1.9c-.21-.12-.35-.35-.35-.6v-2.18l6 3.27 6-3.27zM12 12.72L4.72 9 12 5.28 19.28 9 12 12.72z"/>
          </svg>
          <span>SSO Login</span>
        </button>
      </div>

      <p v-if="socialError" class="err-msg" style="text-align:center;margin-top:.75rem">
        {{ socialError }}
      </p>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { authApi } from '@/api'

const auth   = useAuthStore()
const router = useRouter()
const route  = useRoute()

// ── Tab ────────────────────────────────────────────────────
const tab = ref('student')

// ── Username / password ────────────────────────────────────
const form         = ref({ username: '', password: '' })
const showPass     = ref(false)
const rememberMe   = ref(false)
const loginLoading = ref(false)
const loginError   = ref('')

async function handleSubmit() {
  loginError.value   = ''
  loginLoading.value = true
  try {
    await auth.login(form.value.username, form.value.password)
    router.push(route.query.redirect || auth.dashboardRoute())
  } catch (e) {
    loginError.value = e.response?.data?.error || 'Invalid username or password.'
  } finally {
    loginLoading.value = false
  }
}

// ── Social shared helper ───────────────────────────────────
const socialLoading = ref(false)
const socialError   = ref('')

async function finishSocial(apiCall) {
  socialError.value   = ''
  socialLoading.value = true
  try {
    const res = await apiCall()
    auth.setSession(res.data.data)
    router.push(auth.dashboardRoute())
  } catch (e) {
    socialError.value = e.response?.data?.error || 'Authentication failed. Please try again.'
  } finally {
    socialLoading.value = false
  }
}

// ── Google ─────────────────────────────────────────────────
const GOOGLE_CLIENT_ID = import.meta.env.VITE_GOOGLE_CLIENT_ID || ''

function waitForGoogle(cb) {
  const deadline = Date.now() + 8000
  const poll = () => {
    if (window.google?.accounts?.oauth2) {
      cb()
    } else if (Date.now() < deadline) {
      setTimeout(poll, 150)
    } else {
      socialError.value   = 'Google Sign-In failed to load.'
      socialLoading.value = false
    }
  }
  poll()
}

function handleGoogle() {
  socialError.value = ''
  if (!GOOGLE_CLIENT_ID) { socialError.value = 'Google Client ID not configured.'; return }
  socialLoading.value = true
  waitForGoogle(() => {
    const client = window.google.accounts.oauth2.initTokenClient({
      client_id: GOOGLE_CLIENT_ID,
      scope: 'openid email profile',
      prompt: 'select_account',
      callback: async tokenResponse => {
        if (tokenResponse.error) {
          socialError.value   = tokenResponse.error_description || 'Google sign-in failed.'
          socialLoading.value = false
          return
        }
        await finishSocial(() => authApi.google({ access_token: tokenResponse.access_token }))
      },
    })
    client.requestAccessToken()
  })
}

// ── SSO ────────────────────────────────────────────────────
function handleSSO() {
  socialError.value = 'SSO login is not configured for this organization.'
}
</script>

<style scoped>
* { box-sizing: border-box; }

.page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;
  padding: 1.5rem;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.card {
  background: #fff;
  border-radius: 1.5rem;
  padding: 2.5rem 2.25rem;
  width: 100%;
  max-width: 440px;
  box-shadow: 0 4px 24px rgba(0,0,0,.08);
}

.title {
  font-size: 1.75rem;
  font-weight: 700;
  color: #111827;
  text-align: center;
  margin: 0 0 1.75rem;
}

/* ── Tabs ─────────────────────────────────────────────────── */
.tabs {
  display: flex;
  background: #e5e7eb;
  border-radius: 0.5rem;
  padding: 4px;
  margin-bottom: 1.75rem;
}

.tab {
  flex: 1;
  padding: 0.55rem 1rem;
  border: none;
  border-radius: 0.5rem;
  font-size: 0.9375rem;
  font-weight: 500;
  cursor: pointer;
  background: transparent;
  color: #6b7280;
  transition: background 0.18s, color 0.18s, box-shadow 0.18s;
}

.tab.active {
  background: #fff;
  color: #ef4444;
  box-shadow: 0 1px 6px rgba(0,0,0,.12);
}

/* ── Form ─────────────────────────────────────────────────── */
.form { display: flex; flex-direction: column; gap: 1.1rem; }

.field { display: flex; flex-direction: column; gap: 0.35rem; }
.field label { font-size: 0.875rem; font-weight: 500; color: #374151; }

.inp-wrap {
  position: relative;
  display: flex;
  align-items: center;
}

.inp-icon {
  position: absolute;
  left: 0.875rem;
  pointer-events: none;
}

.inp {
  width: 100%;
  border: 1.5px solid #e5e7eb;
  border-radius: 0.65rem;
  padding: 0.72rem 2.75rem 0.72rem 2.75rem;
  font-size: 0.9375rem;
  color: #111827;
  background: #fff;
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
}
.inp:focus { border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,.1); }
.inp::placeholder { color: #d1d5db; }

.eye-btn {
  position: absolute;
  right: 0.875rem;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  display: flex;
  align-items: center;
}

/* ── Remember me ──────────────────────────────────────────── */
.remember-row {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-top: -0.25rem;
}

.checkbox {
  width: 16px;
  height: 16px;
  accent-color: #ef4444;
  cursor: pointer;
  flex-shrink: 0;
}

.remember-row label {
  font-size: 0.875rem;
  color: #374151;
  cursor: pointer;
}

/* ── Error ────────────────────────────────────────────────── */
.err-msg {
  font-size: 0.84rem;
  color: #dc2626;
  background: #fef2f2;
  border-radius: 0.5rem;
  padding: 0.5rem 0.75rem;
  margin: 0;
}

/* ── Sign In button ───────────────────────────────────────── */
.btn-signin {
  width: 100%;
  background: #ef4444;
  color: #fff;
  border: none;
  border-radius: 0.65rem;
  padding: 0.85rem;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.15s;
  margin-top: 0.15rem;
}
.btn-signin:hover:not(:disabled) { background: #dc2626; }
.btn-signin:disabled { background: #fca5a5; cursor: not-allowed; }

/* ── OR divider ───────────────────────────────────────────── */
.or-row {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin: 1.5rem 0 1.25rem;
}
.or-line { flex: 1; height: 1px; background: #e5e7eb; }
.or-text  { font-size: 0.8125rem; font-weight: 600; color: #374151; white-space: nowrap; }

/* ── Social row ───────────────────────────────────────────── */
.social-row { display: flex; gap: 0.875rem; }

.social-btn {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  border: 1.5px solid #e5e7eb;
  border-radius: 0.65rem;
  padding: 0.7rem 1rem;
  background: #fff;
  font-size: 0.9375rem;
  font-weight: 500;
  color: #374151;
  cursor: pointer;
  transition: background 0.15s, border-color 0.15s;
}
.social-btn:hover:not(:disabled) { background: #f9fafb; border-color: #d1d5db; }
.social-btn:disabled { opacity: 0.55; cursor: not-allowed; }
</style>
