<template>
  <div class="landing-page">

    <!-- Announcement banner -->
    <!-- <div v-if="showBanner" class="announcement-bar">
      <span>🚀 {{ t('landing.announcement') }}</span>
      <button class="banner-close" @click="showBanner = false">✕</button>
    </div> -->

    <!-- Header -->
    <!-- <header class="site-header">
      <RouterLink to="/" class="site-logo">
        <img src="@/assets/logo.png" alt="Bridge" class="logo-img" />
      </RouterLink>

      <nav class="site-nav">
        <RouterLink to="/">{{ t('header.home') }}</RouterLink>
        <RouterLink to="/courses">{{ t('header.courses') }} <span class="caret">▾</span></RouterLink>
        <RouterLink to="/">{{ t('header.about') }}</RouterLink>
        <RouterLink to="/dashboard">{{ t('header.myLearning') }}</RouterLink>
      </nav>

      <div class="site-auth">
        <div class="lang-switcher">
          <button
            v-for="lang in langs" :key="lang.code"
            class="lang-btn" :class="{ active: locale === lang.code }"
            @click="switchLang(lang.code)"
          >{{ lang.label }}</button>
        </div>
        <template v-if="auth.isLoggedIn">
          <RouterLink to="/dashboard" class="btn-signup">{{ t('header.cabinet') }}</RouterLink>
          <button class="btn-login-pill" @click="handleLogout">{{ t('header.logout') }}</button>
        </template>
        <template v-else>
          <RouterLink to="/register" class="btn-signup">{{ t('header.signUp') }}</RouterLink>
          <RouterLink to="/login" class="btn-login-pill">{{ t('header.login') }}</RouterLink>
        </template>
      </div>
    </header> -->

    <!-- Hero -->
    <section class="hero">

      <!-- Floating avatars -->
      <!-- <div class="float-el av-tl">
        <div class="av-ring av-ring--lg">
          <img src="@/assets/image.png" alt="" class="av-img" />
        </div>
      </div>
      <div class="float-el av-bl">
        <div class="av-ring av-ring--md">
          <img src="@/assets/image2.png" alt="" class="av-img" />
        </div>
      </div>
      <div class="float-el av-tr">
        <div class="av-ring av-ring--md">
          <img src="@/assets/image3.png" alt="" class="av-img" />
        </div>
      </div>
      <div class="float-el av-br">
        <div class="av-ring av-ring--lg">
          <img src="@/assets/image4.png" alt="" class="av-img" />
        </div>
      </div> -->

      <!-- Yellow diamond (left) -->
      <div class="float-el deco-diamond">◆</div>

      <!-- Yellow starburst (right) -->
      <!-- <div class="float-el deco-starburst">
        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="18" cy="18" r="4" fill="#f5c518"/>
          <line x1="18" y1="2"  x2="18" y2="11" stroke="#f5c518" stroke-width="2.5" stroke-linecap="round"/>
          <line x1="18" y1="25" x2="18" y2="34" stroke="#f5c518" stroke-width="2.5" stroke-linecap="round"/>
          <line x1="2"  y1="18" x2="11" y2="18" stroke="#f5c518" stroke-width="2.5" stroke-linecap="round"/>
          <line x1="25" y1="18" x2="34" y2="18" stroke="#f5c518" stroke-width="2.5" stroke-linecap="round"/>
          <line x1="7"  y1="7"  x2="13" y2="13" stroke="#f5c518" stroke-width="2" stroke-linecap="round"/>
          <line x1="23" y1="23" x2="29" y2="29" stroke="#f5c518" stroke-width="2" stroke-linecap="round"/>
          <line x1="29" y1="7"  x2="23" y2="13" stroke="#f5c518" stroke-width="2" stroke-linecap="round"/>
          <line x1="13" y1="23" x2="7"  y2="29" stroke="#f5c518" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </div> -->

      <!-- Centered content -->
      <!-- <div class="hero-content">
        <h1 class="hero-title">
          {{ t('landing.heroTitle1') }}<br>
          {{ t('landing.heroTitle2') }}
        </h1>
        <svg class="title-underline" viewBox="0 0 340 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
          <path d="M4 10 C55 3, 115 13, 170 7 C225 1, 285 12, 336 8"
            stroke="#f5c518" stroke-width="5.5" stroke-linecap="round"/>
        </svg>
        <RouterLink to="/courses">
          <button class="btn-explore">{{ t('landing.exploreCourses') }}</button>
        </RouterLink>
      </div> -->
    </section>

    <!-- Features -->
    <!-- <section class="section features-section">
      <div class="container">
        <h2 class="section-title text-center">{{ t('landing.whyBridge') }}</h2>
        <div class="features-grid">
          <div v-for="f in features" :key="f.icon" class="feature-card">
            <i :class="`pi ${f.icon} feature-icon`"></i>
            <h3>{{ f.title }}</h3>
            <p>{{ f.desc }}</p>
          </div>
        </div>
      </div>
    </section> -->

    <!-- Courses preview -->
    <!-- <section class="section courses-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">{{ t('landing.ourCourses') }}</h2>
          <RouterLink to="/courses">
            <Button :label="t('landing.allCourses')" severity="secondary" outlined />
          </RouterLink>
        </div>
        <div v-if="coursesLoading" class="courses-skeleton">
          <Skeleton v-for="i in 3" :key="i" height="280px" border-radius="8px" />
        </div>
        <div v-else class="grid grid-3">
          <CourseCard v-for="c in previewCourses" :key="c.id" :course="c" />
        </div>
      </div>
    </section> -->

    <!-- Testimonials -->
    <!-- <section class="section testimonials-section">
      <div class="container">
        <h2 class="section-title text-center">{{ t('landing.reviews') }}</h2>
        <div class="grid grid-3">
          <div v-for="item in testimonials" :key="item.name" class="testimonial-card">
            <div class="stars">
              <i v-for="s in 5" :key="s" class="pi pi-star-fill star-icon"></i>
            </div>
            <p class="testimonial-text">"{{ item.text }}"</p>
            <div class="testimonial-author">
              <div class="author-avatar">{{ item.name[0] }}</div>
              <div>
                <div class="author-name">{{ item.name }}</div>
                <div class="author-role">{{ item.role }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- CTA -->
    <!-- <section class="cta-section">
      <div class="container cta-inner">
        <h2>{{ t('landing.ctaTitle') }}</h2>
        <p>{{ t('landing.ctaDesc') }}</p>
        <RouterLink to="/register">
          <Button :label="t('landing.ctaButton')" size="large" />
        </RouterLink>
      </div>
    </section> -->

    <AppFooter />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useI18n } from 'vue-i18n'
import Button from 'primevue/button'
import Skeleton from 'primevue/skeleton'
import AppFooter from '@/components/layout/AppFooter.vue'
import CourseCard from '@/components/course/CourseCard.vue'
import { useCoursesStore } from '@/stores/courses'
import { useAuthStore } from '@/stores/auth'

const { t, locale } = useI18n()
const store  = useCoursesStore()
const auth   = useAuthStore()
const router = useRouter()

const showBanner  = ref(true)
const coursesLoading = ref(true)

const previewCourses = computed(() => store.courses.slice(0, 3))

onMounted(async () => {
  await store.fetchCourses()
  coursesLoading.value = false
})

const langs = [
  { code: 'ru', label: 'RU' },
  { code: 'kz', label: 'KZ' },
  { code: 'en', label: 'EN' },
]

function switchLang(code) {
  locale.value = code
  localStorage.setItem('locale', code)
}

function handleLogout() {
  auth.logout()
  router.push('/')
}

const features = computed(() => [
  { icon: 'pi-video',        title: t('landing.featVideoTitle'),    desc: t('landing.featVideoDesc')    },
  { icon: 'pi-chart-line',   title: t('landing.featProgressTitle'), desc: t('landing.featProgressDesc') },
  { icon: 'pi-check-circle', title: t('landing.featHomeworkTitle'), desc: t('landing.featHomeworkDesc') },
  { icon: 'pi-lock',         title: t('landing.featPaceTitle'),     desc: t('landing.featPaceDesc')     },
  { icon: 'pi-globe',        title: t('landing.featIeltsTitle'),    desc: t('landing.featIeltsDesc')    },
  { icon: 'pi-users',        title: t('landing.featAgesTitle'),     desc: t('landing.featAgesDesc')     },
])

const testimonials = [
  { name: 'Айгерим К.', role: 'Сдала IELTS 7.0', text: 'Bridge помог мне систематизировать знания и сдать экзамен с первого раза!' },
  { name: 'Данияр М.',  role: 'Ученик 8 класса',  text: 'Уроки понятные, видео короткие и по делу. Прогресс виден сразу.' },
  { name: 'Алия С.',    role: 'Готовится к SAT',  text: 'Отличная платформа! Структурированные курсы и удобный личный кабинет.' },
]
</script>

<style scoped>
* { box-sizing: border-box; }

.landing-page {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* ── Announcement bar ── */
.announcement-bar {
  background: #fef9c3;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.55rem 1rem;
  font-size: 0.875rem;
  color: #555;
  position: relative;
}

.banner-close {
  position: absolute;
  right: 1.25rem;
  background: none;
  border: none;
  font-size: 1rem;
  color: #888;
  cursor: pointer;
  line-height: 1;
  padding: 0;
}
.banner-close:hover { color: #333; }

/* ── Header ── */
.site-header {
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 2.5rem;
  height: 70px;
  border-bottom: 1px solid #f0f0f0;
  position: sticky;
  top: 0;
  z-index: 100;
}

.logo-img { height: 48px; width: auto; }

.site-nav {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.site-nav a {
  font-size: 0.9375rem;
  font-weight: 500;
  color: #2a2a50;
  text-decoration: none;
  transition: color 0.15s;
}
.site-nav a:hover,
.site-nav a.router-link-active { color: #c53030; }

.caret { font-size: 0.75rem; }

.site-auth {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

/* Language switcher */
.lang-switcher {
  display: flex;
  align-items: center;
  gap: 2px;
  background: #f5f5f5;
  border: 1px solid #e8e8e8;
  border-radius: 6px;
  padding: 2px;
}

.lang-btn {
  background: none;
  border: none;
  padding: 3px 8px;
  font-size: 0.75rem;
  font-weight: 600;
  color: #888;
  cursor: pointer;
  border-radius: 4px;
  transition: background 0.15s, color 0.15s;
  letter-spacing: 0.03em;
}
.lang-btn:hover { color: #333; }
.lang-btn.active {
  background: #fff;
  color: #c53030;
  box-shadow: 0 1px 3px rgba(0,0,0,.1);
}

.btn-signup {
  border: 2px solid #c53030;
  color: #c53030;
  background: transparent;
  border-radius: 2rem;
  padding: 0.45rem 1.4rem;
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  transition: background 0.15s, color 0.15s;
}
.btn-signup:hover { background: #fef2f2; }

.btn-login-pill {
  background: #c53030;
  color: #fff;
  border: 2px solid #c53030;
  border-radius: 2rem;
  padding: 0.45rem 1.4rem;
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  transition: background 0.15s;
}
.btn-login-pill:hover { background: #a52020; border-color: #a52020; }

/* ── Hero ── */
.hero {
  position: relative;
  min-height: 82vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;
  overflow: hidden;
}

/* Floating elements base */
.float-el { position: absolute; }

/* Avatars */
.av-tl { left: 10%;  top: 28%; }
.av-bl { left: 16%;  top: 64%; }
.av-tr { right: 9%;  top: 24%; }
.av-br { right: 17%; top: 63%; }

.av-ring {
  border-radius: 50%;
  background: #d4d4d4;
  border: 3px solid #ededed;
  box-shadow: 0 4px 14px rgba(0,0,0,0.09);
  overflow: hidden;
}
.av-ring--lg { width: 90px; height: 90px; }
.av-ring--md { width: 78px; height: 78px; }

.av-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* Decorative */
.deco-diamond {
  left: 8.5%;
  top: 50%;
  font-size: 26px;
  color: #f5c518;
}

.deco-starburst {
  right: 16%;
  top: 55%;
}

/* Central content */
.hero-content {
  text-align: center;
  z-index: 1;
  max-width: 860px;
  padding: 0 2rem;
}

.hero-title {
  font-size: clamp(2.75rem, 5.5vw, 5.25rem);
  font-weight: 900;
  color: #0d0d0d;
  line-height: 1.1;
  margin: 0;
  letter-spacing: -0.025em;
}

.title-underline {
  display: block;
  width: clamp(180px, 26vw, 340px);
  height: 14px;
  margin: 0.3rem auto 2.75rem;
}

.btn-explore {
  background: #a8c3cd;
  color: #426070;
  border: none;
  border-radius: 2rem;
  padding: 0.9rem 3rem;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.15s;
  font-family: inherit;
}
.btn-explore:hover { background: #93b2be; }

/* ── Sections (reused from global) ── */
.section { padding: 5rem 0; }

.container {
  width: 100%;
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

.section-title {
  font-size: 2rem;
  font-weight: 800;
  margin: 0 0 2.5rem;
}
.text-center { text-align: center; }

.section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 2rem;
}
.section-header .section-title { margin: 0; }

.features-section { background: #fafafa; }

.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
}

.feature-card {
  background: #fff;
  border: 1px solid var(--border-color, #e8e8e8);
  border-radius: 10px;
  padding: 1.5rem;
}
.feature-icon {
  font-size: 1.75rem;
  color: var(--brand-burgundy, #8B1A1A);
  margin-bottom: 0.75rem;
  display: block;
}
.feature-card h3 { font-size: 1rem; font-weight: 700; margin: 0 0 0.5rem; }
.feature-card p  { font-size: 0.875rem; color: #666; margin: 0; line-height: 1.6; }

.courses-section { background: #f5f5f5; }

.courses-skeleton {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}

.grid.grid-3 {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}

.testimonials-section { background: #fff; }

.testimonial-card {
  background: #f9f9f9;
  border: 1px solid #ebebeb;
  border-radius: 10px;
  padding: 1.5rem;
}
.stars { display: flex; gap: 2px; margin-bottom: 0.75rem; }
.star-icon { font-size: 0.875rem; color: #f59e0b; }
.testimonial-text { font-size: 0.9rem; color: #333; line-height: 1.6; margin: 0 0 1rem; }
.testimonial-author { display: flex; align-items: center; gap: 0.75rem; }
.author-avatar {
  width: 36px; height: 36px;
  background: #8B1A1A;
  color: #fff;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 0.875rem; flex-shrink: 0;
}
.author-name { font-weight: 600; font-size: 0.875rem; }
.author-role { font-size: 0.75rem; color: #888; }

.cta-section {
  background-image: url('@/assets/image.png');
  background-size: cover;
  background-position: center;
  color: #fff;
  padding: 5rem 0;
}
.cta-inner { text-align: center; max-width: 600px; margin: 0 auto; }
.cta-inner h2 { font-size: 2.25rem; font-weight: 800; margin: 0 0 1rem; }
.cta-inner p  { font-size: 1.1rem; opacity: 0.85; margin: 0 0 2rem; }

/* ── Mobile ── */
@media (max-width: 768px) {
  .site-header { padding: 0 1.25rem; }
  .site-nav { display: none; }
  .hero { min-height: 70vh; }
  .av-tl, .av-bl, .av-tr, .av-br, .deco-diamond, .deco-starburst { display: none; }
  .hero-title { font-size: clamp(2rem, 8vw, 3rem); }
}
</style>
