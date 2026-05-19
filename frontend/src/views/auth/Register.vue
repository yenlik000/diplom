<template>
  <div class="auth-page">
    <div class="auth-card">

      <!-- Left: Form -->
      <div class="auth-left">
        <RouterLink to="/" class="auth-logo">
          <img src="@/assets/logo.png" alt="Logo" class="logo-img" />
        </RouterLink>

        <h1 class="auth-title">{{ t('auth.register.title') }}</h1>
        <p class="auth-sub">
          {{ t('auth.register.alreadyHaveAccount') }}
          <RouterLink to="/login" class="link">{{ t('auth.register.signIn') }}</RouterLink>
        </p>

        <form @submit.prevent="handleSubmit" class="auth-form">
          <div class="row-2">
            <div class="field">
              <label>{{ t('auth.register.firstName') }}</label>
              <input v-model="form.firstName" type="text" class="inp" required />
            </div>
            <div class="field">
              <label>{{ t('auth.register.lastName') }}</label>
              <input v-model="form.lastName" type="text" class="inp" required />
            </div>
          </div>

          <div class="field">
            <label>{{ t('auth.emailAddress') }}</label>
            <input v-model="form.email" type="email" class="inp" required />
          </div>

          <div class="row-2">
            <div class="field">
              <label>{{ t('auth.password') }}</label>
              <input v-model="form.password" :type="showPassword ? 'text' : 'password'" class="inp" required />
            </div>
            <div class="field">
              <label>{{ t('auth.register.confirmPassword') }}</label>
              <input v-model="form.confirmPassword" :type="showPassword ? 'text' : 'password'" class="inp" required />
            </div>
          </div>

          <p class="password-hint">{{ t('auth.register.passwordHint') }}</p>

          <label class="show-pass">
            <input type="checkbox" v-model="showPassword" />
            <span>{{ t('auth.register.showPassword') }}</span>
          </label>

          <div v-if="error" class="error-msg">{{ error }}</div>

          <div class="form-footer">
            <RouterLink to="/login" class="link-alt">{{ t('auth.register.signInInstead') }}</RouterLink>
            <button type="submit" class="btn-submit" :disabled="loading">
              {{ loading ? t('auth.register.creating') : t('auth.register.createAccount') }}
            </button>
          </div>
        </form>
      </div>

      <!-- Right: Illustration -->
      <div class="auth-right">
        <svg viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg" class="illus-svg">
          <g stroke="#2d2d2d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

            <!-- Small circle (top-center-left) -->
            <circle cx="208" cy="70" r="23"/>

            <!-- Large circle (bottom-right) -->
            <circle cx="408" cy="430" r="30"/>

            <!-- Main irregular pentagon -->
            <polygon points="80,255 108,118 224,152 255,340 90,340"/>

            <!-- Internal triangulation diagonals -->
            <line x1="80"  y1="255" x2="255" y2="340"/>
            <line x1="80"  y1="255" x2="224" y2="152"/>
            <line x1="108" y1="118" x2="90"  y2="340"/>
            <line x1="108" y1="118" x2="255" y2="340"/>

            <!-- Large background triangle -->
            <polygon points="261,103 88,340 424,340"/>

            <!-- Small sharp triangle at top -->
            <polygon points="261,103 291,152 224,152"/>

            <!-- Scattered dots inside right triangle -->
            <circle cx="308" cy="263" r="2.5" fill="#2d2d2d" stroke="none"/>
            <circle cx="308" cy="280" r="2.5" fill="#2d2d2d" stroke="none"/>
            <circle cx="308" cy="297" r="2.5" fill="#2d2d2d" stroke="none"/>
            <circle cx="325" cy="280" r="2.5" fill="#2d2d2d" stroke="none"/>
            <circle cx="325" cy="297" r="2.5" fill="#2d2d2d" stroke="none"/>
            <circle cx="342" cy="297" r="2.5" fill="#2d2d2d" stroke="none"/>

          </g>

          <!-- Four filled squares (bottom-left) -->
          <rect x="55"  y="422" width="18" height="18" fill="#2d2d2d"/>
          <rect x="80"  y="422" width="18" height="18" fill="#2d2d2d"/>
          <rect x="105" y="422" width="18" height="18" fill="#2d2d2d"/>
          <rect x="130" y="422" width="18" height="18" fill="#2d2d2d"/>
        </svg>
      </div>

    </div>

    <!-- Page footer -->
    <div class="page-footer">
      <div class="lang-dropdown" v-click-outside="() => showLangMenu = false">
        <button class="lang-selector" @click="showLangMenu = !showLangMenu">
          {{ currentLangLabel }} ▾
        </button>
        <div v-if="showLangMenu" class="lang-menu">
          <button
            v-for="lang in langs"
            :key="lang.code"
            class="lang-option"
            :class="{ active: locale === lang.code }"
            @click="switchLang(lang.code)"
          >{{ lang.label }}</button>
        </div>
      </div>
      <div class="footer-links">
        <a href="#">{{ t('common.help') }}</a>
        <a href="#">{{ t('common.privacy') }}</a>
        <a href="#">{{ t('common.terms') }}</a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { useAuthStore } from '@/stores/auth'

const { t, locale } = useI18n()
const auth   = useAuthStore()
const router = useRouter()

const langs = [
  { code: 'en', label: 'English' },
  { code: 'ru', label: 'Русский' },
  { code: 'kz', label: 'Қазақша' },
]

const showLangMenu = ref(false)

const currentLangLabel = computed(() =>
  langs.find(l => l.code === locale.value)?.label ?? 'English'
)

function switchLang(code) {
  locale.value = code
  localStorage.setItem('locale', code)
  showLangMenu.value = false
}

const vClickOutside = {
  mounted(el, binding) {
    el._clickOutside = (e) => { if (!el.contains(e.target)) binding.value(e) }
    document.addEventListener('click', el._clickOutside)
  },
  unmounted(el) {
    document.removeEventListener('click', el._clickOutside)
  },
}

const form = ref({
  firstName: '',
  lastName: '',
  email: '',
  password: '',
  confirmPassword: '',
})
const showPassword = ref(false)
const loading      = ref(false)
const error        = ref('')


async function handleSubmit() {
  error.value = ''
  if (form.value.password !== form.value.confirmPassword) {
    error.value = t('auth.register.passwordsMismatch')
    return
  }
  loading.value = true
  try {
    const name = `${form.value.firstName} ${form.value.lastName}`.trim()
    await auth.register(name, form.value.email, form.value.password)
    router.push('/dashboard')
  } catch (e) {
    error.value = e.response?.data?.error || t('auth.register.error')
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
* { box-sizing: border-box; }

.auth-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: #fff;
  padding: 1.5rem 1.5rem 1rem;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* ── Card ── */
.auth-card {
  background: #fff;
  border-radius: 16px;
  border: 1px solid #d0d0d0;
  width: 100%;
  max-width: 1120px;
  display: flex;
  align-items: stretch;
  overflow: hidden;
}

/* ── Left: form ── */
.auth-left {
  flex: 1;
  padding: 3rem 3.5rem 3rem;
  min-width: 0;
}

.auth-logo {
  display: inline-flex;
  margin-bottom: 1.25rem;
}

.logo-img {
  height: 48px;
  width: auto;
}

.auth-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1a1a1a;
  margin: 0 0 0.3rem;
  letter-spacing: -0.02em;
}

.auth-sub {
  font-size: 0.9rem;
  color: #666;
  margin: 0 0 1.75rem;
}

.link {
  color: #1a1a1a;
  font-weight: 400;
  text-decoration: underline;
}

/* ── Form ── */
.auth-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.row-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}

.field {
  display: flex;
  flex-direction: column;
  gap: 0.3rem;
}

.field label {
  font-size: 0.875rem;
  color: #555;
  font-weight: 400;
}

.inp {
  border: 1px solid #d5d5d5;
  border-radius: 0.5rem;
  padding: 0.7rem 0.875rem;
  font-size: 0.9375rem;
  color: #1a1a1a;
  outline: none;
  transition: border-color 0.15s, box-shadow 0.15s;
  background: #fff;
  width: 100%;
}

.inp:focus {
  border-color: #1a73e8;
  box-shadow: 0 0 0 2px rgba(26,115,232,0.15);
}

.password-hint {
  font-size: 0.8rem;
  color: #888;
  margin: -0.25rem 0 0;
  line-height: 1.4;
}

.show-pass {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.9rem;
  color: #333;
  cursor: pointer;
  user-select: none;
}

.show-pass input[type="checkbox"] {
  width: 17px;
  height: 17px;
  accent-color: #1a73e8;
  cursor: pointer;
}

.error-msg {
  font-size: 0.85rem;
  color: #d93025;
  background: #fce8e6;
  border-radius: 0.4rem;
  padding: 0.5rem 0.75rem;
}

.form-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 1.5rem;
}

.link-alt {
  font-size: 0.9rem;
  color: #1a1a1a;
  text-decoration: underline;
  font-weight: 400;
}

.btn-submit {
  background: #c8c8c8;
  color: #fff;
  border: none;
  border-radius: 2rem;
  padding: 0.75rem 2rem;
  font-size: 0.9375rem;
  font-weight: 500;
  cursor: not-allowed;
  transition: background 0.15s;
  white-space: nowrap;
}

.btn-submit:not(:disabled) {
  background: #1a73e8;
  cursor: pointer;
}

.btn-submit:not(:disabled):hover { background: #1557b0; }

/* ── Right: illustration ── */
.auth-right {
  flex: 0 0 38%;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2.5rem 2rem;
}

.illus-svg {
  width: 100%;
  max-width: 340px;
  height: auto;
}

/* ── Page footer ── */
.page-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  max-width: 1120px;
  margin-top: 1rem;
  padding: 0 0.25rem;
  font-size: 0.8125rem;
  color: #767676;
}

.lang-dropdown {
  position: relative;
}

.lang-selector {
  background: none;
  border: none;
  padding: 0;
  font-size: 0.8125rem;
  color: #767676;
  cursor: pointer;
  font-family: inherit;
}
.lang-selector:hover { color: #333; }

.lang-menu {
  position: absolute;
  bottom: calc(100% + 6px);
  left: 0;
  background: #fff;
  border: 1px solid #d5d5d5;
  border-radius: 8px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.1);
  overflow: hidden;
  min-width: 130px;
  z-index: 10;
}

.lang-option {
  display: block;
  width: 100%;
  padding: 0.5rem 1rem;
  background: none;
  border: none;
  text-align: left;
  font-size: 0.8125rem;
  color: #333;
  cursor: pointer;
  font-family: inherit;
}
.lang-option:hover { background: #f5f5f5; }
.lang-option.active { color: #1a73e8; font-weight: 600; }

.footer-links { display: flex; gap: 1.75rem; }

.footer-links a {
  color: #767676;
  text-decoration: none;
}

.footer-links a:hover { color: #1a73e8; }

/* ── Mobile ── */
@media (max-width: 740px) {
  .auth-page { padding: 1rem 0.75rem 1rem; }
  .auth-card { border-radius: 12px; }
  .auth-right { display: none; }
  .auth-left { padding: 2rem 1.5rem; }
  .row-2 { grid-template-columns: 1fr; }
}
</style>
