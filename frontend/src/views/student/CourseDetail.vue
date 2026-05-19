<template>
  <div class="page">
    <AppHeader />

    <div v-if="loading" class="container" style="padding:2rem 1.5rem">
      <Skeleton height="200px" class="mb-4" />
      <Skeleton height="40px" width="60%" class="mb-4" />
      <Skeleton height="300px" />
    </div>

    <template v-else-if="course">
      <div class="course-hero">
        <div class="container course-hero-inner">
          <div class="course-hero-content">
            <div class="course-meta">
              <Tag :value="course.subject" v-if="course.subject" />
              <Tag :value="course.level" severity="warn" v-if="course.level" />
            </div>
            <h1 class="course-hero-title">{{ course.title }}</h1>
            <p class="course-hero-desc">{{ course.description }}</p>
            <div class="course-hero-cta">
              <template v-if="isEnrolled">
                <Button :label="t('student.continueLearning')" icon="pi pi-play" @click="continueLesson" />
                <span class="enrolled-badge">
                  <i class="pi pi-check-circle"></i> {{ t('student.enrolled') }}
                </span>
              </template>
              <template v-else>
                <div class="course-price">
                  {{ course.price > 0 ? `${course.price} ₸` : t('common.free') }}
                </div>
                <Button
                  :label="enrolling ? t('student.enrolling') : t('student.enrollCourse')"
                  icon="pi pi-user-plus"
                  :loading="enrolling"
                  :disabled="!auth.isLoggedIn"
                  @click="handleEnroll"
                />
                <RouterLink v-if="!auth.isLoggedIn" to="/login">
                  <Button :label="t('student.loginToEnroll')" severity="secondary" outlined />
                </RouterLink>
              </template>
            </div>
          </div>
        </div>
      </div>

      <div class="container" style="padding:2rem 1.5rem">
        <h2 class="section-title">{{ t('student.courseContent') }}</h2>
        <div class="stats-row mb-6">
          <span><i class="pi pi-book"></i> {{ t('student.lessons', { count: totalLessons }) }}</span>
          <span><i class="pi pi-th-large"></i> {{ t('student.modules', { count: course.modules?.length }) }}</span>
        </div>

        <Accordion :value="openModules" multiple>
          <AccordionPanel v-for="mod in course.modules" :key="mod.id" :value="mod.id">
            <AccordionHeader>
              <span class="module-title">{{ mod.order_num }}. {{ mod.title }}</span>
              <Tag :value="`${mod.lessons?.length}`" severity="secondary" class="ml-auto" />
            </AccordionHeader>
            <AccordionContent>
              <div class="lessons-list">
                <div
                  v-for="lesson in mod.lessons"
                  :key="lesson.id"
                  class="lesson-item"
                  :class="{ locked: !isEnrolled && !lesson.is_free_preview, completed: isCompleted(lesson.id) }"
                  @click="openLesson(lesson)"
                >
                  <i class="lesson-icon pi" :class="getLessonIcon(lesson)"></i>
                  <span class="lesson-name">{{ lesson.order_num }}. {{ lesson.title }}</span>
                  <Tag v-if="lesson.is_free_preview" :value="t('student.freePreview')" severity="success" class="ml-auto" />
                </div>
              </div>
            </AccordionContent>
          </AccordionPanel>
        </Accordion>
      </div>
    </template>

    <AppFooter />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { useToast } from 'primevue/usetoast'
import Button    from 'primevue/button'
import Tag       from 'primevue/tag'
import Skeleton  from 'primevue/skeleton'
import Accordion        from 'primevue/accordion'
import AccordionPanel   from 'primevue/accordionpanel'
import AccordionHeader  from 'primevue/accordionheader'
import AccordionContent from 'primevue/accordioncontent'
import AppHeader  from '@/components/layout/AppHeader.vue'
import AppFooter  from '@/components/layout/AppFooter.vue'
import { useAuthStore }    from '@/stores/auth'
import { useCoursesStore } from '@/stores/courses'
import { enrollmentsApi, progressApi } from '@/api'

const { t } = useI18n()
const route  = useRoute()
const router = useRouter()
const toast  = useToast()
const auth   = useAuthStore()
const store  = useCoursesStore()

const loading    = ref(true)
const enrolling  = ref(false)
const course     = ref(null)
const isEnrolled = ref(false)
const completedIds = ref([])

const openModules  = computed(() => course.value?.modules?.map(m => m.id) ?? [])
const totalLessons = computed(() => course.value?.modules?.reduce((s, m) => s + (m.lessons?.length ?? 0), 0) ?? 0)

onMounted(async () => {
  const id = Number(route.params.id)
  await store.fetchCourse(id)
  course.value = store.current

  if (auth.isLoggedIn) {
    await store.fetchEnrollments()
    isEnrolled.value = store.enrollments.some(e => e.id === id)

    if (isEnrolled.value) {
      const res = await progressApi.course(id)
      completedIds.value = res.data.data.completed_ids.map(Number)
    }
  }
  loading.value = false
})

async function handleEnroll() {
  if (!auth.isLoggedIn) { router.push('/login'); return }
  enrolling.value = true
  try {
    await enrollmentsApi.enroll(course.value.id)
    isEnrolled.value = true
    toast.add({ severity: 'success', summary: t('toast.enrolled'), detail: t('toast.enrolledDetail'), life: 3000 })
  } catch (e) {
    toast.add({ severity: 'error', summary: t('toast.error'), detail: e.response?.data?.error || t('toast.enrollError'), life: 3000 })
  } finally {
    enrolling.value = false
  }
}

function continueLesson() {
  const firstLesson = course.value?.modules?.[0]?.lessons?.[0]
  if (firstLesson) router.push(`/lessons/${firstLesson.id}`)
}

function openLesson(lesson) {
  if (!isEnrolled.value && !lesson.is_free_preview) return
  router.push(`/lessons/${lesson.id}`)
}

function isCompleted(lessonId) {
  return completedIds.value.includes(Number(lessonId))
}

function getLessonIcon(lesson) {
  if (isCompleted(lesson.id)) return 'pi-check-circle'
  if (!isEnrolled.value && !lesson.is_free_preview) return 'pi-lock'
  return 'pi-play-circle'
}
</script>

<style scoped>
.page { display: flex; flex-direction: column; min-height: 100vh; }

.course-hero {
  background: linear-gradient(135deg, var(--brand-blue) 0%, #1e4d8c 100%);
  color: #fff;
  padding: 3.5rem 0;
}

.course-hero-inner { max-width: 800px; }

.course-meta { display: flex; gap: 0.5rem; margin-bottom: 1rem; }

.course-hero-title {
  font-size: 2.25rem;
  font-weight: 900;
  margin: 0 0 1rem;
  line-height: 1.2;
}

.course-hero-desc {
  font-size: 1rem;
  opacity: 0.85;
  line-height: 1.7;
  margin: 0 0 2rem;
}

.course-hero-cta {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.course-price {
  font-size: 1.75rem;
  font-weight: 900;
  color: #fff;
}

.enrolled-badge {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  color: #86efac;
  font-weight: 600;
}

.section-title {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0 0 1rem;
}

.stats-row {
  display: flex;
  gap: 1.5rem;
  color: var(--text-muted);
  font-size: 0.875rem;
}

.stats-row span { display: flex; align-items: center; gap: 0.4rem; }

.module-title { font-weight: 600; }
.ml-auto { margin-left: auto; }

.lessons-list { display: flex; flex-direction: column; gap: 0.25rem; }

.lesson-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  transition: background .15s;
  font-size: 0.9rem;
}

.lesson-item:hover { background: var(--surface-50); }
.lesson-item.locked { opacity: 0.5; cursor: not-allowed; }
.lesson-item.completed .lesson-icon { color: #16a34a; }

.lesson-icon { font-size: 1rem; color: var(--brand-burgundy); flex-shrink: 0; }
.lesson-name { flex: 1; }
</style>
