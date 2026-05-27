<template>
  <TeacherLayout>
    <!-- Back link -->
    <div class="flex items-center gap-2 mb-6">
      <button class="back-btn" @click="router.push('/teacher/courses')">
        <i class="pi pi-arrow-left" style="font-size:.8rem;"></i>
        Back to Courses
      </button>
    </div>

    <!-- Header -->
    <div class="flex items-start justify-between mb-7" v-if="course">
      <div>
        <h1 class="page-title">{{ course.title }}</h1>
        <p class="page-sub">{{ course.subject }} · {{ course.level }}</p>
      </div>
      <button class="btn-add-module" @click="openAddModule">
        <i class="pi pi-plus" style="font-size:.78rem;"></i>
        Add Module
      </button>
    </div>

    <!-- Loading -->
    <div v-if="loading" class="flex flex-col gap-4">
      <div v-for="i in 3" :key="i" class="animate-pulse bg-white rounded-2xl" style="height:80px;border:1px solid #e5e7eb;"></div>
    </div>

    <!-- Modules list -->
    <div v-else-if="course" class="flex flex-col gap-4">
      <div v-if="!course.modules?.length" class="empty-state">
        <i class="pi pi-book" style="font-size:2.5rem;color:#d1d5db;"></i>
        <p class="font-bold mt-3" style="color:#374151;">No modules yet</p>
        <p class="text-sm mt-1" style="color:#9ca3af;">Add a module to start building your curriculum</p>
      </div>

      <div v-for="mod in course.modules" :key="mod.id" class="module-card">
        <!-- Module header -->
        <div class="module-header" @click="toggleModule(mod.id)">
          <div class="flex items-center gap-3">
            <div class="mod-chevron" :class="{ open: openModules.has(mod.id) }">
              <i class="pi pi-chevron-right" style="font-size:.75rem;"></i>
            </div>
            <span class="mod-title">{{ mod.title }}</span>
            <span class="mod-badge">{{ mod.lessons?.length || 0 }} lessons</span>
          </div>
          <div class="flex items-center gap-1" @click.stop>
            <button class="icon-btn" title="Edit module" @click="openEditModule(mod)">
              <i class="pi pi-pencil" style="font-size:.78rem;"></i>
            </button>
            <button class="icon-btn danger" title="Delete module" @click="deleteModule(mod)">
              <i class="pi pi-trash" style="font-size:.78rem;"></i>
            </button>
          </div>
        </div>

        <!-- Lessons -->
        <div v-if="openModules.has(mod.id)" class="lessons-body">
          <div v-if="!mod.lessons?.length" class="no-lessons">No lessons yet</div>

          <div v-for="lesson in mod.lessons" :key="lesson.id" class="lesson-row">
            <div class="lesson-info">
              <div class="lesson-title">{{ lesson.title }}</div>
              <div class="lesson-meta">
                <span v-if="lesson.video_url" class="meta-chip video">
                  <i class="pi pi-video" style="font-size:.7rem;"></i> Video
                </span>
                <span v-if="lesson.audio_url" class="meta-chip audio">
                  <i class="pi pi-volume-up" style="font-size:.7rem;"></i> Audio
                </span>
                <span v-if="lesson.text_content" class="meta-chip text">
                  <i class="pi pi-align-left" style="font-size:.7rem;"></i> Text
                </span>
                <span v-if="lesson.is_free_preview === 'true' || lesson.is_free_preview === true" class="meta-chip free">Free preview</span>
                <span v-if="lesson.homework_id" class="meta-chip quiz">
                  <i class="pi pi-check-square" style="font-size:.7rem;"></i> Quiz
                </span>
              </div>
            </div>

            <div class="lesson-actions">
              <!-- Video upload -->
              <label class="upload-btn" :class="{ uploading: uploadingLesson === lesson.id && uploadingType === 'video' }" :title="lesson.video_url ? 'Replace video' : 'Upload video'">
                <input type="file" accept="video/mp4,video/webm,.mp4,.webm,.mov" class="hidden-input"
                       :disabled="uploadingLesson === lesson.id"
                       @change="handleVideoUpload(lesson, $event)" />
                <i class="pi pi-video" style="font-size:.8rem;"></i>
                <span v-if="uploadingLesson === lesson.id && uploadingType === 'video'">
                  {{ uploadProgress }}%
                </span>
                <span v-else>{{ lesson.video_url ? 'Replace' : 'Upload' }} Video</span>
              </label>

              <!-- Audio upload -->
              <label class="upload-btn audio" :class="{ uploading: uploadingLesson === lesson.id && uploadingType === 'audio' }" :title="lesson.audio_url ? 'Replace audio' : 'Upload audio'">
                <input type="file" accept="audio/mpeg,audio/mp3,audio/ogg,audio/wav,.mp3,.ogg,.wav,.m4a" class="hidden-input"
                       :disabled="uploadingLesson === lesson.id"
                       @change="handleAudioUpload(lesson, $event)" />
                <i class="pi pi-volume-up" style="font-size:.8rem;"></i>
                <span v-if="uploadingLesson === lesson.id && uploadingType === 'audio'">
                  {{ uploadProgress }}%
                </span>
                <span v-else>{{ lesson.audio_url ? 'Replace' : 'Upload' }} Audio</span>
              </label>

              <!-- Quiz -->
              <button class="upload-btn quiz-btn" :title="lesson.homework_id ? 'Edit quiz' : 'Add quiz'"
                      @click="openQuizBuilder(lesson)">
                <i class="pi pi-check-square" style="font-size:.8rem;"></i>
                {{ lesson.homework_id ? 'Edit Quiz' : 'Add Quiz' }}
              </button>
              <button v-if="lesson.homework_id" class="icon-btn danger" title="Delete quiz" @click="deleteQuiz(lesson)">
                <i class="pi pi-trash" style="font-size:.78rem;"></i>
              </button>

              <button class="icon-btn" title="Edit lesson" @click="openEditLesson(lesson, mod)">
                <i class="pi pi-pencil" style="font-size:.78rem;"></i>
              </button>
              <button class="icon-btn danger" title="Delete lesson" @click="deleteLesson(lesson, mod)">
                <i class="pi pi-trash" style="font-size:.78rem;"></i>
              </button>
            </div>
          </div>

          <!-- Add lesson button -->
          <button class="add-lesson-btn" @click="openAddLesson(mod)">
            <i class="pi pi-plus" style="font-size:.75rem;"></i>
            Add Lesson
          </button>
        </div>
      </div>
    </div>

    <!-- ── Module modal ── -->
    <div v-if="moduleDialog" class="modal-overlay" @click.self="moduleDialog = false">
      <div class="modal-box">
        <div class="flex items-center justify-between mb-5">
          <h3 class="modal-title">{{ editingModuleId ? 'Edit Module' : 'Add Module' }}</h3>
          <button class="icon-btn" @click="moduleDialog = false"><i class="pi pi-times"></i></button>
        </div>
        <form @submit.prevent="saveModule" class="flex flex-col gap-4">
          <div class="f-field">
            <label>Module Title</label>
            <input v-model="moduleForm.title" required class="f-input" placeholder="e.g. Introduction to Algebra" />
          </div>
          <div class="f-field">
            <label>Order</label>
            <input v-model.number="moduleForm.order_num" type="number" min="1" class="f-input" />
          </div>
          <p v-if="moduleError" class="err-text">{{ moduleError }}</p>
          <div class="flex justify-end gap-3">
            <button type="button" class="btn-cancel" @click="moduleDialog = false">Cancel</button>
            <button type="submit" class="btn-save" :disabled="moduleSaving">
              {{ moduleSaving ? 'Saving…' : 'Save' }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- ── Lesson modal ── -->
    <div v-if="lessonDialog" class="modal-overlay" @click.self="lessonDialog = false">
      <div class="modal-box" style="width:580px;">
        <div class="flex items-center justify-between mb-5">
          <h3 class="modal-title">{{ editingLessonId ? 'Edit Lesson' : 'Add Lesson' }}</h3>
          <button class="icon-btn" @click="lessonDialog = false"><i class="pi pi-times"></i></button>
        </div>
        <form @submit.prevent="saveLesson" class="flex flex-col gap-4">
          <div class="f-field">
            <label>Lesson Title</label>
            <input v-model="lessonForm.title" required class="f-input" placeholder="e.g. Variables and Expressions" />
          </div>
          <div class="flex gap-3">
            <div class="f-field flex-1">
              <label>Order</label>
              <input v-model.number="lessonForm.order_num" type="number" min="1" class="f-input" />
            </div>
            <div class="f-field flex-1">
              <label>Duration (seconds)</label>
              <input v-model.number="lessonForm.duration_seconds" type="number" min="0" class="f-input" placeholder="0" />
            </div>
          </div>
          <div class="f-field">
            <label>Text Content (optional)</label>
            <textarea v-model="lessonForm.text_content" rows="4" class="f-input" placeholder="Lesson notes or transcript…"></textarea>
          </div>
          <div class="flex items-center gap-2">
            <input type="checkbox" v-model="lessonForm.is_free_preview" id="free-preview" style="width:15px;height:15px;accent-color:#7B1A1A;cursor:pointer;" />
            <label for="free-preview" style="font-size:.875rem;font-weight:600;color:#374151;cursor:pointer;">Free Preview</label>
          </div>
          <p v-if="lessonError" class="err-text">{{ lessonError }}</p>
          <div class="flex justify-end gap-3">
            <button type="button" class="btn-cancel" @click="lessonDialog = false">Cancel</button>
            <button type="submit" class="btn-save" :disabled="lessonSaving">
              {{ lessonSaving ? 'Saving…' : 'Save' }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- ── Quiz builder modal ── -->
    <div v-if="quizDialog" class="modal-overlay" @click.self="quizDialog = false">
      <div class="modal-box quiz-modal">
        <div class="flex items-center justify-between mb-5">
          <h3 class="modal-title">{{ quizHwId ? 'Edit Quiz' : 'Add Quiz' }}</h3>
          <button class="icon-btn" @click="quizDialog = false"><i class="pi pi-times"></i></button>
        </div>

        <div class="f-field mb-4">
          <label>Quiz Title</label>
          <input v-model="quizForm.title" required class="f-input" placeholder="e.g. Module 1 Quiz" />
        </div>

        <div class="quiz-questions">
          <div v-for="(q, qi) in quizForm.questions" :key="qi" class="quiz-question-block">
            <div class="flex items-center justify-between mb-2">
              <span class="q-label">Question {{ qi + 1 }}</span>
              <button class="icon-btn danger" @click="removeQuestion(qi)" title="Remove question">
                <i class="pi pi-times" style="font-size:.75rem;"></i>
              </button>
            </div>
            <input v-model="q.question_text" class="f-input mb-3" :placeholder="`Enter question ${qi + 1}…`" />

            <div class="options-list">
              <div v-for="(opt, oi) in q.options" :key="oi" class="option-row">
                <label class="opt-radio-wrap" :title="'Mark as correct answer'">
                  <input type="radio" :name="`correct-${qi}`" :checked="opt.is_correct"
                         @change="setCorrect(qi, oi)" />
                </label>
                <input v-model="opt.option_text" class="f-input opt-input" :placeholder="`Option ${String.fromCharCode(65 + oi)}…`" />
                <button v-if="q.options.length > 2" class="icon-btn danger" style="flex-shrink:0;" @click="removeOption(qi, oi)">
                  <i class="pi pi-times" style="font-size:.7rem;"></i>
                </button>
              </div>
              <button v-if="q.options.length < 4" class="add-option-btn" @click="addOption(qi)">
                <i class="pi pi-plus" style="font-size:.7rem;"></i> Add Option
              </button>
            </div>
          </div>

          <button class="add-question-btn" @click="addQuestion">
            <i class="pi pi-plus" style="font-size:.75rem;"></i> Add Question
          </button>
        </div>

        <p v-if="quizError" class="err-text mt-3">{{ quizError }}</p>
        <div class="flex justify-end gap-3 mt-5">
          <button type="button" class="btn-cancel" @click="quizDialog = false">Cancel</button>
          <button class="btn-save" :disabled="quizSaving" @click="saveQuiz">
            {{ quizSaving ? 'Saving…' : 'Save Quiz' }}
          </button>
        </div>
      </div>
    </div>

    <!-- Toast -->
    <transition name="toast">
      <div v-if="toast" class="toast">{{ toast }}</div>
    </transition>

  </TeacherLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import TeacherLayout from '@/components/teacher/TeacherLayout.vue'
import { teacherApi, modulesApi, lessonsApi, homeworkApi, coursesApi } from '@/api'

const route  = useRoute()
const router = useRouter()

const courseId = Number(route.params.id)

const loading = ref(true)
const course  = ref(null)
const toast   = ref('')

// Open/closed modules
const openModules = ref(new Set())

// Upload state
const uploadingLesson = ref(null)
const uploadingType   = ref('')
const uploadProgress  = ref(0)

// Module modal
const moduleDialog    = ref(false)
const editingModuleId = ref(null)
const moduleSaving    = ref(false)
const moduleError     = ref('')
const moduleForm      = ref({ title: '', order_num: 1 })

// Lesson modal
const lessonDialog    = ref(false)
const editingLessonId = ref(null)
const lessonModuleId  = ref(null)
const lessonSaving    = ref(false)
const lessonError     = ref('')
const lessonForm      = ref(emptyLessonForm())

function emptyLessonForm() {
  return { title: '', order_num: 1, duration_seconds: 0, text_content: '', is_free_preview: false }
}

// ── Load ──────────────────────────────────────────────────────
onMounted(async () => {
  try {
    const res = await teacherApi.getCourse(courseId)
    course.value = res.data.data
    // Open first module by default
    if (course.value.modules?.length) {
      openModules.value.add(Number(course.value.modules[0].id))
    }
  } finally {
    loading.value = false
  }
})

// ── Helpers ───────────────────────────────────────────────────
function toggleModule(id) {
  const n = Number(id)
  if (openModules.value.has(n)) openModules.value.delete(n)
  else openModules.value.add(n)
}

function showToast(msg) {
  toast.value = msg
  setTimeout(() => { toast.value = '' }, 2800)
}

async function reload() {
  const res = await teacherApi.getCourse(courseId)
  course.value = res.data.data
}

// ── Module CRUD ───────────────────────────────────────────────
function openAddModule() {
  editingModuleId.value = null
  moduleForm.value = { title: '', order_num: (course.value.modules?.length || 0) + 1 }
  moduleError.value = ''
  moduleDialog.value = true
}

function openEditModule(mod) {
  editingModuleId.value = mod.id
  moduleForm.value = { title: mod.title, order_num: mod.order_num }
  moduleError.value = ''
  moduleDialog.value = true
}

async function saveModule() {
  moduleError.value = ''
  moduleSaving.value = true
  try {
    if (editingModuleId.value) {
      await modulesApi.update(editingModuleId.value, moduleForm.value)
    } else {
      await modulesApi.create(courseId, moduleForm.value)
    }
    moduleDialog.value = false
    await reload()
    // Open newly created module
    if (!editingModuleId.value && course.value.modules?.length) {
      const last = course.value.modules[course.value.modules.length - 1]
      openModules.value.add(Number(last.id))
    }
    showToast(editingModuleId.value ? 'Module updated' : 'Module added')
  } catch (e) {
    moduleError.value = e.response?.data?.error || 'Failed to save module'
  } finally {
    moduleSaving.value = false
  }
}

async function deleteModule(mod) {
  if (!confirm(`Delete module "${mod.title}" and all its lessons?`)) return
  await modulesApi.remove(mod.id)
  await reload()
  showToast('Module deleted')
}

// ── Lesson CRUD ───────────────────────────────────────────────
function openAddLesson(mod) {
  editingLessonId.value = null
  lessonModuleId.value  = mod.id
  lessonForm.value = { ...emptyLessonForm(), order_num: (mod.lessons?.length || 0) + 1 }
  lessonError.value = ''
  lessonDialog.value = true
}

function openEditLesson(lesson, mod) {
  editingLessonId.value = lesson.id
  lessonModuleId.value  = mod.id
  lessonForm.value = {
    title:            lesson.title,
    order_num:        Number(lesson.order_num),
    duration_seconds: Number(lesson.duration_seconds),
    text_content:     lesson.text_content || '',
    is_free_preview:  lesson.is_free_preview === 'true' || lesson.is_free_preview === true,
  }
  lessonError.value = ''
  lessonDialog.value = true
}

async function saveLesson() {
  lessonError.value = ''
  lessonSaving.value = true
  try {
    const payload = { ...lessonForm.value }
    if (editingLessonId.value) {
      await lessonsApi.update(editingLessonId.value, payload)
    } else {
      await lessonsApi.create(lessonModuleId.value, payload)
    }
    lessonDialog.value = false
    await reload()
    openModules.value.add(Number(lessonModuleId.value))
    showToast(editingLessonId.value ? 'Lesson updated' : 'Lesson added')
  } catch (e) {
    lessonError.value = e.response?.data?.error || 'Failed to save lesson'
  } finally {
    lessonSaving.value = false
  }
}

async function deleteLesson(lesson, mod) {
  if (!confirm(`Delete lesson "${lesson.title}"?`)) return
  await lessonsApi.remove(lesson.id)
  await reload()
  openModules.value.add(Number(mod.id))
  showToast('Lesson deleted')
}

// ── Quiz builder ─────────────────────────────────────────────
const quizDialog   = ref(false)
const quizLessonId = ref(null)
const quizHwId     = ref(null)
const quizSaving   = ref(false)
const quizError    = ref('')
const quizForm     = ref({ title: '', questions: [] })

function emptyQuestion() {
  return {
    question_text: '',
    question_type: 'multiple_choice',
    options: [
      { option_text: '', is_correct: true },
      { option_text: '', is_correct: false },
    ],
  }
}

async function openQuizBuilder(lesson) {
  quizLessonId.value = lesson.id
  quizError.value    = ''

  if (lesson.homework_id) {
    quizHwId.value = lesson.homework_id
    const res      = await homeworkApi.edit(lesson.homework_id)
    const hw       = res.data.data
    quizForm.value = {
      title: hw.title,
      questions: hw.questions.map(q => ({
        question_text: q.question_text,
        question_type: q.question_type,
        options: q.options.map(o => ({
          option_text: o.option_text,
          is_correct: o.is_correct === true || o.is_correct === 'true' || o.is_correct === 't',
        })),
      })),
    }
  } else {
    quizHwId.value = null
    quizForm.value = { title: '', questions: [emptyQuestion()] }
  }
  quizDialog.value = true
}

function addQuestion() {
  quizForm.value.questions.push(emptyQuestion())
}

function removeQuestion(qi) {
  quizForm.value.questions.splice(qi, 1)
}

function addOption(qi) {
  quizForm.value.questions[qi].options.push({ option_text: '', is_correct: false })
}

function removeOption(qi, oi) {
  const q = quizForm.value.questions[qi]
  const wasCorrect = q.options[oi].is_correct
  q.options.splice(oi, 1)
  if (wasCorrect && q.options.length) q.options[0].is_correct = true
}

function setCorrect(qi, oi) {
  quizForm.value.questions[qi].options.forEach((o, i) => { o.is_correct = i === oi })
}

async function saveQuiz() {
  quizError.value = ''
  if (!quizForm.value.title.trim()) { quizError.value = 'Quiz title is required'; return }
  for (const [i, q] of quizForm.value.questions.entries()) {
    if (!q.question_text.trim()) { quizError.value = `Question ${i + 1} text is required`; return }
    if (!q.options.some(o => o.is_correct)) { quizError.value = `Question ${i + 1} needs a correct answer`; return }
  }
  quizSaving.value = true
  try {
    const payload = {
      title: quizForm.value.title,
      questions: quizForm.value.questions.map((q, idx) => ({
        question_text: q.question_text,
        question_type: q.question_type,
        order_num: idx + 1,
        options: q.options,
      })),
    }
    if (quizHwId.value) {
      await homeworkApi.update(quizHwId.value, payload)
      showToast('Quiz updated')
    } else {
      await homeworkApi.create(quizLessonId.value, payload)
      showToast('Quiz created')
    }
    quizDialog.value = false
    await reload()
    const moduleId = findModuleForLesson(quizLessonId.value)
    if (moduleId) openModules.value.add(moduleId)
  } catch (e) {
    quizError.value = e.response?.data?.error || 'Failed to save quiz'
  } finally {
    quizSaving.value = false
  }
}

async function deleteQuiz(lesson) {
  if (!confirm('Delete this quiz? Student submissions will also be removed.')) return
  await homeworkApi.destroy(lesson.homework_id)
  await reload()
  const moduleId = findModuleForLesson(lesson.id)
  if (moduleId) openModules.value.add(moduleId)
  showToast('Quiz deleted')
}

// ── Video / Audio upload ──────────────────────────────────────
function captureVideoThumbnail(file) {
  return new Promise(resolve => {
    const video = document.createElement('video')
    const url   = URL.createObjectURL(file)
    video.src         = url
    video.muted       = true
    video.preload     = 'metadata'
    video.currentTime = 1
    video.addEventListener('seeked', () => {
      const canvas  = document.createElement('canvas')
      canvas.width  = video.videoWidth  || 640
      canvas.height = video.videoHeight || 360
      canvas.getContext('2d').drawImage(video, 0, 0)
      canvas.toBlob(blob => { URL.revokeObjectURL(url); resolve(blob) }, 'image/jpeg', 0.85)
    }, { once: true })
    video.addEventListener('error', () => { URL.revokeObjectURL(url); resolve(null) }, { once: true })
    video.load()
  })
}

async function handleVideoUpload(lesson, event) {
  const file = event.target.files?.[0]
  if (!file) return
  event.target.value = ''

  uploadingLesson.value = lesson.id
  uploadingType.value   = 'video'
  uploadProgress.value  = 0

  try {
    await lessonsApi.uploadVideo(lesson.id, file, pct => { uploadProgress.value = pct })

    // Auto-set course cover from video thumbnail if not already set
    if (!course.value?.cover_image) {
      const thumb = await captureVideoThumbnail(file)
      if (thumb) {
        await coursesApi.uploadCover(courseId, new File([thumb], 'thumb.jpg', { type: 'image/jpeg' }))
      }
    }

    await reload()
    openModules.value.add(Number(lesson.module_id || findModuleForLesson(lesson.id)))
    showToast('Video uploaded successfully')
  } catch (e) {
    showToast('Video upload failed: ' + (e.response?.data?.error || e.message))
  } finally {
    uploadingLesson.value = null
    uploadingType.value   = ''
  }
}

async function handleAudioUpload(lesson, event) {
  const file = event.target.files?.[0]
  if (!file) return
  event.target.value = ''

  uploadingLesson.value = lesson.id
  uploadingType.value   = 'audio'
  uploadProgress.value  = 0

  try {
    await lessonsApi.uploadAudio(lesson.id, file, pct => { uploadProgress.value = pct })
    await reload()
    showToast('Audio uploaded successfully')
  } catch (e) {
    showToast('Audio upload failed: ' + (e.response?.data?.error || e.message))
  } finally {
    uploadingLesson.value = null
    uploadingType.value   = ''
  }
}

function findModuleForLesson(lessonId) {
  for (const mod of course.value?.modules || []) {
    if (mod.lessons?.some(l => Number(l.id) === Number(lessonId))) return Number(mod.id)
  }
  return null
}
</script>

<style scoped>
.back-btn {
  display: flex; align-items: center; gap: 7px;
  background: none; border: none; font-size: .875rem;
  font-weight: 600; color: #6b7280; cursor: pointer; padding: 0;
}
.back-btn:hover { color: #7B1A1A; }

.page-title { font-size: 1.85rem; font-weight: 800; color: #111827; margin: 0 0 4px; }
.page-sub   { font-size: .9rem; color: #6b7280; margin: 0; }

.btn-add-module {
  display: flex; align-items: center; gap: 7px;
  padding: .6rem 1.2rem; background: #7B1A1A; color: #fff;
  border: none; border-radius: 10px; font-size: .875rem; font-weight: 700; cursor: pointer;
  white-space: nowrap; transition: background .15s;
}
.btn-add-module:hover { background: #6a1616; }

/* Module card */
.module-card {
  background: #fff; border: 1px solid #e5e7eb; border-radius: 14px; overflow: hidden;
}
.module-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 16px 20px; cursor: pointer; transition: background .12s;
}
.module-header:hover { background: #fafafa; }

.mod-chevron {
  width: 22px; height: 22px; display: flex; align-items: center; justify-content: center;
  border-radius: 6px; background: #f3f4f6; flex-shrink: 0;
  transition: transform .2s; color: #6b7280;
}
.mod-chevron.open { transform: rotate(90deg); }

.mod-title { font-size: 1rem; font-weight: 700; color: #111827; }
.mod-badge {
  font-size: .72rem; font-weight: 600; color: #6b7280;
  background: #f3f4f6; border-radius: 999px; padding: 2px 9px;
}

/* Lessons body */
.lessons-body { border-top: 1px solid #e5e7eb; }
.no-lessons { padding: 14px 20px; font-size: .875rem; color: #9ca3af; }

.lesson-row {
  display: flex; align-items: center; justify-content: space-between; gap: 12px;
  padding: 12px 20px; border-bottom: 1px solid #f3f4f6;
}
.lesson-row:last-child { border-bottom: none; }

.lesson-info { flex: 1; min-width: 0; }
.lesson-title { font-size: .9rem; font-weight: 600; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.lesson-meta  { display: flex; flex-wrap: wrap; gap: 5px; margin-top: 4px; }

.meta-chip {
  display: inline-flex; align-items: center; gap: 4px;
  font-size: .7rem; font-weight: 600; border-radius: 999px; padding: 2px 8px;
}
.meta-chip.video { background: #eff6ff; color: #2563eb; }
.meta-chip.audio { background: #f0fdf4; color: #16a34a; }
.meta-chip.text  { background: #fafafa; color: #6b7280; }
.meta-chip.free  { background: #fef3c7; color: #b45309; }
.meta-chip.quiz  { background: #f5f3ff; color: #7c3aed; }

.lesson-actions { display: flex; align-items: center; gap: 6px; flex-shrink: 0; }

/* Upload button (label acting as button) */
.upload-btn {
  display: inline-flex; align-items: center; gap: 5px;
  padding: .38rem .75rem; border-radius: 8px; cursor: pointer;
  font-size: .78rem; font-weight: 600; border: 1.5px solid #e5e7eb;
  background: #fff; color: #374151; transition: all .15s; white-space: nowrap;
}
.upload-btn:hover { border-color: #7B1A1A; color: #7B1A1A; }
.upload-btn.audio:hover { border-color: #16a34a; color: #16a34a; }
.upload-btn.uploading  { opacity: .7; cursor: wait; }
.upload-btn.quiz-btn:hover { border-color: #7c3aed; color: #7c3aed; }
.hidden-input { display: none; }

/* Icon btn */
.icon-btn {
  width: 30px; height: 30px; border: none; background: transparent;
  border-radius: 7px; display: flex; align-items: center; justify-content: center;
  color: #6b7280; cursor: pointer; transition: background .12s;
}
.icon-btn:hover { background: #f3f4f6; color: #374151; }
.icon-btn.danger:hover { background: #fef2f2; color: #dc2626; }

/* Add lesson */
.add-lesson-btn {
  display: flex; align-items: center; gap: 6px;
  margin: 10px 20px 14px;
  padding: .45rem .9rem; border: 1.5px dashed #d1d5db; border-radius: 9px;
  background: none; color: #6b7280; font-size: .85rem; font-weight: 600; cursor: pointer;
  transition: border-color .15s, color .15s;
}
.add-lesson-btn:hover { border-color: #7B1A1A; color: #7B1A1A; }

/* Empty state */
.empty-state {
  display: flex; flex-direction: column; align-items: center;
  padding: 60px 20px; background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
}

/* Modal */
.modal-overlay {
  position: fixed; inset: 0; background: rgba(0,0,0,.35); z-index: 1000;
  display: flex; align-items: center; justify-content: center;
}
.modal-box {
  background: #fff; border-radius: 16px; padding: 28px;
  width: 480px; max-width: calc(100vw - 40px);
  max-height: calc(100vh - 80px); overflow-y: auto;
}
.modal-title { font-size: 1.1rem; font-weight: 800; color: #111827; margin: 0; }

.f-field { display: flex; flex-direction: column; gap: 5px; }
.f-field label { font-size: .85rem; font-weight: 600; color: #374151; }
.f-input {
  padding: .55rem .75rem; border: 1.5px solid #e5e7eb; border-radius: 8px;
  font-size: .875rem; color: #111827; font-family: inherit;
  outline: none; transition: border-color .15s; resize: vertical;
}
.f-input:focus { border-color: #7B1A1A; }

.btn-cancel {
  padding: .55rem 1.1rem; border: 1.5px solid #e5e7eb; border-radius: 8px;
  background: #fff; color: #374151; font-size: .875rem; font-weight: 600; cursor: pointer;
}
.btn-save {
  padding: .55rem 1.25rem; border: none; border-radius: 8px;
  background: #7B1A1A; color: #fff; font-size: .875rem; font-weight: 700; cursor: pointer;
  transition: background .15s;
}
.btn-save:hover:not(:disabled) { background: #6a1616; }
.btn-save:disabled { opacity: .5; cursor: not-allowed; }

.err-text { font-size: .85rem; color: #dc2626; }

/* Toast */
.toast {
  position: fixed; bottom: 32px; left: 50%; transform: translateX(-50%);
  background: #111827; color: #fff; padding: .65rem 1.4rem;
  border-radius: 999px; font-size: .875rem; font-weight: 600;
  z-index: 2000; pointer-events: none;
}
.toast-enter-active, .toast-leave-active { transition: opacity .25s, transform .25s; }
.toast-enter-from, .toast-leave-to { opacity: 0; transform: translateX(-50%) translateY(10px); }

/* Quiz modal */
.quiz-modal { width: 620px; }

.quiz-questions { display: flex; flex-direction: column; gap: 16px; }

.quiz-question-block {
  border: 1.5px solid #e5e7eb; border-radius: 10px; padding: 14px 16px;
  background: #fafafa;
}

.q-label { font-size: .82rem; font-weight: 700; color: #7B1A1A; }

.options-list { display: flex; flex-direction: column; gap: 7px; }

.option-row { display: flex; align-items: center; gap: 8px; }

.opt-radio-wrap { display: flex; align-items: center; flex-shrink: 0; cursor: pointer; }
.opt-radio-wrap input[type="radio"] { width: 16px; height: 16px; accent-color: #7c3aed; cursor: pointer; }

.opt-input { flex: 1; }

.add-option-btn {
  display: inline-flex; align-items: center; gap: 5px;
  background: none; border: 1.5px dashed #d1d5db; border-radius: 7px;
  padding: .3rem .7rem; font-size: .78rem; font-weight: 600;
  color: #6b7280; cursor: pointer; margin-top: 2px; transition: border-color .15s, color .15s;
}
.add-option-btn:hover { border-color: #7c3aed; color: #7c3aed; }

.add-question-btn {
  display: flex; align-items: center; gap: 6px;
  padding: .5rem 1rem; border: 1.5px dashed #d1d5db; border-radius: 9px;
  background: none; color: #6b7280; font-size: .85rem; font-weight: 600; cursor: pointer;
  transition: border-color .15s, color .15s;
}
.add-question-btn:hover { border-color: #7B1A1A; color: #7B1A1A; }
</style>
