<template>
  <div class="page">

    <!-- ── Header ───────────────────────────────────────────── -->
    <header class="header">
      <div v-if="showBar" class="announce-bar">
        <span>🌟 {{ t('landing.announcement') }}</span>
        <button class="bar-close" @click="showBar = false">✕</button>
      </div>
      <div class="header-inner">
        <RouterLink to="/" class="logo">
          <img src="@/assets/logo.png" alt="Bridge" class="logo-img" />
        </RouterLink>
        <nav class="nav">
          <RouterLink to="/" class="nav-link">{{ t('header.home') }}</RouterLink>
          <RouterLink to="/courses" class="nav-link">{{ t('header.courses') }}</RouterLink>
          <RouterLink to="/about" class="nav-link">{{ t('header.about') }}</RouterLink>
          <RouterLink v-if="auth.isLoggedIn" :to="auth.dashboardRoute()" class="nav-link">{{ t('header.myLearning') }}</RouterLink>
          <RouterLink to="/founder" class="nav-link">{{ t('about.navFounder') }}</RouterLink>
          <div class="lang-switcher" @click.stop="langOpen = !langOpen" v-click-outside="() => langOpen = false">
            <span class="lang-current">
              {{ langs.find(l => l.code === locale)?.label ?? 'EN' }}
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                :style="{ transform: langOpen ? 'rotate(180deg)' : '', transition: 'transform .2s' }">
                <path d="M6 9l6 6 6-6"/>
              </svg>
            </span>
            <div v-if="langOpen" class="lang-dropdown">
              <button v-for="lang in langs" :key="lang.code"
                class="lang-option" :class="{ active: locale === lang.code }"
                @click.stop="switchLang(lang.code); langOpen = false">{{ lang.label }}</button>
            </div>
          </div>
        </nav>
        <div class="header-actions">
          <template v-if="auth.isLoggedIn">
            <RouterLink :to="auth.dashboardRoute()"><button class="btn-outline">{{ t('header.cabinet') }}</button></RouterLink>
            <button class="btn-solid" @click="handleLogout">{{ t('header.logout') }}</button>
          </template>
          <template v-else>
            <RouterLink to="/login"><button class="btn-outline">{{ t('header.signUp') }}</button></RouterLink>
            <RouterLink to="/login"><button class="btn-solid">{{ t('header.login') }}</button></RouterLink>
          </template>
        </div>
      </div>
    </header>

    <!-- ── Main Content ──────────────────────────────────────── -->
    <div class="container">

      <!-- Back link -->
      <RouterLink to="/courses" class="back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        {{ t('header.courses') }}
      </RouterLink>

      <!-- Page title -->
      <h1 class="page-title">Create an LMS Website with Bridge</h1>

      <div class="page-author">
        by <strong>Bridge Team</strong> in
        <span class="cat-link">Education</span>,
        <span class="cat-link">Technology</span>
      </div>

      <div class="page-meta">
        <span class="stars">★★★★★</span>
        <span class="rating-num">4.8</span>
        <span class="rating-count">(280)</span>
        <span class="meta-sep">|</span>
        <span class="last-updated">Last updated: Sep 12, 2024</span>
      </div>

      <div class="divider" />

      <!-- Overview -->
      <section class="content-section">
        <h2 class="section-heading">Overview</h2>
        <p class="section-text">
          Bridge is a modern educational platform designed to help students prepare for IELTS, SAT, NUET
          and school subjects from grade 2. Our platform provides high-quality video lessons, interactive
          exercises and personalized learning paths to help you achieve your academic goals faster and more
          effectively. This guide gives you a complete overview of everything Bridge offers.
        </p>
      </section>

      <!-- Feature -->
      <section class="content-section">
        <h2 class="section-heading">Feature</h2>
        <ul class="content-list">
          <li>High-quality video lessons with detailed step-by-step explanations from experienced educators.</li>
          <li>Interactive exercises and practice tests aligned with real IELTS, SAT and NUET exam formats.</li>
          <li>Personalized progress tracking so you always know where you stand and what to focus on next.</li>
          <li>Flexible schedule — study at your own pace, anytime and from any device, wherever you are.</li>
        </ul>
      </section>

      <!-- Target Audiences -->
      <section class="content-section">
        <h2 class="section-heading">Target Audiences</h2>
        <ul class="content-list">
          <li>Students preparing for IELTS, SAT or NUET who want structured, exam-focused preparation.</li>
          <li>Schoolchildren from grade 2 who need clear, engaging Math and English lessons to improve grades.</li>
          <li>Adults and working professionals looking to upgrade their English proficiency at a flexible pace.</li>
        </ul>
      </section>

      <!-- Requirement -->
      <section class="content-section">
        <h2 class="section-heading">Requirement</h2>
        <ul class="content-list">
          <li>A stable internet connection and a modern browser (Chrome, Firefox, Safari).</li>
          <li>Basic computer or smartphone skills to navigate the platform and access lessons.</li>
          <li>A genuine desire to learn and the commitment to complete lessons and practice exercises.</li>
        </ul>
      </section>

      <!-- Programs / Curriculum -->
      <section class="content-section">
        <h2 class="section-heading">Our Programs</h2>
        <div class="curriculum-stats">
          <span>4 programs</span>
          <span class="dot">·</span>
          <span>1 available now</span>
          <span class="dot">·</span>
          <span>3 coming soon</span>
          <button class="expand-btn" @click="toggleAll">
            {{ allOpen ? 'Collapse All' : 'Expand All' }}
          </button>
        </div>

        <div class="curriculum-list">
          <div v-for="prog in programs" :key="prog.id" class="module-block">
            <button class="module-header"
              :class="{ 'module-header--disabled': !prog.available }"
              @click="prog.available && toggleProgram(prog.id)">
              <span class="module-title-text">{{ prog.title }}</span>
              <span v-if="!prog.available" class="coming-soon-badge">Coming Soon</span>
              <svg v-else class="chevron" :class="{ open: openIds.includes(prog.id) }"
                width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </button>
            <div v-if="prog.available && openIds.includes(prog.id)" class="module-body">
              <div v-for="item in prog.items" :key="item" class="lesson-row">
                <span class="lesson-icon-wrap">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <polygon points="5,3 19,12 5,21" fill="#e53030"/>
                  </svg>
                </span>
                <span class="lesson-name">{{ item }}</span>
                <span class="lesson-duration">30 minutes</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Instructors -->
      <section class="content-section">
        <h2 class="section-heading">Instructor</h2>
        <div class="instructors-grid">
          <div v-for="mentor in mentors" :key="mentor.name" class="instructor-card">
            <div class="instructor-avatar" :style="{ background: mentor.bg }">
              <img :src="mentor.img" :alt="mentor.name" />
            </div>
            <div class="instructor-info">
              <div class="instructor-name">{{ mentor.name }}</div>
              <div class="instructor-role">{{ mentor.role }}</div>
              <div class="instructor-socials">
                <a href="#" class="social-btn">f</a>
                <a href="#" class="social-btn">t</a>
                <a href="#" class="social-btn">in</a>
              </div>
              <p class="instructor-bio">Experienced educator with a passion for making complex topics simple and accessible to every student.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Reviews -->
      <section class="content-section">
        <h2 class="section-heading">Reviews</h2>
        <div class="reviews-top">
          <div class="overall-col">
            <div class="big-score">{{ avgRating }}</div>
            <div class="big-stars">{{ starString(avgRating) }}</div>
            <div class="score-label">{{ reviews.length }} ratings</div>
          </div>
          <div class="bars-col">
            <div v-for="n in [5, 4, 3, 2, 1]" :key="n" class="bar-row">
              <span class="bar-label">{{ n }} ★</span>
              <div class="bar-track">
                <div class="bar-fill" :style="{ width: barWidth(n) }"></div>
              </div>
              <span class="bar-count">{{ ratingCount(n) }}</span>
            </div>
          </div>
          <button class="btn-write-review" @click="openReviewModal">Write a Review</button>
        </div>

        <div class="review-list">
          <div v-for="review in visibleReviews" :key="review.id" class="review-card">
            <div class="review-avatar"></div>
            <div class="review-body">
              <div class="review-top-row">
                <span class="review-author">{{ review.author }}</span>
                <span class="review-stars">{{ '★'.repeat(review.rating) }}{{ '☆'.repeat(5 - review.rating) }}</span>
              </div>
              <div class="review-title">{{ review.title }}</div>
              <p class="review-text">{{ review.text }}</p>
              <div class="review-votes">
                <button class="vote-btn" :class="{ 'vote-btn--active': review.userVote === 'up' }" @click="vote(review, 'up')">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"/>
                    <path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>
                  </svg>
                  <span v-if="review.likes">{{ review.likes }}</span>
                </button>
                <button class="vote-btn" :class="{ 'vote-btn--active-down': review.userVote === 'down' }" @click="vote(review, 'down')">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3H10z"/>
                    <path d="M17 2h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"/>
                  </svg>
                  <span v-if="review.dislikes">{{ review.dislikes }}</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div v-if="reviews.length > visibleCount" class="load-more-wrap">
          <button class="btn-load-more" @click="visibleCount += 3">Load More</button>
        </div>
      </section>

      <!-- Write a Review Modal -->
      <Teleport to="body">
        <div v-if="reviewModal" class="modal-overlay" @click.self="reviewModal = false">
          <div class="modal-box">
            <div class="modal-header">
              <h3 class="modal-title">Write a Review</h3>
              <button class="modal-close" @click="reviewModal = false">✕</button>
            </div>

            <div class="modal-body">
              <!-- Star picker -->
              <div class="field">
                <label class="field-label">Rating *</label>
                <div class="star-picker">
                  <button v-for="n in 5" :key="n" class="star-pick"
                    :class="{ active: n <= newReview.rating }"
                    @click="newReview.rating = n"
                    @mouseover="hoverRating = n"
                    @mouseleave="hoverRating = 0">
                    {{ n <= (hoverRating || newReview.rating) ? '★' : '☆' }}
                  </button>
                </div>
              </div>

              <div class="field">
                <label class="field-label">Your name *</label>
                <input v-model="newReview.author" class="field-input" placeholder="Enter your name" maxlength="60" />
              </div>

              <div class="field">
                <label class="field-label">Title *</label>
                <input v-model="newReview.title" class="field-input" placeholder="Summarize your experience" maxlength="100" />
              </div>

              <div class="field">
                <label class="field-label">Review *</label>
                <textarea v-model="newReview.text" class="field-textarea" placeholder="Share details of your experience" rows="4" maxlength="1000"></textarea>
              </div>

              <p v-if="reviewError" class="review-error">{{ reviewError }}</p>
            </div>

            <div class="modal-footer">
              <button class="btn-cancel" @click="reviewModal = false">Cancel</button>
              <button class="btn-submit-review" @click="submitReview">Post Review</button>
            </div>
          </div>
        </div>
      </Teleport>

      <!-- Leave a comment -->
      <section class="content-section comment-section">
        <h2 class="section-heading">Leave a comment</h2>
        <p class="comment-prompt">
          <template v-if="auth.isLoggedIn">
            Logged in as {{ auth.user?.full_name || auth.user?.name }}.
            <RouterLink to="/dashboard" class="text-link">Edit your profile</RouterLink>.
            <a href="#" class="text-link" @click.prevent="handleLogout">Log out?</a>
            Required fields are marked *
          </template>
          <template v-else>
            <RouterLink to="/login" class="text-link">Log in</RouterLink> to post a comment.
          </template>
        </p>
        <textarea v-model="commentText" class="comment-area"
          placeholder="Enter your comment" rows="5"
          :disabled="!auth.isLoggedIn"></textarea>
        <p v-if="commentError" class="comment-error">{{ commentError }}</p>
        <button class="btn-post-comment"
          :disabled="!auth.isLoggedIn || !commentText.trim()"
          @click="submitComment">
          Post A Comment
        </button>

        <div v-if="comments.length" class="comments-list">
          <div v-for="c in comments" :key="c.id" class="comment-item">
            <div class="comment-meta">
              <span class="comment-author">{{ c.author }}</span>
              <span class="comment-date">{{ new Date(c.created_at).toLocaleDateString() }}</span>
            </div>
            <p class="comment-body">{{ c.body }}</p>
          </div>
        </div>
      </section>

    </div>

    <!-- ── Footer ───────────────────────────────────────────── -->
    <footer class="footer">
      <div class="footer-top">
        <RouterLink to="/" class="footer-logo">
          <img src="@/assets/logo.png" alt="Bridge" class="footer-logo-img" />
        </RouterLink>
        <nav class="footer-nav">
          <RouterLink to="/">{{ t('header.home') }}</RouterLink>
          <RouterLink to="/courses">{{ t('header.courses') }}</RouterLink>
          <a href="#">Contact</a>
          <RouterLink to="/dashboard">{{ t('header.myLearning') }}</RouterLink>
        </nav>
      </div>
      <div class="footer-bottom">
        <span class="footer-copy">© 2025. All rights reserved.</span>
        <div class="footer-social">
          <a href="#" aria-label="YouTube">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
              <path d="M17.812 5.017H6.145C3.855 5.017 2 6.852 2 9.116v5.768C2 17.148 3.856 18.984 6.145 18.984H17.812C20.102 18.984 21.957 17.148 21.957 14.884V9.116C21.957 6.852 20.101 5.016 17.812 5.016V5.017ZM15.009 12.28l-5.457 2.575a.5.5 0 0 1-.714-.453V9.35a.5.5 0 0 1 .714-.453l5.458 2.732a.5.5 0 0 1-.001.651Z" fill="#0F161E"/>
            </svg>
          </a>
          <a href="#" aria-label="Instagram">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
              <path d="M16.017 2H7.947A5.953 5.953 0 0 0 2 7.948v8.07A5.953 5.953 0 0 0 7.948 21.965h8.07A5.953 5.953 0 0 0 21.965 16.017V7.947A5.953 5.953 0 0 0 16.017 2Zm3.94 14.017a3.944 3.944 0 0 1-3.94 3.94H7.947a3.944 3.944 0 0 1-3.939-3.94V7.947A3.944 3.944 0 0 1 7.948 4.008h8.07a3.944 3.944 0 0 1 3.939 3.94v8.069Z" fill="#0F161E"/>
              <circle cx="12" cy="12" r="3.319" stroke="#0F161E" stroke-width="1.8"/>
              <circle cx="17.156" cy="6.844" r="1.237" fill="#0F161E"/>
            </svg>
          </a>
        </div>
      </div>
    </footer>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { reviewsApi, commentsApi } from '@/api'
import img1 from '@/assets/image.png'
import img2 from '@/assets/image2.png'
import img3 from '@/assets/image3.png'
import img4 from '@/assets/image4.png'

const vClickOutside = {
  mounted(el, binding) {
    el._outsideHandler = e => { if (!el.contains(e.target)) binding.value(e) }
    document.addEventListener('click', el._outsideHandler)
  },
  unmounted(el) { document.removeEventListener('click', el._outsideHandler) },
}

const { t, locale } = useI18n()
const router = useRouter()
const auth   = useAuthStore()

const langs = [
  { code: 'en', label: 'EN' },
  { code: 'kz', label: 'KZ' },
  { code: 'ru', label: 'RU' },
]

const langOpen    = ref(false)
const showBar     = ref(true)
const openIds     = ref([1])
const commentText  = ref('')
const commentError = ref('')
const comments     = ref([])
const reviewModal = ref(false)
const hoverRating = ref(0)
const visibleCount = ref(3)
const reviewError = ref('')
const newReview = ref({ rating: 0, author: '', title: '', text: '' })

function switchLang(code) {
  locale.value = code
  localStorage.setItem('locale', code)
}

function handleLogout() {
  auth.logout()
  router.push('/')
}

const programs = [
  {
    id: 1,
    title: 'School Mathematics (Grades 2–11)',
    available: true,
    items: ['Number sense & arithmetic', 'Fractions & Percentages', 'Equations & Inequalities', 'Geometry foundations'],
  },
  {
    id: 2,
    title: 'English / IELTS Preparation',
    available: false,
    items: [],
  },
  {
    id: 3,
    title: 'SAT / NUET Mathematics',
    available: false,
    items: [],
  },
  {
    id: 4,
    title: 'School English (Grades 2–11)',
    available: false,
    items: [],
  },
]

const allOpen = computed(() => openIds.value.length === programs.length)

function toggleProgram(id) {
  const idx = openIds.value.indexOf(id)
  if (idx === -1) openIds.value.push(id)
  else openIds.value.splice(idx, 1)
}

function toggleAll() {
  openIds.value = allOpen.value ? [] : programs.map(p => p.id)
}

const mentors = [
  { name: 'Colin Munro',    role: 'AI / ML Expert Mentor',    img: img1, bg: '#fef3c7' },
  { name: 'Sophie Johnson', role: 'Data Analyst Mentor',       img: img3, bg: '#dbeafe' },
  { name: 'Adolf Stalin',   role: 'UX Specialist Mentor',      img: img2, bg: '#fee2e2' },
  { name: 'John Braun',     role: 'Marketing Mentor',          img: img4, bg: '#d1fae5' },
]

const VOTE_KEY = 'bridge_review_votes'

function loadVotes() {
  try { return JSON.parse(localStorage.getItem(VOTE_KEY) || '{}') } catch { return {} }
}
function saveVotes(v) { localStorage.setItem(VOTE_KEY, JSON.stringify(v)) }

const reviews = ref([])
const reviewsLoading = ref(false)

onMounted(async () => {
  reviewsLoading.value = true
  try {
    const [revRes, comRes] = await Promise.all([reviewsApi.list(), commentsApi.list()])
    const votes = loadVotes()
    reviews.value = revRes.data.data.map(r => ({
      ...r,
      text: r.body,
      userVote: votes[r.id] ?? null,
    }))
    comments.value = comRes.data.data
  } finally {
    reviewsLoading.value = false
  }
})

async function submitComment() {
  const body = commentText.value.trim()
  if (!body) return
  commentError.value = ''
  try {
    const res = await commentsApi.store({ body })
    comments.value.unshift(res.data.data)
    commentText.value = ''
  } catch (e) {
    commentError.value = e.response?.data?.error || 'Failed to post comment.'
  }
}

const visibleReviews = computed(() => reviews.value.slice(0, visibleCount.value))

const avgRating = computed(() => {
  if (!reviews.value.length) return '0.0'
  const avg = reviews.value.reduce((s, r) => s + r.rating, 0) / reviews.value.length
  return avg.toFixed(1)
})

function ratingCount(n) {
  return reviews.value.filter(r => r.rating === n).length
}

function barWidth(n) {
  if (!reviews.value.length) return '0%'
  return (ratingCount(n) / reviews.value.length * 100).toFixed(0) + '%'
}

function starString(avg) {
  const n = Math.round(Number(avg))
  return '★'.repeat(n) + '☆'.repeat(5 - n)
}

async function vote(review, dir) {
  const prev = review.userVote
  const newDir = prev === dir ? null : dir

  // Optimistic update
  if (prev === 'up')   review.likes    = Math.max(0, review.likes - 1)
  if (prev === 'down') review.dislikes = Math.max(0, review.dislikes - 1)
  if (newDir === 'up')   review.likes++
  if (newDir === 'down') review.dislikes++
  review.userVote = newDir

  const votes = loadVotes()
  if (newDir === null) delete votes[review.id]
  else votes[review.id] = newDir
  saveVotes(votes)

  try {
    const res = await reviewsApi.vote(review.id, { dir: newDir, prev_dir: prev })
    review.likes    = res.data.data.likes
    review.dislikes = res.data.data.dislikes
  } catch {
    // rollback
    review.likes    -= (newDir === 'up' ? 1 : 0) - (prev === 'up' ? 1 : 0)
    review.dislikes -= (newDir === 'down' ? 1 : 0) - (prev === 'down' ? 1 : 0)
    review.userVote = prev
    const votes2 = loadVotes()
    if (prev === null) delete votes2[review.id]
    else votes2[review.id] = prev
    saveVotes(votes2)
  }
}

function openReviewModal() {
  newReview.value = { rating: 0, author: '', title: '', text: '' }
  reviewError.value = ''
  reviewModal.value = true
}

async function submitReview() {
  const r = newReview.value
  if (!r.rating)        { reviewError.value = 'Please select a star rating.'; return }
  if (!r.author.trim()) { reviewError.value = 'Please enter your name.'; return }
  if (!r.title.trim())  { reviewError.value = 'Please enter a title.'; return }
  if (!r.text.trim())   { reviewError.value = 'Please write your review.'; return }

  reviewError.value = ''
  try {
    const res = await reviewsApi.store({
      author: r.author.trim(),
      title:  r.title.trim(),
      body:   r.text.trim(),
      rating: r.rating,
    })
    const saved = res.data.data
    reviews.value.unshift({ ...saved, text: saved.body, userVote: null })
    visibleCount.value = Math.max(visibleCount.value, 1)
    reviewModal.value = false
  } catch (e) {
    reviewError.value = e.response?.data?.error || 'Failed to submit review.'
  }
}
</script>

<style scoped>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.page {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  background: #fff;
  color: #111;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

/* ── Announce bar ──────────────────────────────────────── */
.announce-bar {
  background: #fef9c3;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.45rem 1rem;
  font-size: 0.84rem;
  font-weight: 500;
  color: #78350f;
  position: relative;
}
.bar-close {
  position: absolute;
  right: 1rem;
  background: none;
  border: none;
  font-size: 1rem;
  cursor: pointer;
  color: #78350f;
}

/* ── Header ────────────────────────────────────────────── */
.header {
  background: #fff;
  border-bottom: 1px solid #f0f0f0;
  position: sticky;
  top: 0;
  z-index: 100;
}
.header-inner {
  width: 100%;
  padding: 0 2.5rem;
  height: 60px;
  display: flex;
  align-items: center;
  gap: 2.5rem;
}
.logo { display: flex; align-items: center; text-decoration: none; flex-shrink: 0; }
.logo-img { height: 32px; width: auto; }

.nav {
  display: flex;
  align-items: center;
  gap: 1.75rem;
  flex: 1;
  justify-content: center;
}
.nav-link {
  font-size: 0.88rem;
  font-weight: 500;
  color: #444;
  text-decoration: none;
  cursor: pointer;
  white-space: nowrap;
  transition: color .15s;
}
.nav-link:hover, .nav-link.router-link-active { color: #111; }

.lang-switcher { position: relative; cursor: pointer; user-select: none; }
.lang-current {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 0.88rem;
  font-weight: 600;
  color: #1a1a4e;
  padding: 4px 2px;
}
.lang-dropdown {
  position: absolute;
  top: calc(100% + 6px);
  left: 50%;
  transform: translateX(-50%);
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  box-shadow: 0 4px 16px rgba(0,0,0,.1);
  overflow: hidden;
  z-index: 200;
  min-width: 64px;
}
.lang-option {
  display: block;
  width: 100%;
  padding: 7px 16px;
  background: none;
  border: none;
  font-size: 0.85rem;
  font-weight: 600;
  color: #444;
  cursor: pointer;
  text-align: center;
  font-family: inherit;
  transition: background .12s, color .12s;
}
.lang-option:hover { background: #f5f5f5; color: #111; }
.lang-option.active { color: #e53030; }

.header-actions { display: flex; gap: 0.6rem; margin-left: auto; flex-shrink: 0; }
.btn-outline {
  border: 1.5px solid #e53030;
  background: transparent;
  color: #e53030;
  border-radius: 2rem;
  padding: 0.4rem 1.2rem;
  font-size: 0.85rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: all .15s;
}
.btn-outline:hover { background: #e53030; color: #fff; }
.btn-solid {
  background: #e53030;
  color: #fff;
  border: none;
  border-radius: 2rem;
  padding: 0.4rem 1.2rem;
  font-size: 0.85rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: background .15s;
}
.btn-solid:hover { background: #c72020; }

/* ── Container ─────────────────────────────────────────── */
.container {
  max-width: 860px;
  margin: 0 auto;
  padding: 2rem 2rem 4rem;
  width: 100%;
  flex: 1;
}

/* ── Back link ─────────────────────────────────────────── */
.back-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  color: #e53030;
  font-size: 0.88rem;
  font-weight: 500;
  text-decoration: none;
  margin-bottom: 1.25rem;
}
.back-link:hover { opacity: 0.8; }

/* ── Page title & meta ─────────────────────────────────── */
.page-title {
  font-size: 2rem;
  font-weight: 700;
  line-height: 1.2;
  color: #111;
  margin-bottom: 0.65rem;
}
.page-author {
  font-size: 0.92rem;
  color: #555;
  margin-bottom: 0.55rem;
}
.cat-link { color: #e53030; font-weight: 600; cursor: pointer; }
.page-meta {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.88rem;
  color: #555;
  margin-bottom: 1.5rem;
}
.stars { color: #FFD700; letter-spacing: 1px; font-size: 0.95rem; }
.rating-num { font-weight: 700; color: #111; }
.rating-count { color: #888; }
.meta-sep { color: #ddd; }
.last-updated { color: #888; }

.divider { height: 1px; background: #e5e7eb; margin-bottom: 2rem; }

/* ── Content sections ──────────────────────────────────── */
.content-section { margin-bottom: 2.5rem; }

.section-heading {
  font-size: 1.3rem;
  font-weight: 700;
  color: #111;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #f0f0f0;
}
.section-text {
  font-size: 0.95rem;
  color: #444;
  line-height: 1.8;
}
.content-list {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 0.65rem;
}
.content-list li {
  font-size: 0.92rem;
  color: #444;
  line-height: 1.7;
  padding-left: 1.25rem;
  position: relative;
}
.content-list li::before {
  content: '•';
  position: absolute;
  left: 0;
  color: #e53030;
  font-weight: 700;
}

/* ── Curriculum / Programs ─────────────────────────────── */
.curriculum-stats {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 0.88rem;
  color: #555;
  margin-bottom: 1rem;
}
.dot { color: #bbb; }
.expand-btn {
  margin-left: auto;
  background: none;
  border: none;
  color: #e53030;
  font-size: 0.88rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
}
.expand-btn:hover { text-decoration: underline; }

.curriculum-list {
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  overflow: hidden;
}
.module-block { border-bottom: 1px solid #e5e7eb; }
.module-block:last-child { border-bottom: none; }

.module-header {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.85rem 1.1rem;
  background: #fefce8;
  border: none;
  cursor: pointer;
  font-family: inherit;
  font-size: 0.92rem;
  font-weight: 600;
  color: #111;
  text-align: left;
  transition: background .15s;
}
.module-header:hover:not(.module-header--disabled) { background: #fef9c3; }
.module-header--disabled { cursor: default; opacity: 0.7; }
.module-title-text { flex: 1; }
.coming-soon-badge {
  font-size: 0.72rem;
  font-weight: 600;
  color: #92400e;
  background: #fef3c7;
  border: 1px solid #fcd34d;
  border-radius: 2rem;
  padding: 0.2rem 0.65rem;
  flex-shrink: 0;
}
.chevron { flex-shrink: 0; transition: transform .2s; color: #555; }
.chevron.open { transform: rotate(180deg); }

.module-body { background: #fff; padding: 0.5rem 0; }

.lesson-row {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.55rem 1.1rem;
  font-size: 0.88rem;
  transition: background .12s;
}
.lesson-row:hover { background: #fafafa; }
.lesson-icon-wrap { flex-shrink: 0; display: flex; align-items: center; }
.lesson-name { flex: 1; color: #222; }
.lesson-duration { font-size: 0.8rem; color: #888; white-space: nowrap; }

/* ── Instructors ───────────────────────────────────────── */
.instructors-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.25rem;
}
.instructor-card {
  display: flex;
  gap: 1rem;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  padding: 1.25rem;
}
.instructor-avatar {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  overflow: hidden;
  flex-shrink: 0;
}
.instructor-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}
.instructor-name { font-size: 1rem; font-weight: 700; color: #111; margin-bottom: 0.2rem; }
.instructor-role { font-size: 0.8rem; color: #888; margin-bottom: 0.5rem; }
.instructor-socials { display: flex; gap: 0.4rem; margin-bottom: 0.5rem; }
.social-btn {
  width: 26px;
  height: 26px;
  border-radius: 50%;
  border: 1.5px solid #e5e7eb;
  background: none;
  font-size: 0.7rem;
  font-weight: 700;
  color: #555;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: border-color .15s, color .15s;
}
.social-btn:hover { border-color: #e53030; color: #e53030; }
.instructor-bio { font-size: 0.82rem; color: #666; line-height: 1.6; }

/* ── Reviews ───────────────────────────────────────────── */
.reviews-top {
  display: flex;
  align-items: flex-start;
  gap: 2rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}
.overall-col { text-align: center; min-width: 80px; }
.big-score { font-size: 3.5rem; font-weight: 800; color: #111; line-height: 1; }
.big-stars { color: #FFD700; font-size: 1.2rem; letter-spacing: 2px; margin: 0.2rem 0; }
.score-label { font-size: 0.8rem; color: #888; }

.bars-col { flex: 1; min-width: 200px; display: flex; flex-direction: column; gap: 0.4rem; }
.bar-row { display: flex; align-items: center; gap: 0.6rem; }
.bar-label { font-size: 0.8rem; color: #555; white-space: nowrap; min-width: 28px; }
.bar-track { flex: 1; height: 7px; background: #f0f0f0; border-radius: 4px; overflow: hidden; }
.bar-fill { height: 100%; background: #FFD700; border-radius: 4px; }
.bar-count { font-size: 0.78rem; color: #888; min-width: 12px; text-align: right; }

.btn-write-review {
  border: 1.5px solid #e53030;
  background: transparent;
  color: #e53030;
  border-radius: 6px;
  padding: 0.55rem 1.25rem;
  font-size: 0.88rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  white-space: nowrap;
  transition: all .15s;
}
.btn-write-review:hover { background: #e53030; color: #fff; }

.review-list { display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 1.5rem; }
.review-card {
  display: flex;
  gap: 1rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #f0f0f0;
}
.review-card:last-child { border-bottom: none; }
.review-avatar { width: 44px; height: 44px; border-radius: 50%; background: #e0e0e0; flex-shrink: 0; }
.review-body { flex: 1; }
.review-top-row { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.2rem; }
.review-author { font-size: 0.9rem; font-weight: 700; color: #111; }
.review-stars { color: #FFD700; font-size: 0.85rem; letter-spacing: 1px; }
.review-title { font-size: 0.92rem; font-weight: 600; color: #111; margin-bottom: 0.4rem; }
.review-text { font-size: 0.88rem; color: #555; line-height: 1.7; margin-bottom: 0.6rem; }
.review-votes { display: flex; gap: 0.5rem; }
.vote-btn {
  background: none;
  border: 1px solid #e5e7eb;
  border-radius: 5px;
  padding: 4px 8px;
  cursor: pointer;
  color: #888;
  display: flex;
  align-items: center;
  transition: border-color .15s, color .15s;
}
.vote-btn:hover { border-color: #e53030; color: #e53030; }
.vote-btn--active { border-color: #16a34a; color: #16a34a; background: #f0fdf4; }
.vote-btn--active-down { border-color: #e53030; color: #e53030; background: #fef2f2; }

.load-more-wrap { text-align: center; }
.btn-load-more {
  background: none;
  border: 1.5px solid #d1d5db;
  color: #555;
  border-radius: 6px;
  padding: 0.55rem 2rem;
  font-size: 0.88rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: border-color .15s, color .15s;
}
.btn-load-more:hover { border-color: #e53030; color: #e53030; }

/* ── Comment section ───────────────────────────────────── */
.comment-section { border-top: 1px solid #e5e7eb; padding-top: 2rem; }
.comment-prompt { font-size: 0.88rem; color: #555; margin-bottom: 1rem; }
.text-link { color: #e53030; text-decoration: none; font-weight: 500; }
.text-link:hover { text-decoration: underline; }
.comment-area {
  width: 100%;
  border: 1.5px solid #e5e7eb;
  border-radius: 8px;
  padding: 0.75rem 1rem;
  font-size: 0.9rem;
  font-family: inherit;
  color: #111;
  resize: vertical;
  outline: none;
  transition: border-color .15s;
  margin-bottom: 0.85rem;
  display: block;
}
.comment-area:focus { border-color: #e53030; }
.comment-area:disabled { background: #f9fafb; }
.btn-post-comment {
  background: #e53030;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 0.65rem 1.75rem;
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: background .15s;
}
.btn-post-comment:hover:not(:disabled) { background: #c72020; }
.btn-post-comment:disabled { opacity: 0.5; cursor: not-allowed; }
.comment-error { color: #e53030; font-size: 0.84rem; margin-bottom: 0.6rem; }

.comments-list { margin-top: 1.75rem; display: flex; flex-direction: column; gap: 1rem; }
.comment-item { border: 1px solid #e5e7eb; border-radius: 8px; padding: 1rem 1.25rem; }
.comment-meta { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.4rem; }
.comment-author { font-weight: 600; font-size: 0.9rem; }
.comment-date { font-size: 0.8rem; color: #888; }
.comment-body { font-size: 0.9rem; color: #333; line-height: 1.55; white-space: pre-wrap; }

/* ── Footer ────────────────────────────────────────────── */
.footer { border-top: 1px solid #f0f0f0; background: #fff; }
.footer-top {
  padding: 1.75rem 2.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
  flex-wrap: wrap;
}
.footer-logo { display: flex; align-items: center; text-decoration: none; }
.footer-logo-img { height: 28px; width: auto; }
.footer-nav { display: flex; gap: 2rem; align-items: center; font-size: 0.875rem; }
.footer-nav a {
  color: #444;
  text-decoration: none;
  font-weight: 500;
  transition: color .15s;
}
.footer-nav a:hover { color: #111; }
.footer-bottom {
  padding: 0.9rem 2.5rem;
  border-top: 1px solid #f0f0f0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.footer-copy { font-size: 0.78rem; color: #9ca3af; }
.footer-social { display: flex; gap: 1rem; align-items: center; }
.footer-social a { display: flex; opacity: 0.6; transition: opacity .15s; }
.footer-social a:hover { opacity: 1; }

/* ── Review modal ──────────────────────────────────────── */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.45);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 500;
  padding: 1rem;
}
.modal-box {
  background: #fff;
  border-radius: 14px;
  width: 100%;
  max-width: 480px;
  box-shadow: 0 20px 60px rgba(0,0,0,.2);
  overflow: hidden;
}
.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1.1rem 1.5rem;
  border-bottom: 1px solid #f0f0f0;
}
.modal-title { font-size: 1.1rem; font-weight: 700; color: #111; }
.modal-close {
  background: none;
  border: none;
  font-size: 1.1rem;
  cursor: pointer;
  color: #888;
  line-height: 1;
  padding: 2px 6px;
  border-radius: 4px;
  transition: color .15s;
}
.modal-close:hover { color: #111; }

.modal-body {
  padding: 1.25rem 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.field { display: flex; flex-direction: column; gap: 0.35rem; }
.field-label { font-size: 0.85rem; font-weight: 600; color: #333; }
.field-input, .field-textarea {
  border: 1.5px solid #e5e7eb;
  border-radius: 8px;
  padding: 0.6rem 0.85rem;
  font-size: 0.9rem;
  font-family: inherit;
  color: #111;
  outline: none;
  transition: border-color .15s;
  width: 100%;
}
.field-input:focus, .field-textarea:focus { border-color: #e53030; }
.field-textarea { resize: vertical; }

.star-picker { display: flex; gap: 4px; }
.star-pick {
  background: none;
  border: none;
  font-size: 1.75rem;
  cursor: pointer;
  color: #d1d5db;
  line-height: 1;
  padding: 0;
  transition: color .1s, transform .1s;
}
.star-pick.active, .star-pick:hover { color: #FFD700; transform: scale(1.15); }

.review-error {
  font-size: 0.84rem;
  color: #e53030;
  margin: 0;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 0.75rem;
  padding: 1rem 1.5rem;
  border-top: 1px solid #f0f0f0;
}
.btn-cancel {
  background: none;
  border: 1.5px solid #e5e7eb;
  color: #555;
  border-radius: 8px;
  padding: 0.55rem 1.25rem;
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: border-color .15s;
}
.btn-cancel:hover { border-color: #aaa; }
.btn-submit-review {
  background: #e53030;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 0.55rem 1.5rem;
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: background .15s;
}
.btn-submit-review:hover { background: #c72020; }

@media (max-width: 768px) {
  .nav { display: none; }
  .header-inner { padding: 0 1.25rem; }
  .container { padding: 1.5rem 1.25rem 3rem; }
  .page-title { font-size: 1.5rem; }
  .instructors-grid { grid-template-columns: 1fr; }
  .reviews-top { gap: 1.25rem; }
  .footer-top, .footer-bottom { padding: 1.25rem; }
  .footer-nav { gap: 1rem; flex-wrap: wrap; }
}
</style>
