<template>
  <RouterLink :to="`/courses/${course.id}`" class="course-card">

    <!-- Cover image / video thumbnail -->
    <div class="card-img">
      <img v-if="course.cover_image" :src="course.cover_image" :alt="course.title" class="card-img-el" />
      <video
        v-else-if="course.first_video_url"
        :src="course.first_video_url"
        class="card-img-el"
        muted
        preload="metadata"
        @loadedmetadata="e => { e.target.currentTime = 1 }"
      />
      <div v-else class="card-img-placeholder">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
          <path d="M15 10l4.553-2.277A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" stroke="#ccc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>

    <!-- Body -->
    <div class="card-body">

      <!-- Category + Price -->
      <div class="card-meta">
        <span class="subject-badge">{{ course.subject || t('common.general') }}</span>
        <div class="price-wrap" v-if="course.price > 0">
          <span v-if="course.original_price && course.original_price > course.price" class="price-old">
            ${{ Number(course.original_price).toFixed(2) }}
          </span>
          <span class="price-now">${{ Number(course.price).toFixed(2) }}</span>
        </div>
        <span class="price-now" v-else>{{ t('common.free') }}</span>
      </div>

      <!-- Title -->
      <h3 class="card-title">{{ course.title }}</h3>

      <!-- Author -->
      <div class="author-row">
        <div class="author-avatar"></div>
        <span class="author-name">{{ course.teacher_name || 'Bridge' }}</span>
        <span v-if="course.students_count > 0" class="author-reviews">
          ({{ course.students_count }} {{ t('admin.students') }})
        </span>
      </div>

    </div>

    <!-- Divider -->
    <div class="card-divider"></div>

    <!-- Stats -->
    <div class="card-stats">
      <span class="stat-item">
        <svg width="14" height="17" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.83088 13.8532H12.4077C13.1706 13.8532 13.8332 13.5722 14.3953 13.01C14.9575 12.4478 15.2386 11.7853 15.2386 11.0224V2.83088C15.2386 2.02779 14.9575 1.35521 14.3953 0.813124C13.8332 0.27104 13.1706 -1.90735e-06 12.4077 -1.90735e-06H2.83088C2.06795 -1.90735e-06 1.4054 0.27104 0.843241 0.813124C0.28108 1.35521 0 2.02779 0 2.83088V15.2386C0 16.0417 0.28108 16.7142 0.843241 17.2563C1.4054 17.7984 2.06795 18.0694 2.83088 18.0694H12.4077C13.1706 18.0694 13.8332 17.7984 14.3953 17.2563C14.9575 16.7142 15.2386 16.0417 15.2386 15.2386C15.2386 15.0378 15.1683 14.8671 15.0278 14.7266C14.8872 14.5861 14.7166 14.5158 14.5158 14.5158C14.315 14.5158 14.1544 14.5861 14.0339 14.7266C13.9135 14.8671 13.8532 15.0378 13.8532 15.2386C13.8532 15.6401 13.7127 15.9814 13.4316 16.2625C13.1505 16.5436 12.8092 16.6841 12.4077 16.6841H2.83088C2.46949 16.6841 2.14826 16.5436 1.86718 16.2625C1.5861 15.9814 1.44556 15.6401 1.44556 15.2386C1.44556 14.837 1.5861 14.5057 1.86718 14.2447C2.14826 13.9837 2.46949 13.8532 2.83088 13.8532ZM1.44556 2.83088C1.44556 2.42933 1.5861 2.08802 1.86718 1.80694C2.14826 1.52586 2.46949 1.38532 2.83088 1.38532H12.4077C12.8092 1.38532 13.1505 1.52586 13.4316 1.80694C13.7127 2.08802 13.8532 2.42933 13.8532 2.83088V11.0224C13.8532 11.4239 13.7127 11.7552 13.4316 12.0162C13.1505 12.2772 12.8092 12.4077 12.4077 12.4077H2.83088C2.34903 12.4077 1.88725 12.5482 1.44556 12.8293V2.83088ZM4.27644 4.75829C4.27644 4.55751 4.34671 4.38686 4.48725 4.24632C4.62779 4.10578 4.79844 4.03551 4.99921 4.03551H10.2996C10.5004 4.03551 10.671 4.10578 10.8116 4.24632C10.9521 4.38686 11.0224 4.55751 11.0224 4.75829C11.0224 4.95906 10.9521 5.12971 10.8116 5.27025C10.671 5.41079 10.5004 5.48106 10.2996 5.48106H4.99921C4.79844 5.48106 4.62779 5.41079 4.48725 5.27025C4.34671 5.12971 4.27644 4.95906 4.27644 4.75829Z" fill="#7F7E97"/>
        </svg>
        {{ course.lessons_count ?? 0 }}
      </span>
      <span class="stat-dot">•</span>
      <span class="stat-item">
        <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
          <circle cx="8" cy="8" r="6" stroke="#777" stroke-width="1.4"/>
          <path d="M8 5v3.2l2 1.5" stroke="#777" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        {{ formatDuration(course.total_duration_seconds) }}
      </span>
      <span class="stat-dot">•</span>
      <span class="stat-item">
        <svg width="16" height="13" viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.7444 2.95135C14.6162 2.06796 12.5081 1.16449 10.42 0.240936C9.97835 0.0803194 9.51657 1.04904e-05 9.03472 1.04904e-05C8.55287 1.04904e-05 8.0911 0.0803194 7.6494 0.240936L1.32509 2.95135C0.923549 3.15213 0.602315 3.42317 0.361389 3.76448C0.120463 4.10579 0 4.49729 0 4.93899C0 5.38069 0.120463 5.77219 0.361389 6.11351C0.602315 6.45482 0.923549 6.70578 1.32509 6.8664L2.83088 7.52895V11.9861C2.83088 12.5884 3.03165 13.0903 3.43319 13.4919C3.83474 13.8934 4.33667 14.0942 4.93898 14.0942H13.1305C13.7328 14.0942 14.2347 13.8934 14.6363 13.4919C15.0378 13.0903 15.2386 12.5884 15.2386 11.9861V10.1189C15.2386 9.91813 15.1683 9.74747 15.0278 9.60693C14.8872 9.46639 14.7266 9.39612 14.5459 9.39612C14.3652 9.39612 14.2046 9.46639 14.0641 9.60693C13.9235 9.74747 13.8532 9.91813 13.8532 10.1189V11.9861C13.8532 12.1868 13.783 12.3575 13.6424 12.498C13.5019 12.6386 13.3312 12.7089 13.1305 12.7089H4.93898C4.73821 12.7089 4.56755 12.6386 4.42701 12.498C4.28647 12.3575 4.2162 12.1868 4.2162 11.9861V8.13126L7.6494 9.57682C8.0911 9.77759 8.55287 9.87797 9.03472 9.87797C9.51657 9.87797 9.97835 9.77759 10.42 9.57682L16.7444 6.8664C17.1459 6.70578 17.4671 6.45482 17.7081 6.11351C17.949 5.77219 18.0694 5.38069 18.0694 4.93899C18.0694 4.49729 17.949 4.10579 17.7081 3.76448C17.4671 3.42317 17.1459 3.15213 16.7444 2.95135ZM16.2023 5.60154C14.0741 6.48493 11.9459 7.38841 9.81773 8.31195C9.57681 8.39226 9.3158 8.43242 9.03472 8.43242C8.75364 8.43242 8.49264 8.39226 8.25171 8.31195L1.86718 5.60154C1.70656 5.52123 1.5861 5.42084 1.50579 5.30038C1.42548 5.17992 1.38532 5.04942 1.38532 4.90888C1.38532 4.76834 1.42548 4.63783 1.50579 4.51737C1.5861 4.39691 1.70656 4.3166 1.86718 4.27645L8.25171 1.56603C8.49264 1.44557 8.75364 1.38533 9.03472 1.38533C9.3158 1.38533 9.57681 1.44557 9.81773 1.56603L16.2023 4.27645C16.3629 4.3166 16.4834 4.39691 16.5637 4.51737C16.644 4.63783 16.6841 4.76834 16.6841 4.90888C16.6841 5.04942 16.644 5.17992 16.5637 5.30038C16.4834 5.42084 16.3629 5.52123 16.2023 5.60154ZM17.3467 8.19149C17.1459 8.19149 16.9853 8.26176 16.8648 8.4023C16.7444 8.54284 16.6841 8.7135 16.6841 8.91427V11.9861C16.6841 12.1868 16.7444 12.3575 16.8648 12.498C16.9853 12.6386 17.1459 12.7089 17.3467 12.7089C17.5474 12.7089 17.7181 12.6386 17.8586 12.498C17.9992 12.3575 18.0694 12.1868 18.0694 11.9861V8.91427C18.0694 8.7135 17.9992 8.54284 17.8586 8.4023C17.7181 8.26176 17.5474 8.19149 17.3467 8.19149Z" fill="#7F7E97"/>
        </svg>
        {{ course.students_count ?? 0 }}
      </span>
    </div>

    <!-- Progress bar (My Learning view) -->
    <div v-if="progress !== undefined" class="card-progress">
      <div class="progress-info">
        <span>{{ t('courseCard.progress') }}</span>
        <span>{{ progress }}%</span>
      </div>
      <ProgressBar :value="progress" class="slim-bar" />
    </div>

  </RouterLink>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import ProgressBar from 'primevue/progressbar'

const { t } = useI18n()

defineProps({
  course:   { type: Object, required: true },
  progress: { type: Number, default: undefined },
})

function formatDuration(seconds) {
  const s = Number(seconds) || 0
  const h = Math.floor(s / 3600)
  const m = Math.floor((s % 3600) / 60)
  if (!h && !m) return '—'
  if (!h) return `${m}m`
  return m ? `${h}h ${m}m` : `${h}h`
}
</script>

<style scoped>
.course-card {
  display: flex;
  flex-direction: column;
  background: #fff;
  border: 1px solid #e0e0e0;
  border-radius: 18px;
  overflow: hidden;
  text-decoration: none;
  color: inherit;
  transition: box-shadow .2s, transform .2s;
}
.course-card:hover {
  box-shadow: 0 8px 28px rgba(0,0,0,.1);
  transform: translateY(-3px);
}

/* ── Cover image ───────────────────────────────── */
.card-img {
  height: 195px;
  border-radius: 12px;
  margin: 10px 10px 0;
  flex-shrink: 0;
  overflow: hidden;
  position: relative;
  background: #f0f0f0;
}
.card-img-el {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  pointer-events: none;
}
.card-img-placeholder {
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #e8e8e8 0%, #d4d4d4 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}

/* ── Body ──────────────────────────────────────── */
.card-body {
  padding: 0.9rem 1rem 0.75rem;
}

.card-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 0.55rem;
}
.subject-badge {
  background: #f0f0f0;
  border-radius: 20px;
  padding: 0.22rem 0.7rem;
  font-size: 0.73rem;
  font-weight: 500;
  color: #555;
}
.price-wrap {
  display: flex;
  align-items: center;
  gap: 0.35rem;
}
.price-old {
  font-size: 0.78rem;
  color: #aaa;
  text-decoration: line-through;
}
.price-now {
  font-size: 0.9rem;
  font-weight: 700;
  color: #e53030;
}

.card-title {
  font-size: 0.95rem;
  font-weight: 700;
  line-height: 1.35;
  color: #111;
  margin: 0 0 0.65rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* ── Author ────────────────────────────────────── */
.author-row {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}
.author-avatar {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #d5d5d5;
  flex-shrink: 0;
}
.author-name {
  font-size: 0.82rem;
  font-weight: 500;
  color: #333;
}
.author-reviews {
  font-size: 0.78rem;
  color: #999;
}

/* ── Divider ───────────────────────────────────── */
.card-divider {
  height: 1px;
  background: #ececec;
  margin: 0;
}

/* ── Stats ─────────────────────────────────────── */
.card-stats {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.65rem 1rem;
}
.stat-item {
  display: flex;
  align-items: center;
  gap: 0.3rem;
  font-size: 0.8rem;
  color: #555;
}
.stat-dot {
  color: #bbb;
  font-size: 0.75rem;
}

/* ── Progress ──────────────────────────────────── */
.card-progress {
  padding: 0.6rem 1rem 0.8rem;
  border-top: 1px solid #ececec;
}
.progress-info {
  display: flex;
  justify-content: space-between;
  font-size: 0.76rem;
  color: #888;
  margin-bottom: 0.3rem;
}
:deep(.slim-bar) .p-progressbar-value {
  transition: width 0.6s ease;
}
</style>
