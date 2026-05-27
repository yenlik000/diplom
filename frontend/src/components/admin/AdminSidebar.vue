<template>
  <aside style="width:260px;min-width:260px;background:#fff;height:100vh;position:sticky;top:0;border-right:1px solid #e5e7eb;display:flex;flex-direction:column;overflow-y:auto;">

    <!-- Brand -->
    <div style="display:flex;align-items:center;gap:12px;padding:24px 20px 20px;">
      <div style="width:44px;height:44px;background:#7B1A1A;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <i class="pi pi-shield" style="color:#fff;font-size:1.3rem;"></i>
      </div>
      <div>
        <div style="color:#111827;font-weight:700;font-size:1rem;line-height:1.25;">Admin Panel</div>
        <div style="color:#9ca3af;font-size:0.72rem;line-height:1.4;">Platform Management</div>
      </div>
    </div>

    <!-- Quick action -->
    <div style="padding:0 16px 20px;">
      <RouterLink to="/admin/users" custom v-slot="{ navigate }">
        <button class="action-btn" @click="navigate">
          <i class="pi pi-user-plus" style="font-size:0.8rem;"></i>
          Create User
        </button>
      </RouterLink>
    </div>

    <!-- Main navigation -->
    <nav style="flex:1;padding:0 10px;">
      <p class="nav-section">OVERVIEW</p>
      <RouterLink to="/admin" class="nav-link" exact-active-class="nav-link--active">
        <i class="pi pi-th-large nav-icon"></i>
        <span>Dashboard</span>
      </RouterLink>

      <p class="nav-section" style="margin-top:16px;">MANAGEMENT</p>
      <RouterLink to="/admin/users" class="nav-link" active-class="nav-link--active">
        <i class="pi pi-users nav-icon"></i>
        <span>Users</span>
      </RouterLink>
      <RouterLink to="/admin/courses" class="nav-link" active-class="nav-link--active">
        <i class="pi pi-book nav-icon"></i>
        <span>Courses</span>
      </RouterLink>
      <RouterLink to="/admin/messages" class="nav-link" active-class="nav-link--active">
        <i class="pi pi-comments nav-icon"></i>
        <span>Messages</span>
      </RouterLink>
    </nav>

    <!-- Bottom -->
    <div style="border-top:1px solid #e5e7eb;padding:12px 10px 24px;">
      <RouterLink to="/courses" class="nav-link nav-link--muted">
        <i class="pi pi-eye muted-icon"></i>
        <span>View Site</span>
      </RouterLink>
      <button class="nav-link nav-link--btn nav-link--muted" @click="handleLogout">
        <i class="pi pi-sign-out muted-icon"></i>
        <span>Logout</span>
      </button>
    </div>

  </aside>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth'
import { useRouter }    from 'vue-router'

const auth   = useAuthStore()
const router = useRouter()

function handleLogout() {
  auth.logout()
  router.push('/login')
}
</script>

<style scoped>
.action-btn {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 11px 16px;
  background: #7B1A1A;
  color: #fff;
  font-size: 0.9rem;
  font-weight: 600;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background 0.15s;
  text-decoration: none;
}
.action-btn:hover { background: #6a1616; }

.nav-section {
  font-size: .62rem; font-weight: 700; color: #9ca3af;
  letter-spacing: .09em; text-transform: uppercase;
  padding: 0 12px; margin: 0 0 4px;
}

.nav-link {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 11px 12px;
  border-radius: 8px;
  color: #374151;
  font-size: 0.9rem;
  font-weight: 500;
  text-decoration: none;
  transition: background 0.12s, color 0.12s;
  margin-bottom: 2px;
  width: 100%;
}
.nav-link:hover { background: #fef2f2; color: #7B1A1A; }
.nav-link:hover .nav-icon { color: #7B1A1A; }

.nav-link--active { background: #fef2f2; color: #7B1A1A; }
.nav-link--active .nav-icon { color: #7B1A1A; }

.nav-link--btn {
  background: transparent;
  border: none;
  cursor: pointer;
  text-align: left;
}

.nav-icon {
  font-size: 1.1rem;
  color: #7B1A1A;
  flex-shrink: 0;
}

.muted-icon {
  font-size: 1.1rem;
  color: #6b7280;
  flex-shrink: 0;
}

.nav-link--muted { color: #6b7280; }
.nav-link--muted:hover { background: #f9fafb; color: #374151; }
.nav-link--muted:hover .muted-icon { color: #374151; }
</style>
