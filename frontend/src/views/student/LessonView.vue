<template>
  <div class="lesson-page">
    <AppHeader />

    <div v-if="loading" class="container lesson-layout">
      <Skeleton height="400px" />
    </div>

    <template v-else-if="lesson">
      <div class="container lesson-layout">
        <!-- Sidebar -->
        <aside class="lesson-sidebar">
          <div class="sidebar-header">
            <RouterLink :to="`/courses/${lesson.course_id}`" class="back-link">
              <i class="pi pi-arrow-left"></i> {{ t('student.backToCourse') }}
            </RouterLink>
          </div>

          <div class="progress-block">
            <div class="progress-label">
              <span>{{ t('student.courseProgress') }}</span>
              <strong>{{ progress?.percentage ?? 0 }}%</strong>
            </div>
            <ProgressBar :value="progress?.percentage ?? 0" />
          </div>

          <div class="sidebar-lessons">
            <div v-for="mod in courseModules" :key="mod.id" class="sidebar-module">
              <div class="sidebar-module-title">{{ mod.title }}</div>
              <RouterLink
                v-for="l in mod.lessons"
                :key="l.id"
                :to="`/lessons/${l.id}`"
                class="sidebar-lesson"
                :class="{ active: l.id === lesson.id, completed: isCompleted(l.id) }"
              >
                <i class="pi sidebar-lesson-icon"
                   :class="isCompleted(l.id) ? 'pi-check-circle' : 'pi-circle'"></i>
                {{ l.title }}
              </RouterLink>
            </div>
          </div>
        </aside>

        <!-- Main content -->
        <main class="lesson-main">
          <h1 class="lesson-title">{{ lesson.title }}</h1>

          <div v-if="lesson.video_url" class="video-wrapper">
            <video controls :src="lesson.video_url" class="lesson-video">
              {{ t('student.videoNotSupported') }}
            </video>
          </div>
          <div v-else class="video-placeholder">
            <i class="pi pi-video"></i>
            <span>{{ t('student.videoComingSoon') }}</span>
          </div>

          <div v-if="lesson.text_content" class="lesson-content">
            <h2>{{ t('student.lessonNotes') }}</h2>
            <div class="content-body" v-html="lesson.text_content"></div>
          </div>

          <div v-if="lesson.materials?.length" class="lesson-materials">
            <h2>{{ t('student.materials') }}</h2>
            <a
              v-for="m in lesson.materials"
              :key="m.id"
              :href="m.file_url"
              target="_blank"
              class="material-item"
            >
              <i class="pi pi-file-pdf"></i>
              {{ m.title }}
              <i class="pi pi-download ml-auto"></i>
            </a>
          </div>

          <div v-if="lesson.homework" class="lesson-homework">
            <h2>{{ t('student.homework') }}</h2>
            <p>{{ lesson.homework.description }}</p>
            <RouterLink :to="`/lessons/${lesson.id}/homework`">
              <Button :label="t('student.goToAssignment')" icon="pi pi-pencil" outlined />
            </RouterLink>
          </div>

          <div class="lesson-actions">
            <Button
              v-if="!isCurrentCompleted"
              :label="t('student.completeLesson')"
              icon="pi pi-check"
              :loading="completing"
              @click="handleComplete"
            />
            <div v-else class="completed-badge">
              <i class="pi pi-check-circle"></i> {{ t('student.lessonCompleted') }}
            </div>

            <Button
              v-if="nextLesson"
              :label="t('student.nextLesson')"
              icon="pi pi-arrow-right"
              iconPos="right"
              severity="secondary"
              outlined
              @click="$router.push(`/lessons/${nextLesson.id}`)"
            />
          </div>
        </main>
      </div>
    </template>

    <AppFooter />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import { useToast } from 'primevue/usetoast'
import Button      from 'primevue/button'
import ProgressBar from 'primevue/progressbar'
import Skeleton    from 'primevue/skeleton'
import AppHeader from '@/components/layout/AppHeader.vue'
import AppFooter from '@/components/layout/AppFooter.vue'
import { lessonsApi, progressApi } from '@/api'
import { useCoursesStore } from '@/stores/courses'

const { t } = useI18n()
const route = useRoute()
const toast = useToast()
const store  = useCoursesStore()

const loading    = ref(true)
const completing = ref(false)
const lesson     = ref(null)
const progress   = ref(null)
const completedIds  = ref([])
const courseModules = ref([])

const isCurrentCompleted = computed(() => completedIds.value.includes(Number(route.params.id)))

const allLessons = computed(() => courseModules.value.flatMap(m => m.lessons ?? []))

const nextLesson = computed(() => {
  const idx = allLessons.value.findIndex(l => l.id === lesson.value?.id)
  return idx !== -1 ? allLessons.value[idx + 1] : null
})

async function loadLesson(id) {
  loading.value = true
  try {
    const res = await lessonsApi.get(id)
    lesson.value = res.data.data

    await store.fetchCourse(lesson.value.course_id)
    courseModules.value = store.current?.modules ?? []

    const prog = await progressApi.course(lesson.value.course_id)
    progress.value     = prog.data.data
    completedIds.value = prog.data.data.completed_ids.map(Number)
  } finally {
    loading.value = false
  }
}

onMounted(() => loadLesson(Number(route.params.id)))
watch(() => route.params.id, id => loadLesson(Number(id)))

async function handleComplete() {
  completing.value = true
  try {
    await progressApi.completeLesson(lesson.value.id)
    completedIds.value.push(lesson.value.id)
    const prog = await progressApi.course(lesson.value.course_id)
    progress.value = prog.data.data
    toast.add({ severity: 'success', summary: t('toast.lessonDone'), detail: t('toast.lessonDoneDetail'), life: 3000 })
  } catch (e) {
    toast.add({ severity: 'error', summary: t('toast.error'), detail: e.response?.data?.error || t('toast.lessonError'), life: 3000 })
  } finally {
    completing.value = false
  }
}

function isCompleted(lessonId) {
  return completedIds.value.includes(Number(lessonId))
}
</script>

<style scoped>
.lesson-page { display: flex; flex-direction: column; min-height: 100vh; }

.lesson-layout {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 2rem;
  padding: 2rem 1.5rem;
  align-items: start;
}

.lesson-sidebar {
  background: #fff;
  border: 1px solid var(--border-color);
  border-radius: var(--radius);
  position: sticky;
  top: 80px;
  max-height: calc(100vh - 100px);
  overflow-y: auto;
}

.sidebar-header { padding: 1rem; border-bottom: 1px solid var(--border-color); }

.back-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: var(--text-muted);
  transition: color .2s;
}

.back-link:hover { color: var(--brand-burgundy); }

.progress-block {
  padding: 1rem;
  border-bottom: 1px solid var(--border-color);
}

.progress-label {
  display: flex;
  justify-content: space-between;
  font-size: 0.8rem;
  color: var(--text-muted);
  margin-bottom: 0.5rem;
}

.sidebar-lessons { padding: 0.5rem; }

.sidebar-module-title {
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .05em;
  color: var(--text-muted);
  padding: 0.5rem 0.5rem 0.25rem;
}

.sidebar-lesson {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 0.75rem;
  border-radius: 6px;
  font-size: 0.85rem;
  color: var(--text-primary);
  cursor: pointer;
  transition: background .15s;
  text-decoration: none;
  line-height: 1.4;
}

.sidebar-lesson:hover { background: var(--surface-50); }

.sidebar-lesson.active {
  background: #fdf1f1;
  color: var(--brand-burgundy);
  font-weight: 600;
}

.sidebar-lesson.completed .sidebar-lesson-icon { color: #16a34a; }
.sidebar-lesson-icon { flex-shrink: 0; font-size: 0.875rem; color: var(--text-muted); }

.lesson-title {
  font-size: 1.75rem;
  font-weight: 800;
  margin: 0 0 1.5rem;
}

.video-wrapper {
  background: #000;
  border-radius: var(--radius);
  overflow: hidden;
  margin-bottom: 2rem;
}

.lesson-video {
  width: 100%;
  max-height: 500px;
  display: block;
}

.video-placeholder {
  background: #111;
  border-radius: var(--radius);
  height: 280px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  color: #555;
  font-size: 0.875rem;
  margin-bottom: 2rem;
}

.video-placeholder i { font-size: 3rem; }

.lesson-content, .lesson-materials, .lesson-homework { margin-bottom: 2rem; }

.lesson-content h2, .lesson-materials h2, .lesson-homework h2 {
  font-size: 1.1rem;
  font-weight: 700;
  margin: 0 0 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 1px solid var(--border-color);
}

.content-body {
  font-size: 0.95rem;
  line-height: 1.8;
  color: var(--text-primary);
}

.material-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  border: 1px solid var(--border-color);
  border-radius: 6px;
  font-size: 0.875rem;
  color: var(--text-primary);
  text-decoration: none;
  transition: border-color .2s, background .2s;
  margin-bottom: 0.5rem;
}

.material-item:hover {
  background: var(--surface-50);
  border-color: var(--brand-burgundy);
}

.material-item .pi-file-pdf { color: #dc2626; }

.ml-auto { margin-left: auto; }

.lesson-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding-top: 1.5rem;
  border-top: 1px solid var(--border-color);
  margin-top: 1rem;
}

.completed-badge {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: #16a34a;
  font-weight: 600;
  font-size: 0.9rem;
}
</style>
