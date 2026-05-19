<template>
  <footer class="app-footer">
    <div class="container footer-inner">
      <div class="footer-brand">
        <span class="logo-text">Bridge</span>
        <p>{{ t('footer.tagline') }}</p>
      </div>
      <div class="footer-links">
        <RouterLink to="/courses">{{ t('footer.courses') }}</RouterLink>
        <RouterLink to="/login">{{ t('footer.login') }}</RouterLink>
      </div>
      <div class="footer-copy">
        {{ t('footer.allRightsReserved', { year }) }}
      </div>
    </div>
  </footer>
</template>

<script setup>
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
const year = new Date().getFullYear()
</script>

<style scoped>
.app-footer {
  background: var(--brand-blue);
  color: #cbd5e1;
  padding: 3rem 0 1.5rem;
  margin-top: auto;
}

.footer-inner {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 2rem;
  margin-bottom: 2rem;
}

.footer-brand .logo-text {
  font-size: 1.25rem;
  font-weight: 800;
  color: #fff;
}

.footer-brand p {
  margin: 0.5rem 0 0;
  font-size: 0.875rem;
  line-height: 1.6;
}

.footer-links {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.footer-links a {
  font-size: 0.875rem;
  color: #94a3b8;
  transition: color .2s;
}

.footer-links a:hover {
  color: #fff;
}

.footer-copy {
  grid-column: 1 / -1;
  border-top: 1px solid rgba(255,255,255,.1);
  padding-top: 1rem;
  font-size: 0.8rem;
  color: #64748b;
}
</style>
