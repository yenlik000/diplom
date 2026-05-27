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
          <RouterLink to="/"        class="nav-link">{{ t('header.home') }}</RouterLink>
          <RouterLink to="/courses" class="nav-link">{{ t('header.courses') }}</RouterLink>
          <RouterLink to="/about"   class="nav-link">{{ t('header.about') }}</RouterLink>
          <RouterLink v-if="auth.isLoggedIn" :to="auth.dashboardRoute()" class="nav-link">{{ t('header.myLearning') }}</RouterLink>
          <RouterLink to="/founder" class="nav-link active">{{ t('about.navFounder') }}</RouterLink>
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

    <!-- ── Main ─────────────────────────────────────────────── -->
    <div class="container">

      <!-- Hero -->
      <section class="hero">
        <div class="hero-img-wrap">
          <img :src="founderImg" alt="Altyn Bolat" class="hero-img" />
          <div class="hero-img-caption">
            <span class="caption-accent"></span>
            Altyn Bolat
          </div>
        </div>
        <div class="hero-text">
          <h1 class="hero-title">Founder — Altyn Bolat</h1>
          <div class="hero-line-gray" />
          <p class="hero-bio">
            Altyn Bolat is not just the founder of the school, but also a lead multi-instrumentalist
            trainer. Founder of the school, lead trainer, and creator of unique teaching methods that
            turn complex formulas and rules into a clear and understandable system. From the basics of
            arithmetic for elementary students to advanced algebra and SAT/UNT logic.
          </p>
          <div class="hero-line-red" />
          <p class="key-facts-label">Key Facts:</p>
          <ul class="key-facts">
            <li>Executive education at London Business School</li>
            <li>Expert in Harvard case-based learning methodology</li>
            <li>Focused on practical decision-making and leadership development</li>
          </ul>
        </div>
      </section>

      <!-- Sub-heading -->
      <h2 class="section-heading">
        Altyn Bolat — Case Method Practitioner &amp; Harvard-Certified Educator
      </h2>

      <!-- Quote block -->
      <div class="quote-block">
        <p>
          Oleg Tsoy brings 25+ years of leadership experience across public service, banking, industry
          and executive education. He teaches real managerial decision-making using Harvard Business
          School case studies adapted for Central Asia.
        </p>
      </div>

      <!-- Feature cards -->
      <div class="cards">
        <div class="card" v-for="card in cards" :key="card.title">
          <p class="card-title">• {{ card.title }}</p>
          <p class="card-body">{{ card.body }}</p>
          <div class="card-divider" />
          <a href="#" class="card-link">Learn more →</a>
        </div>
      </div>

      <!-- Certificates -->
      <div class="certs">
        <div class="cert-col cert-col--tall">
          <img :src="cert1" alt="Harvard Business School" class="cert-img" />
        </div>
        <div class="cert-col cert-col--mid">
          <img :src="cert2" alt="London Business School" class="cert-img" />
          <img :src="cert3" alt="Harvard Business Publishing" class="cert-img" />
        </div>
        <div class="cert-col cert-col--tall">
          <img :src="cert4" alt="Caspian University" class="cert-img" />
        </div>
      </div>

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
          <a href="#">{{ t('about.footerContact') }}</a>
          <RouterLink to="/dashboard">{{ t('header.myLearning') }}</RouterLink>
        </nav>
      </div>
      <div class="footer-bottom">
        <span class="footer-copy">{{ t('about.footerCopy') }}</span>
        <div class="footer-social">
          <a href="#" aria-label="YouTube">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M17.812 5.01711H6.145C3.855 5.01711 2 6.85211 2 9.11611V14.8841C2 17.1481 3.856 18.9841 6.145 18.9841H17.812C20.102 18.9841 21.957 17.1481 21.957 14.8841V9.11611C21.957 6.85211 20.101 5.01611 17.812 5.01611V5.01711ZM15.009 12.2801L9.552 14.8551C9.51872 14.8711 9.48192 14.8785 9.44503 14.8765C9.40815 14.8744 9.37237 14.8631 9.34103 14.8436C9.3097 14.824 9.28382 14.7968 9.2658 14.7646C9.24779 14.7323 9.23822 14.6961 9.238 14.6591V9.35011C9.23867 9.31299 9.24872 9.27663 9.26722 9.24444C9.28573 9.21224 9.31208 9.18526 9.34382 9.16599C9.37556 9.14673 9.41167 9.13581 9.44877 9.13425C9.48587 9.1327 9.52276 9.14057 9.556 9.15711L15.014 11.8921C15.0504 11.9102 15.0809 11.9383 15.102 11.9729C15.1232 12.0076 15.1341 12.0476 15.1336 12.0882C15.1331 12.1288 15.1211 12.1685 15.0991 12.2026C15.077 12.2367 15.0458 12.2639 15.009 12.2811V12.2801Z" fill="#0F161E"/>
            </svg>
          </a>
          <a href="#" aria-label="Instagram">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M16.017 2H7.947C6.37015 2.00185 4.85844 2.62914 3.74353 3.74424C2.62862 4.85933 2.00159 6.37115 2 7.948L2 16.018C2.00185 17.5948 2.62914 19.1066 3.74424 20.2215C4.85933 21.3364 6.37115 21.9634 7.948 21.965H16.018C17.5948 21.9631 19.1066 21.3359 20.2215 20.2208C21.3364 19.1057 21.9634 17.5938 21.965 16.017V7.947C21.9631 6.37015 21.3359 4.85844 20.2208 3.74353C19.1057 2.62862 17.5938 2.00159 16.017 2V2ZM19.957 16.017C19.957 17.0618 19.5418 18.0638 18.803 18.8026C18.0642 19.5415 17.0622 19.9567 16.017 19.957H7.947C6.90222 19.9567 5.90032 19.5415 5.16165 18.8026C4.42297 18.0638 4.008 17.0618 4.008 16.017V7.947C4.00827 6.90222 4.42349 5.90032 5.16235 5.16165C5.90122 4.42297 6.90322 4.008 7.948 4.008H16.018C17.0628 4.00827 18.0647 4.42349 18.8034 5.16235C19.542 5.90122 19.957 6.90322 19.957 7.948V16.018V16.017Z" fill="#0F161E"/>
              <path d="M11.9821 6.81909C10.6135 6.82121 9.3016 7.36588 8.33397 8.3337C7.36633 9.30152 6.82192 10.6135 6.82007 11.9821C6.82166 13.351 7.36609 14.6634 8.33397 15.6315C9.30185 16.5996 10.6142 17.1442 11.9831 17.1461C13.3522 17.1445 14.6647 16.5999 15.6328 15.6318C16.6009 14.6637 17.1455 13.3512 17.1471 11.9821C17.145 10.6132 16.6 9.30098 15.6318 8.33329C14.6635 7.3656 13.351 6.82141 11.9821 6.82009V6.81909ZM11.9821 15.1381C11.1453 15.1381 10.3428 14.8057 9.75115 14.214C9.15947 13.6223 8.82707 12.8198 8.82707 11.9831C8.82707 11.1463 9.15947 10.3438 9.75115 9.75217C10.3428 9.16049 11.1453 8.82809 11.9821 8.82809C12.8188 8.82809 13.6213 9.16049 14.213 9.75217C14.8047 10.3438 15.1371 11.1463 15.1371 11.9831C15.1371 12.8198 14.8047 13.6223 14.213 14.214C13.6213 14.8057 12.8188 15.1381 11.9821 15.1381Z" fill="#0F161E"/>
              <path d="M17.1559 8.09509C17.8391 8.09509 18.3929 7.54127 18.3929 6.85809C18.3929 6.17492 17.8391 5.62109 17.1559 5.62109C16.4728 5.62109 15.9189 6.17492 15.9189 6.85809C15.9189 7.54127 16.4728 8.09509 17.1559 8.09509Z" fill="#0F161E"/>
            </svg>
          </a>
        </div>
      </div>
    </footer>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import founderImg from '@/assets/founder.png'
import cert1 from '@/assets/certificate 1.png'
import cert2 from '@/assets/certificate 2.jpg'
import cert3 from '@/assets/certificate 3.png'
import cert4 from '@/assets/certificate 4.jpg'

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

const langOpen = ref(false)
const showBar  = ref(true)

function switchLang(code) {
  locale.value = code
  localStorage.setItem('locale', code)
}

function handleLogout() {
  auth.logout()
  router.push('/')
}

const cards = [
  {
    title: 'Harvard-Certified Educator',
    body:  'Registered and officially certified by Harvard Business Publishing Education, adapt and facilitate case-based learning using licensed HBP materials. Global teaching standards.',
  },
  {
    title: '250+ Case Studies Completed',
    body:  'A portfolio of 250+ cases across Harvard, LBS and modern business scenarios — spanning strategy, leadership, crisis management, negotiations and organizational behavior.',
  },
  {
    title: 'Harvard-Certified Educator',
    body:  'Chairman, CEO and Board Member across major holdings — bringing real executive practice into every case.',
  },
]
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
  cursor: pointer;
  font-size: 0.9rem;
  color: #78350f;
}

.nav {
  display: flex;
  align-items: center;
  gap: 1.6rem;
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

/* ── Header ────────────────────────────────────────────── */
.header { background: #fff; border-bottom: 1px solid #f0f0f0; position: sticky; top: 0; z-index: 100; }
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
  font-size: 0.9rem;
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
  font-size: 0.9rem;
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
  padding: 0.42rem 1.25rem;
  font-size: 0.875rem;
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
  padding: 0.42rem 1.25rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
  transition: background .15s;
}
.btn-solid:hover { background: #c72020; }

/* ── Container ─────────────────────────────────────────── */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 3rem 2rem 4rem;
  flex: 1;
}

/* ── Hero ──────────────────────────────────────────────── */
.hero {
  display: grid;
  grid-template-columns: 320px 1fr;
  gap: 3rem;
  align-items: flex-start;
  margin-bottom: 3.5rem;
}
.hero-img-wrap {
  position: relative;
  border-radius: 16px;
  overflow: hidden;
  aspect-ratio: 3/4;
  flex-shrink: 0;
}
.hero-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: top center;
  display: block;
}
.hero-img-caption {
  position: absolute;
  bottom: 5px;
  left: 30%;
  right: 0;
  z-index: 1;
  background: rgb(255, 255, 255);
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 1rem;
  font-weight: 600;
  color: #111;
}
.caption-accent {
  display: block;
  width: 10px;
  height: 42px;
  background: #e53030;
  flex-shrink: 0;
}
.hero-title {
  font-size: 2.4rem;
  font-weight: 700;
  margin-bottom: 1rem;
  line-height: 1.15;
}
.hero-line-gray {
  height: 1px;
  background: #d1d5db;
  width: 100%;
  margin-bottom: 1.25rem;
}
.hero-bio {
  font-size: 0.97rem;
  color: #333;
  line-height: 1.75;
  margin-bottom: 1.25rem;
}
.hero-line-red {
  height: 2.5px;
  background: #e53030;
  width: 100%;
  margin-bottom: 1.25rem;
}
.key-facts-label {
  font-weight: 700;
  font-size: 0.97rem;
  margin-bottom: 0.75rem;
}
.key-facts {
  list-style: disc;
  padding-left: 1.4rem;
  display: flex;
  flex-direction: column;
  gap: 0.6rem;
  font-size: 0.95rem;
  color: #444;
  line-height: 1.6;
}

/* ── Section heading ───────────────────────────────────── */
.section-heading {
  font-size: 1.6rem;
  font-weight: 400;
  margin-bottom: 2rem;
  line-height: 1.3;
  max-width: 600px;
}

/* ── Quote block ───────────────────────────────────────── */
.quote-block {
  background: #111;
  color: #fff;
  border-radius: 16px;
  padding: 2rem 2.5rem;
  font-size: 1rem;
  line-height: 1.75;
  margin-bottom: 2rem;
}

/* ── Feature cards ─────────────────────────────────────── */
.cards {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
  margin-bottom: 3rem;
}
.card {
  background: #111;
  color: #fff;
  border-radius: 16px;
  padding: 1.5rem 1.75rem 1.75rem;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}
.card-title {
  font-size: 0.95rem;
  font-weight: 700;
  line-height: 1.3;
}
.card-body {
  font-size: 0.85rem;
  color: #ccc;
  line-height: 1.65;
  flex: 1;
}
.card-divider {
  height: 1px;
  background: #333;
}
.card-link {
  color: #fff;
  font-size: 0.85rem;
  font-weight: 600;
  text-decoration: none;
  transition: color .15s;
}
.card-link:hover { color: #f87171; }

/* ── Certificates ──────────────────────────────────────── */
.certs {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
  align-items: stretch;
  margin-bottom: 2rem;
}
.cert-col {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}
.cert-img {
  display: block;
  width: 100%;
  border-radius: 12px;
  border: 1px solid #e5e7eb;
  background: #f9fafb;
  object-fit: contain;
}
/* Middle column: two images each take equal half of the row height */
.cert-col--mid .cert-img {
  flex: 1;
  min-height: 0;
  height: 0; /* flex will override; forces stretch */
}
/* Outer columns: single image stretches to match middle's total height */
.cert-col--tall {
  height: 100%;
}
.cert-col--tall .cert-img {
  flex: 1;
  min-height: 0;
  height: 100%;
}
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
.footer-nav { display: flex; gap: 2rem; align-items: center; }
.footer-nav a {
  font-size: 0.88rem;
  font-weight: 500;
  color: #444;
  text-decoration: none;
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
</style>
