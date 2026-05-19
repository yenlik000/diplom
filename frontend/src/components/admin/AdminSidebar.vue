<template>
  <aside class="admin-sidebar">
    <nav>
      <RouterLink to="/admin" class="nav-item" exact-active-class="active">
        <i class="pi pi-home"></i> {{ t('sidebar.dashboard') }}
      </RouterLink>
      <RouterLink to="/admin/courses" class="nav-item" active-class="active">
        <i class="pi pi-book"></i> {{ t('sidebar.courses') }}
      </RouterLink>
      <RouterLink to="/admin/users" class="nav-item" active-class="active">
        <i class="pi pi-users"></i> {{ t('sidebar.users') }}
      </RouterLink>
      <RouterLink to="/courses" class="nav-item">
        <i class="pi pi-eye"></i> {{ t('sidebar.viewSite') }}
      </RouterLink>
    </nav>
  </aside>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
const { t } = useI18n()
</script>

<style scoped>
.admin-sidebar {
  background: var(--brand-blue);
  min-height: calc(100vh - 64px);
  padding: 1.5rem 0;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1.5rem;
  color: #94a3b8;
  font-size: 0.875rem;
  font-weight: 500;
  text-decoration: none;
  transition: all .2s;
}

.nav-item:hover { color: #fff; background: rgba(255,255,255,.08); }
.nav-item.active { color: #fff; background: rgba(255,255,255,.12); border-left: 3px solid #fff; }
.nav-item i { font-size: 1rem; }
</style>
