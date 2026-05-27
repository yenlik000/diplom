<template>
  <div class="flex" style="min-height:100vh;background:#f8f9fa;">
    <TeacherSidebar />
    <div class="flex-1 flex flex-col" style="overflow:hidden;">
      <!-- Header -->
      <header class="flex items-center justify-between px-8 py-4 bg-white border-b" style="border-color:#e5e7eb;">
        <!-- Left: search slot OR page title -->
        <slot name="header-left">
          <h1 class="text-2xl font-bold" style="color:#1a1a1a;margin:0;">{{ title }}</h1>
        </slot>

        <!-- Right: bell + user -->
        <div class="flex items-center gap-3">
          <button class="header-icon-btn"><i class="pi pi-bell" style="color:#6b7280;font-size:1.1rem;"></i></button>
          <div class="flex items-center gap-3 pl-3" style="border-left:1px solid #e5e7eb;">
            <div class="text-right">
              <div class="text-sm font-semibold" style="color:#111827;line-height:1.2;">{{ displayName }}</div>
              <div class="text-xs" style="color:#6b7280;">Senior Professor</div>
            </div>
            <div class="flex items-center justify-center rounded-full font-bold text-sm text-white"
                 style="width:38px;height:38px;background:#7B1A1A;flex-shrink:0;">
              {{ initials }}
            </div>
          </div>
        </div>
      </header>
      <!-- Page content -->
      <main class="flex-1" :class="noPadding ? 'overflow-hidden' : 'p-8 overflow-y-auto'">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import TeacherSidebar from '@/components/teacher/TeacherSidebar.vue'
import { useAuthStore } from '@/stores/auth'

defineProps({ title: { type: String, default: '' }, noPadding: { type: Boolean, default: false } })

const auth = useAuthStore()
const initials = computed(() => {
  const n = auth.user?.full_name || auth.user?.name || ''
  return n.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2) || 'TP'
})
const displayName = computed(() => {
  const n = auth.user?.full_name || auth.user?.name || ''
  const last = n.split(' ').slice(-1)[0]
  return last ? `Prof. ${last}` : 'Prof.'
})
</script>

<style scoped>
.header-icon-btn {
  width: 36px; height: 36px;
  border: none; background: transparent; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: background .15s;
}
.header-icon-btn:hover { background: #f3f4f6; }
</style>
