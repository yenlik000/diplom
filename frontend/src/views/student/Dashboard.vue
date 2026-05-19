<template>
  <div class="flex flex-col min-h-screen bg-slate-50">
    <AppHeader />

    <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-8">

      <!-- Header -->
      <div class="flex items-center justify-between flex-wrap gap-4 mb-8">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">
            Welcome, {{ auth.user?.full_name || auth.user?.name }}!
          </h1>
          <p class="text-sm text-gray-500 mt-1">Your courses and learning progress</p>
        </div>
        <RouterLink to="/courses"
                    class="inline-flex items-center gap-2 bg-brand-burgundy text-white
                           text-sm font-medium px-4 py-2 rounded-lg hover:bg-brand-burgundyDark transition-colors">
          <i class="pi pi-search text-sm"></i>
          Browse Courses
        </RouterLink>
      </div>

      <!-- Loading skeletons -->
      <div v-if="loading" class="grid gap-5" style="grid-template-columns: repeat(auto-fill, minmax(280px,1fr));">
        <div v-for="i in 4" :key="i"
             class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 animate-pulse">
          <div class="h-36 bg-gray-200 rounded-lg mb-4"></div>
          <div class="h-5 bg-gray-200 rounded mb-2"></div>
          <div class="h-4 bg-gray-100 rounded w-2/3"></div>
        </div>
      </div>

      <!-- Empty state -->
      <div v-else-if="enrollments.length === 0"
           class="flex flex-col items-center justify-center py-20 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
          <i class="pi pi-book text-2xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">No courses yet</h3>
        <p class="text-sm text-gray-400 mb-6 max-w-sm">
          You haven't enrolled in any courses. Browse the catalog to start learning.
        </p>
        <RouterLink to="/courses"
                    class="inline-flex items-center gap-2 bg-brand-burgundy text-white
                           text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-brand-burgundyDark transition-colors">
          Browse Courses
        </RouterLink>
      </div>

      <!-- Course grid -->
      <div v-else class="grid gap-5" style="grid-template-columns: repeat(auto-fill, minmax(280px,1fr));">
        <div v-for="c in enrollments" :key="c.id"
             class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">

          <!-- Cover -->
          <div class="h-36 bg-linear-to-br from-brand-burgundy to-brand-blue flex items-center justify-center">
            <i class="pi pi-book text-4xl text-white opacity-70"></i>
          </div>

          <div class="p-5">
            <p class="text-xs text-gray-400 mb-1 uppercase tracking-wide">{{ c.subject }}</p>
            <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ c.title }}</h3>
            <p class="text-xs text-gray-400 mb-4">{{ c.level }}</p>

            <!-- Progress bar -->
            <div v-if="progress[c.id] !== undefined" class="mb-4">
              <div class="flex justify-between text-xs text-gray-500 mb-1">
                <span>Progress</span>
                <span>{{ progress[c.id] }}%</span>
              </div>
              <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-brand-burgundy rounded-full transition-all duration-500"
                     :style="{ width: progress[c.id] + '%' }"></div>
              </div>
            </div>

            <RouterLink :to="`/courses/${c.id}`"
                        class="block text-center text-sm font-medium text-brand-burgundy border border-brand-burgundy
                               rounded-lg py-2 hover:bg-red-50 transition-colors">
              Continue Learning
            </RouterLink>
          </div>
        </div>
      </div>

    </main>

    <AppFooter />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AppHeader  from '@/components/layout/AppHeader.vue'
import AppFooter  from '@/components/layout/AppFooter.vue'
import CourseCard from '@/components/course/CourseCard.vue'
import { useAuthStore }    from '@/stores/auth'
import { useCoursesStore } from '@/stores/courses'

const auth  = useAuthStore()
const store = useCoursesStore()

const loading     = ref(true)
const enrollments = ref([])
const progress    = ref({})

onMounted(async () => {
  await store.fetchEnrollments()
  enrollments.value = store.enrollments

  await Promise.all(
    enrollments.value.map(async c => {
      await store.fetchProgress(c.id)
      progress.value[c.id] = store.progress[c.id]?.percentage ?? 0
    })
  )
  loading.value = false
})
</script>
