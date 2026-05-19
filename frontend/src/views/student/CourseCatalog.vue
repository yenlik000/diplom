<template>
  <div class="page">
    <AppHeader />
    <main class="container" style="padding: 2rem 1.5rem;">
      <h1 class="page-title">{{ t('student.catalog') }}</h1>

      <div v-if="loading" class="grid grid-3">
        <Skeleton v-for="i in 6" :key="i" height="280px" border-radius="8px" />
      </div>

      <div v-else-if="courses.length === 0" class="empty-state">
        <p>{{ t('student.comingSoon') }}</p>
      </div>

      <div v-else class="grid grid-3">
        <CourseCard v-for="c in courses" :key="c.id" :course="c" />
      </div>
    </main>
    <AppFooter />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import Skeleton   from 'primevue/skeleton'
import AppHeader  from '@/components/layout/AppHeader.vue'
import AppFooter  from '@/components/layout/AppFooter.vue'
import CourseCard from '@/components/course/CourseCard.vue'
import { useCoursesStore } from '@/stores/courses'

const { t } = useI18n()
const store   = useCoursesStore()
const loading = ref(true)
const courses = ref([])

onMounted(async () => {
  await store.fetchCourses()
  courses.value = store.courses
  loading.value = false
})
</script>

<style scoped>
.page { display: flex; flex-direction: column; min-height: 100vh; }
.empty-state { text-align: center; padding: 4rem; color: var(--text-muted); }
</style>
