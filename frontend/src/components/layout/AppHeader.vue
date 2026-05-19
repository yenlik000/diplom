<template>
  <header class="app-header">
    <div class="container header-inner">
      <RouterLink to="/" class="logo">
        <span class="logo-icon">B</span>
        <span class="logo-text">Bridge</span>
      </RouterLink>

      <nav class="nav-links">
        <RouterLink to="/courses">{{ t('header.courses') }}</RouterLink>
        <RouterLink to="/">{{ t('header.about') }}</RouterLink>
        <template v-if="auth.isLoggedIn">
          <RouterLink to="/dashboard">{{ t('header.cabinet') }}</RouterLink>
          <RouterLink v-if="auth.isAdmin" to="/admin">{{ t('header.admin') }}</RouterLink>
        </template>
      </nav>

      <div class="header-actions">
        <!-- Language switcher -->
        <div class="lang-switcher">
          <button
            v-for="lang in langs"
            :key="lang.code"
            class="lang-btn"
            :class="{ active: locale === lang.code }"
            @click="switchLang(lang.code)"
          >{{ lang.label }}</button>
        </div>

        <template v-if="auth.isLoggedIn">
          <span class="user-name">{{ auth.user?.name }}</span>
          <Button :label="t('header.logout')" severity="secondary" size="small" outlined @click="handleLogout" />
        </template>
      </div>
    </div>
  </header>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import Button from 'primevue/button'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

const { t, locale } = useI18n()
const auth   = useAuthStore()
const router = useRouter()

const langs = [
  { code: 'ru', label: 'RU' },
  { code: 'kz', label: 'KZ' },
  { code: 'en', label: 'EN' },
]

function switchLang(code) {
  locale.value = code
  localStorage.setItem('locale', code)
}

function handleLogout() {
  auth.logout()
  router.push('/')
}
</script>

<style scoped>
.app-header {
  background: #fff;
  border-bottom: 1px solid var(--border-color);
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 1px 4px rgba(0,0,0,.06);
}

.header-inner {
  display: flex;
  align-items: center;
  gap: 2rem;
  height: 64px;
}

.logo {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 800;
  font-size: 1.25rem;
  color: var(--brand-burgundy);
  text-decoration: none;
}

.logo-icon {
  background: var(--brand-burgundy);
  color: #fff;
  width: 32px;
  height: 32px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
}

.nav-links {
  display: flex;
  gap: 1.5rem;
  flex: 1;
}

.nav-links a {
  font-size: 0.9rem;
  font-weight: 500;
  color: var(--text-muted);
  transition: color .2s;
}

.nav-links a:hover,
.nav-links a.router-link-active {
  color: var(--brand-burgundy);
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.user-name {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--text-muted);
}

/* Language switcher */
.lang-switcher {
  display: flex;
  align-items: center;
  gap: 2px;
  background: var(--surface-50);
  border: 1px solid var(--border-color);
  border-radius: 6px;
  padding: 2px;
}

.lang-btn {
  background: none;
  border: none;
  padding: 3px 8px;
  font-size: 0.75rem;
  font-weight: 600;
  color: var(--text-muted);
  cursor: pointer;
  border-radius: 4px;
  transition: background 0.15s, color 0.15s;
  letter-spacing: 0.03em;
}

.lang-btn:hover {
  color: var(--text-primary);
}

.lang-btn.active {
  background: #fff;
  color: var(--brand-burgundy);
  box-shadow: 0 1px 3px rgba(0,0,0,.1);
}
</style>
