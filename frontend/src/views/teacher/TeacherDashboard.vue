<template>
  <div class="flex flex-col min-h-screen bg-slate-50">
    <AppHeader />

    <div class="flex flex-1">
      <TeacherSidebar />

      <main class="flex-1 p-8">

        <!-- Page header -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-gray-900">Teacher Dashboard</h1>
          <p class="text-sm text-gray-500 mt-1">
            Welcome, <span class="font-medium text-gray-700">{{ auth.user?.full_name || auth.user?.name }}</span>
          </p>
        </div>

        <!-- Stat cards -->
        <div class="grid gap-5 mb-8" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
          <template v-if="loading">
            <div v-for="i in 3" :key="i"
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

        <!-- My Courses quick link + course list -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-6">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-gray-800">My Courses</h2>
            <RouterLink to="/teacher/courses"
                        class="text-sm text-brand-burgundy hover:underline font-medium">
              View all →
            </RouterLink>
          </div>

          <div v-if="coursesLoading" class="space-y-3">
            <div v-for="i in 3" :key="i" class="h-12 bg-gray-100 rounded-lg animate-pulse"></div>
          </div>

          <div v-else-if="courses.length === 0" class="text-sm text-gray-400 py-4 text-center">
            You haven't created any courses yet.
          </div>

          <ul v-else class="divide-y divide-gray-100">
            <li v-for="c in courses.slice(0, 5)" :key="c.id"
                class="flex items-center justify-between py-3">
              <div>
                <p class="text-sm font-medium text-gray-800">{{ c.title }}</p>
                <p class="text-xs text-gray-400">{{ c.subject }} · {{ c.level }}</p>
              </div>
              <span class="text-xs px-2 py-1 rounded-full"
                    :class="c.is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'">
                {{ c.is_published ? 'Published' : 'Draft' }}
              </span>
            </li>
          </ul>
        </div>

        <!-- Quick actions -->
        <div class="flex gap-3">
          <RouterLink to="/teacher/courses"
                      class="inline-flex items-center gap-2 bg-brand-burgundy text-white
                             text-sm font-medium px-4 py-2 rounded-lg hover:bg-brand-burgundyDark transition-colors">
            <i class="pi pi-book text-sm"></i>
            My Courses
          </RouterLink>
        </div>

      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AppHeader      from '@/components/layout/AppHeader.vue'
import TeacherSidebar from '@/components/teacher/TeacherSidebar.vue'
import { teacherApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const auth          = useAuthStore()
const loading       = ref(true)
const coursesLoading = ref(true)
const statCards     = ref([])
const courses       = ref([])

onMounted(async () => {
  const [statsRes, coursesRes] = await Promise.all([
    teacherApi.stats(),
    teacherApi.myCourses(),
  ])

  const s = statsRes.data.data
  statCards.value = [
    { label: 'My Courses',  value: s.total_courses,  icon: 'pi-book',      bgColor: 'bg-blue-50',   iconColor: '#3b82f6' },
    { label: 'Enrollments', value: s.total_enrolled, icon: 'pi-user-plus', bgColor: 'bg-green-50',  iconColor: '#10b981' },
    { label: 'Lessons',     value: s.total_lessons,  icon: 'pi-video',     bgColor: 'bg-purple-50', iconColor: '#8b5cf6' },
  ]
  loading.value = false

  courses.value        = coursesRes.data.data
  coursesLoading.value = false
})
</script>
