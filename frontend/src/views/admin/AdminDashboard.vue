<template>
  <div class="flex flex-col min-h-screen bg-slate-50">
    <AppHeader />

    <div class="flex flex-1">
      <AdminSidebar />

      <main class="flex-1 p-8">

        <!-- Page header -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
          <p class="text-sm text-gray-500 mt-1">
            Welcome back, <span class="font-medium text-gray-700">{{ auth.user?.full_name || auth.user?.name }}</span>
          </p>
        </div>

        <!-- Stat cards -->
        <div class="grid grid-cols-2 gap-5 mb-8" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
          <template v-if="loading">
            <div v-for="i in 6" :key="i"
                 class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 animate-pulse">
              <div class="h-10 w-10 bg-gray-200 rounded-lg mb-4"></div>
              <div class="h-7 w-16 bg-gray-200 rounded mb-2"></div>
              <div class="h-4 w-24 bg-gray-100 rounded"></div>
            </div>
          </template>

          <template v-else>
            <div v-for="card in statCards" :key="card.label"
                 class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-shadow">
              <div class="flex items-center justify-between mb-4">
                <div class="p-2 rounded-lg" :class="card.bgColor">
                  <i :class="`pi ${card.icon} text-xl`" :style="{ color: card.iconColor }"></i>
                </div>
              </div>
              <div class="text-3xl font-extrabold text-gray-900">{{ card.value }}</div>
              <div class="text-sm text-gray-500 mt-1">{{ card.label }}</div>
            </div>
          </template>
        </div>

        <!-- Quick actions -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
          <h2 class="text-base font-semibold text-gray-800 mb-4">Quick Actions</h2>
          <div class="flex flex-wrap gap-3">
            <RouterLink to="/admin/users"
                        class="inline-flex items-center gap-2 bg-brand-burgundy text-white
                               text-sm font-medium px-4 py-2 rounded-lg hover:bg-brand-burgundyDark transition-colors">
              <i class="pi pi-user-plus text-sm"></i>
              Manage Users
            </RouterLink>
            <RouterLink to="/admin/courses"
                        class="inline-flex items-center gap-2 border border-gray-200 text-gray-700
                               text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors">
              <i class="pi pi-book text-sm"></i>
              Manage Courses
            </RouterLink>
          </div>
        </div>

      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AppHeader    from '@/components/layout/AppHeader.vue'
import AdminSidebar from '@/components/admin/AdminSidebar.vue'
import { adminApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const auth    = useAuthStore()
const loading = ref(true)
const statCards = ref([])

onMounted(async () => {
  const res   = await adminApi.stats()
  const s     = res.data.data
  statCards.value = [
    { label: 'Students',    value: s.total_students, icon: 'pi-users',     bgColor: 'bg-blue-50',   iconColor: '#3b82f6' },
    { label: 'Teachers',    value: s.total_teachers, icon: 'pi-user',      bgColor: 'bg-purple-50', iconColor: '#8b5cf6' },
    { label: 'Groups',      value: s.total_groups,   icon: 'pi-th-large',  bgColor: 'bg-amber-50',  iconColor: '#f59e0b' },
    { label: 'Courses',     value: s.total_courses,  icon: 'pi-book',      bgColor: 'bg-green-50',  iconColor: '#10b981' },
    { label: 'Enrollments', value: s.total_enrolled, icon: 'pi-user-plus', bgColor: 'bg-rose-50',   iconColor: '#f43f5e' },
    { label: 'Lessons',     value: s.total_lessons,  icon: 'pi-video',     bgColor: 'bg-cyan-50',   iconColor: '#06b6d4' },
  ]
  loading.value = false
})
</script>
