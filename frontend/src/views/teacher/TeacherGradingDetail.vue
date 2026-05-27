<template>
  <TeacherLayout>

    <!-- Breadcrumb in header -->
    <template #header-left>
      <button class="breadcrumb" @click="router.push('/teacher/grading')">
        <i class="pi pi-arrow-left" style="font-size:.8rem;"></i>
        Grading / Submission #{{ id }}
      </button>
    </template>

    <!-- ── Loading ─────────────────────────────────────────────── -->
    <div v-if="loading" class="flex flex-col gap-5">
      <div class="animate-pulse bg-white rounded-xl" style="height:80px;border:1px solid #e5e7eb;"></div>
      <div class="flex gap-5">
        <div class="flex-1 flex flex-col gap-4">
          <div class="animate-pulse bg-white rounded-xl" style="height:160px;border:1px solid #e5e7eb;"></div>
          <div class="animate-pulse bg-white rounded-xl" style="height:380px;border:1px solid #e5e7eb;"></div>
        </div>
        <div style="width:280px;" class="flex flex-col gap-4">
          <div class="animate-pulse bg-white rounded-xl" style="height:480px;border:1px solid #e5e7eb;"></div>
          <div class="animate-pulse bg-white rounded-xl" style="height:120px;border:1px solid #e5e7eb;"></div>
        </div>
      </div>
    </div>

    <!-- ── Content ─────────────────────────────────────────────── -->
    <div v-else>

      <!-- Status + student name + action buttons -->
      <div class="flex items-start justify-between gap-6 mb-6">
        <div>
          <div class="flex items-center gap-3 mb-2">
            <span class="status-badge" :class="`status-badge--${sub.status}`">
              {{ statusLabel[sub.status] ?? 'Pending' }}
            </span>
            <span class="text-sm" style="color:#6b7280;">
              • Submitted {{ formatAgo(sub.hours_ago) }}
            </span>
          </div>
          <h1 class="student-name">{{ sub.student_name }}</h1>
          <p class="student-course">{{ sub.course_title }}: {{ sub.homework_title }}</p>
        </div>
        <div class="flex gap-3 flex-shrink-0 pt-1">
          <button class="btn-revision" @click="requestRevision" :disabled="!!saving">
            {{ saving === 'revision' ? 'Saving…' : 'Request Revision' }}
          </button>
          <button class="btn-approve" @click="approve" :disabled="!!saving">
            {{ saving === 'approve' ? 'Saving…' : 'Approve' }}
          </button>
        </div>
      </div>

      <!-- Two-column layout -->
      <div class="flex gap-5 items-start">

        <!-- ── Left: prompt + submission ────────────────────── -->
        <div class="flex flex-col gap-4 flex-1 min-w-0">

          <template v-if="answers.length">
            <template v-for="(a, i) in answers" :key="a.id">

              <!-- Prompt card -->
              <div class="card">
                <div class="card-label">PROMPT</div>
                <p class="font-bold" style="font-size:1rem;color:#111827;line-height:1.6;margin:0;">
                  {{ a.question_text }}
                </p>
              </div>

              <!-- Student submission card -->
              <div class="card">
                <div class="flex items-center justify-between mb-4">
                  <div class="card-label" style="margin:0;">STUDENT SUBMISSION</div>
                  <div class="flex items-center gap-1 text-xs" style="color:#9ca3af;">
                    <i class="pi pi-file" style="font-size:.8rem;"></i>
                    {{ wordCount(a).toLocaleString() }} words
                  </div>
                </div>
                <div class="submission-body">
                  {{ a.answer_text || a.selected_option || '—' }}
                </div>
                <div v-if="a.is_correct !== null" class="mt-4 pt-3" style="border-top:1px solid #f3f4f6;">
                  <span v-if="a.is_correct" class="correct-tag">✓ Correct answer</span>
                  <span v-else class="wrong-tag">✗ Incorrect answer</span>
                </div>
              </div>

              <!-- Divider between multiple questions -->
              <hr v-if="i < answers.length - 1" style="border:none;border-top:1px solid #f3f4f6;">

            </template>
          </template>

          <div v-else class="card text-sm" style="color:#9ca3af;">
            No answers on record for this submission.
          </div>

        </div>

        <!-- ── Right: score + resources ──────────────────────── -->
        <div class="flex flex-col gap-4" style="width:280px;flex-shrink:0;position:sticky;top:24px;">

          <!-- Score + feedback + rubric panel -->
          <div class="card">

            <!-- Assigned score -->
            <div class="text-xs font-semibold mb-3" style="color:#6b7280;letter-spacing:.05em;">
              Assigned Score
            </div>
            <div class="flex items-center gap-3 mb-1">
              <input
                type="number" v-model.number="score"
                min="0" :max="maxScore" step="1"
                class="score-input"
              />
              <span class="font-semibold" style="color:#6b7280;font-size:1.1rem;">/ {{ maxScore }}</span>
            </div>
            <p class="text-xs mb-5" style="color:#9ca3af;font-style:italic;">
              Recommended grade: {{ recommendedScore }} ({{ gradeLabel }})
            </p>

            <!-- Feedback -->
            <div class="text-xs font-semibold mb-2" style="color:#374151;">
              Feedback &amp; Recommendations
            </div>
            <textarea
              v-model="feedback"
              rows="5"
              placeholder="Add your feedback here..."
              class="feedback-area"
              @input="scheduleAutosave"
            ></textarea>

            <!-- Rubric checklist -->
            <div class="mt-4 pt-4" style="border-top:1px solid #f3f4f6;">
              <div class="rubric-title">RUBRIC CHECKLIST</div>
              <div v-for="item in rubric" :key="item.label" class="flex items-center gap-2 mb-2">
                <input
                  type="checkbox" v-model="item.checked"
                  class="rubric-check"
                  :id="`rb-${item.label}`"
                  @change="scheduleAutosave"
                />
                <label :for="`rb-${item.label}`" class="text-sm cursor-pointer"
                       :style="{ color: item.checked ? '#111827' : '#6b7280', fontWeight: item.checked ? '500' : '400' }">
                  {{ item.label }}
                </label>
              </div>
            </div>

            <!-- Last saved -->
            <div class="flex items-center gap-1 mt-4 mb-4 text-xs" style="color:#9ca3af;">
              <i class="pi pi-clock" style="font-size:.78rem;"></i>
              {{ lastSavedText }}
            </div>

            <!-- Submit -->
            <button class="submit-btn" @click="approve" :disabled="!!saving">
              {{ saving === 'approve' ? 'Submitting…' : 'Submit Final Grade' }}
            </button>

            <p v-if="successMsg" class="text-xs text-center mt-2" style="color:#15803d;">{{ successMsg }}</p>
            <p v-if="errorMsg"   class="text-xs text-center mt-2" style="color:#dc2626;">{{ errorMsg }}</p>
          </div>

          <!-- Grading resources -->
          <div class="card">
            <div class="text-sm font-semibold mb-3" style="color:#111827;">Grading Resources</div>
            <div class="flex flex-col gap-3">
              <button class="resource-link" @click="() => {}">
                <span>Course Syllabus (PDF)</span>
                <i class="pi pi-external-link" style="font-size:.78rem;"></i>
              </button>
              <button class="resource-link" @click="() => {}">
                <span>AI Plagiarism Report (0.2%)</span>
                <i class="pi pi-verified" style="font-size:.78rem;"></i>
              </button>
              <button class="resource-link" @click="router.push('/teacher/grading')">
                <span>Previous Submission History</span>
                <i class="pi pi-history" style="font-size:.78rem;"></i>
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>

  </TeacherLayout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n'
import TeacherLayout from '@/components/teacher/TeacherLayout.vue'
import { teacherApi } from '@/api'

const { t } = useI18n()
const router = useRouter()
const route  = useRoute()
const id     = Number(route.params.id)

const loading    = ref(true)
const sub        = ref({})
const answers    = ref([])
const statusLabel = computed(() => ({
  submitted:          t('teacher.statusPending'),
  graded:             t('teacher.statusGraded'),
  revision_requested: t('teacher.statusRevisionRequested'),
}))
const feedback   = ref('')
const score      = ref(75)
const saving     = ref('')
const successMsg = ref('')
const errorMsg   = ref('')

const maxScore = computed(() => sub.value.max_score || 100)

// ── Rubric checklist ─────────────────────────────────────────
const rubric = ref([
  { label: '3+ Case Studies included',       checked: false },
  { label: 'Macroeconomic framework',         checked: false },
  { label: 'Advanced citations (APA 7th)',    checked: false },
])

// ── Auto-save ────────────────────────────────────────────────
const lastSavedAt  = ref(null)
const lastSavedText = computed(() => {
  if (!lastSavedAt.value) return t('teacher.notYetSaved')
  const diff = Math.floor((Date.now() - lastSavedAt.value) / 60000)
  if (diff < 1) return t('teacher.lastSavedJustNow')
  return `Last saved ${diff} minute${diff !== 1 ? 's' : ''} ago`
})

let autosaveTimer  = null
let clockTimer     = null
const clockTick    = ref(0)  // forces recompute every minute

function scheduleAutosave() {
  clearTimeout(autosaveTimer)
  autosaveTimer = setTimeout(saveDraft, 2000)
}

function saveDraft() {
  localStorage.setItem(`draft_grade_${id}`, JSON.stringify({
    score:    score.value,
    feedback: feedback.value,
    rubric:   rubric.value.map(r => r.checked),
  }))
  lastSavedAt.value = Date.now()
  clockTick.value   // accessed so computed re-runs
}

// ── Helpers ──────────────────────────────────────────────────
function formatAgo(hours) {
  if (!hours && hours !== 0) return 'recently'
  if (hours < 1)  return 'just now'
  if (hours < 24) return `${Math.round(hours)} hour${Math.round(hours) !== 1 ? 's' : ''} ago`
  const d = Math.floor(hours / 24)
  return d === 1 ? '1 day ago' : `${d} days ago`
}

function wordCount(a) {
  return ((a.answer_text || a.selected_option || '')).split(/\s+/).filter(Boolean).length
}

// ── Grade label (based on % of max_score) ───────────────────
const scorePct = computed(() => maxScore.value > 0 ? (score.value / maxScore.value) * 100 : 0)

const gradeLabel = computed(() => {
  const p = scorePct.value
  if (p >= 90) return 'Distinction'
  if (p >= 75) return 'High Merit'
  if (p >= 60) return 'Merit'
  if (p >= 50) return 'Pass'
  return 'Fail'
})

const recommendedScore = computed(() => {
  const correct = answers.value.filter(a => a.is_correct === true).length
  const total   = answers.value.filter(a => a.is_correct !== null).length
  const pct = total > 0 ? correct / total : 0.9
  return +(pct * maxScore.value).toFixed(1)
})

// ── Actions ──────────────────────────────────────────────────
async function approve() {
  saving.value     = 'approve'
  successMsg.value = ''
  errorMsg.value   = ''
  try {
    await teacherApi.grade(id, score.value, feedback.value, 'graded')
    localStorage.removeItem(`draft_grade_${id}`)
    successMsg.value = 'Grade submitted!'
    setTimeout(() => router.push('/teacher/grading'), 1300)
  } catch (e) {
    errorMsg.value = e.response?.data?.message || 'Failed to submit grade'
  } finally {
    saving.value = ''
  }
}

async function requestRevision() {
  saving.value     = 'revision'
  successMsg.value = ''
  errorMsg.value   = ''
  try {
    await teacherApi.grade(id, score.value, feedback.value, 'revision_requested')
    localStorage.removeItem(`draft_grade_${id}`)
    successMsg.value = 'Revision requested!'
    setTimeout(() => router.push('/teacher/grading'), 1300)
  } catch (e) {
    errorMsg.value = e.response?.data?.message || 'Failed to request revision'
  } finally {
    saving.value = ''
  }
}

// ── Load ─────────────────────────────────────────────────────
onMounted(async () => {
  try {
    const res  = await teacherApi.submissionDetail(id)
    const data = res.data.data
    sub.value     = data
    answers.value = data.answers || []

    // Seed rubric labels from context if possible
    const titles = [
      '3+ Case Studies included',
      'Macroeconomic framework',
      'Advanced citations (APA 7th)',
    ]
    rubric.value = titles.map(label => ({ label, checked: false }))

    // Restore draft or existing score/feedback
    const defaultScore = Math.round((data.max_score || 100) * 0.75)
    const draft = localStorage.getItem(`draft_grade_${id}`)
    if (draft) {
      const p = JSON.parse(draft)
      score.value    = p.score    ?? defaultScore
      feedback.value = p.feedback ?? ''
      if (p.rubric) rubric.value.forEach((r, i) => { r.checked = p.rubric[i] ?? false })
      lastSavedAt.value = Date.now()
    } else {
      score.value    = data.score    != null ? data.score    : defaultScore
      feedback.value = data.feedback != null ? data.feedback : ''
    }
  } catch {
    errorMsg.value = 'Failed to load submission.'
  } finally {
    loading.value = false
  }

  // Update "last saved X minutes ago" text every 30 s
  clockTimer = setInterval(() => { clockTick.value++ }, 30000)
})

onUnmounted(() => {
  clearTimeout(autosaveTimer)
  clearInterval(clockTimer)
})
</script>

<style scoped>
/* Breadcrumb */
.breadcrumb {
  display: flex; align-items: center; gap: 8px;
  font-size: .875rem; font-weight: 600; color: #374151;
  background: none; border: none; cursor: pointer; padding: 0;
  transition: color .15s;
}
.breadcrumb:hover { color: #7B1A1A; }

/* Status badge */
.status-badge {
  display: inline-flex; align-items: center;
  padding: .25rem .75rem; border-radius: 9999px;
  border: 1.5px solid #f9a8d4;
  background: #fdf2f8; color: #9d174d;
  font-size: .78rem; font-weight: 600;
}
.status-badge--graded             { border-color: #86efac; background: #f0fdf4; color: #15803d; }
.status-badge--revision_requested { border-color: #fde68a; background: #fefce8; color: #92400e; }

/* Student name */
.student-name { font-size: 2rem; font-weight: 800; color: #111827; margin: 0 0 4px; line-height: 1.15; }
.student-course { font-size: .9rem; color: #6b7280; margin: 0; }

/* Action buttons */
.btn-revision {
  padding: .55rem 1.25rem;
  border: 1.5px solid #7B1A1A; border-radius: 8px;
  background: #fff; color: #7B1A1A;
  font-size: .875rem; font-weight: 700; cursor: pointer;
  transition: background .15s;
}
.btn-revision:hover:not(:disabled) { background: #fef2f2; }
.btn-revision:disabled { opacity: .5; cursor: not-allowed; }

.btn-approve {
  padding: .55rem 1.25rem;
  border: none; border-radius: 8px;
  background: #7B1A1A; color: #fff;
  font-size: .875rem; font-weight: 700; cursor: pointer;
  transition: background .15s;
}
.btn-approve:hover:not(:disabled) { background: #6a1616; }
.btn-approve:disabled { opacity: .5; cursor: not-allowed; }

/* Cards */
.card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; }
.card-label {
  font-size: .72rem; font-weight: 700; color: #7B1A1A;
  letter-spacing: .1em; text-transform: uppercase; margin-bottom: 14px;
}

/* Submission body */
.submission-body {
  font-size: .9rem; color: #374151; line-height: 1.8;
  white-space: pre-wrap; word-break: break-word;
}
.correct-tag { font-size: .78rem; font-weight: 700; color: #15803d; background: #f0fdf4; padding: .2rem .6rem; border-radius: 4px; }
.wrong-tag   { font-size: .78rem; font-weight: 700; color: #dc2626;  background: #fef2f2; padding: .2rem .6rem; border-radius: 4px; }

/* Score input */
.score-input {
  width: 72px; height: 56px;
  border: 2px solid #e5e7eb; border-radius: 8px;
  font-size: 1.75rem; font-weight: 800; color: #111827;
  text-align: center; outline: none;
  transition: border-color .15s;
  -moz-appearance: textfield;
}
.score-input::-webkit-outer-spin-button,
.score-input::-webkit-inner-spin-button { -webkit-appearance: none; }
.score-input:focus { border-color: #7B1A1A; }

/* Feedback textarea */
.feedback-area {
  width: 100%; box-sizing: border-box;
  border: 1px solid #e5e7eb; border-radius: 8px;
  padding: 10px 12px; font-size: .85rem; font-family: inherit;
  color: #374151; resize: none; outline: none;
  transition: border-color .15s;
}
.feedback-area:focus { border-color: #7B1A1A; }

/* Rubric */
.rubric-title { font-size: .68rem; font-weight: 700; color: #7B1A1A; letter-spacing: .1em; text-transform: uppercase; margin-bottom: 10px; }
.rubric-check { width: 15px; height: 15px; accent-color: #7B1A1A; cursor: pointer; flex-shrink: 0; }

/* Submit button */
.submit-btn {
  width: 100%; padding: .7rem;
  background: #7B1A1A; border: none; border-radius: 8px;
  font-size: .9rem; font-weight: 700; color: #fff;
  cursor: pointer; transition: background .15s;
}
.submit-btn:hover:not(:disabled) { background: #6a1616; }
.submit-btn:disabled { opacity: .5; cursor: not-allowed; }

/* Resource links */
.resource-link {
  display: flex; align-items: center; justify-content: space-between;
  width: 100%; padding: 0; border: none; background: none;
  font-size: .875rem; font-weight: 500; color: #7B1A1A;
  cursor: pointer; text-align: left;
  transition: opacity .15s;
}
.resource-link:hover { opacity: .75; }
</style>
