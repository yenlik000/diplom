<template>
  <div class="course-card" @click="$router.push(`/courses/${course.id}`)">
    <div class="card-cover" :style="coverStyle">
      <Tag :value="course.level" class="level-tag" v-if="course.level" />
    </div>
    <div class="card-body">
      <div class="card-subject" v-if="course.subject">{{ course.subject }}</div>
      <h3 class="card-title">{{ course.title }}</h3>
      <p class="card-desc" v-if="course.description">{{ truncate(course.description, 100) }}</p>

      <div class="card-footer">
        <span class="card-price">
          {{ course.price > 0 ? `${course.price} ₸` : t('common.free') }}
        </span>
        <Button :label="t('courseCard.details')" size="small" />
      </div>
    </div>

    <div v-if="progress !== undefined" class="card-progress">
      <div class="progress-info">
        <span>{{ t('courseCard.progress') }}</span>
        <span>{{ progress }}%</span>
      </div>
      <ProgressBar :value="progress" class="slim-bar" />
    </div>
  </div>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import Button from 'primevue/button'
import Tag from 'primevue/tag'
import ProgressBar from 'primevue/progressbar'

const { t } = useI18n()

const props = defineProps({
  course:   { type: Object,  required: true },
  progress: { type: Number,  default: undefined },
})

const coverStyle = {
  background: 'linear-gradient(135deg, var(--brand-burgundy) 0%, var(--brand-blue) 100%)',
}

function truncate(str, len) {
  return str.length > len ? str.slice(0, len) + '…' : str
}
</script>

<style scoped>
.course-card {
  background: #fff;
  border: 1px solid var(--border-color);
  border-radius: var(--radius);
  overflow: hidden;
  cursor: pointer;
  transition: box-shadow .2s, transform .2s;
}

.course-card:hover {
  box-shadow: 0 4px 20px rgba(0,0,0,.1);
  transform: translateY(-2px);
}

.card-cover {
  height: 140px;
  position: relative;
  display: flex;
  align-items: flex-end;
  padding: 0.75rem;
}

.level-tag { font-size: 0.75rem; }

.card-body { padding: 1rem 1.25rem; }

.card-subject {
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .05em;
  color: var(--brand-burgundy);
  margin-bottom: 0.25rem;
}

.card-title {
  font-size: 1rem;
  font-weight: 700;
  margin: 0 0 0.5rem;
  line-height: 1.3;
}

.card-desc {
  font-size: 0.85rem;
  color: var(--text-muted);
  margin: 0 0 1rem;
  line-height: 1.5;
}

.card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.card-price {
  font-weight: 700;
  font-size: 1rem;
  color: var(--brand-burgundy);
}

.card-progress {
  padding: 0.75rem 1.25rem;
  border-top: 1px solid var(--border-color);
  background: var(--surface-50);
}

.progress-info {
  display: flex;
  justify-content: space-between;
  font-size: 0.8rem;
  color: var(--text-muted);
  margin-bottom: 0.4rem;
}

:deep(.slim-bar) .p-progressbar-value {
  transition: width 0.6s ease;
}
</style>
