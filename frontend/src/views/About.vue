<template>
  <div class="home">

    <!-- Announcement bar -->
    <!-- <div v-if="showBar" class="announce-bar">
      <span>⚡ BRIDGE online courses for kids</span>
      <button class="bar-close" @click="showBar = false">✕</button>
    </div> -->
    <!-- Announcement banner -->
    <div v-if="showBar" class="announce-bar">
      <span>🚀 {{ t('landing.announcement') }}</span>
      <button class="bar-close" @click="showBar = false">✕</button>
    </div>

    <!-- Header -->
    <header class="site-header">
      <div class="hdr-inner">
        <RouterLink to="/" class="site-logo">
          <img src="@/assets/logo.png" alt="Bridge" class="logo-img" />
        </RouterLink>

        <nav class="site-nav">
          <RouterLink to="/">Home</RouterLink>
          <span class="nav-drop">Courses <i class="pi pi-angle-down"></i></span>
          <RouterLink to="/about">About us</RouterLink>
          <RouterLink to="/dashboard">My Learning</RouterLink>
        </nav>

        <div class="hdr-actions">
          <RouterLink to="/login"><button class="btn-signup">Login</button></RouterLink>
          <RouterLink to="/login"><button class="btn-login-hdr">Login</button></RouterLink>
        </div>
      </div>
    </header>

    <!-- Hero -->
    <section class="hero">
      <!-- Decorative -->
      <div class="hero-deco diamond">✦</div>
      <div class="hero-deco starburst">✦</div>

      <!-- Floating avatars -->
      <div class="avatar av1"><img src="@/assets/image2.png" alt="" /></div>
      <div class="avatar av2"><img src="@/assets/image3.png" alt="" /></div>
      <div class="avatar av3"><img src="@/assets/image4.png" alt="" /></div>
      <div class="avatar av4"><img src="@/assets/image2.png" alt="" /></div>

      <div class="hero-content">
        <h1 class="hero-title">
          Elevate Your Skills<br/>
          with Expert-Led <span class="underlined">Training
            <svg class="underline-svg" width="248" height="11" viewBox="0 0 248 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.73613 0.143464L2.62132 1.33984C2.22525 1.41733 1.86189 1.61283 1.57899 1.90065L0.573642 2.92349C-0.241225 3.75253 -0.180051 5.09923 0.706624 5.85097L1.45364 6.48432C1.81497 6.79066 2.2733 6.9588 2.74701 6.9588H6.1415H11.0849C11.3258 6.9588 11.5647 7.00232 11.7901 7.08726L16.18 8.74142C16.5559 8.88305 16.9657 8.90823 17.3561 8.81366L24.7812 7.01502C24.9354 6.97767 25.0935 6.9588 25.2521 6.9588H32.68H38.3541C38.5025 6.9588 38.6504 6.97531 38.7952 7.00804L47.0459 8.87342C47.2953 8.92982 47.5533 8.93785 47.8058 8.89707L59.52 7.00533C59.7111 6.97447 59.9057 6.97152 60.0976 6.99655L75.1415 8.9588H87.3286C87.46 8.9588 87.591 8.97175 87.7198 8.99745L97.1483 10.8783C97.4145 10.9314 97.6887 10.9298 97.9542 10.8735L106.783 9.00227C106.919 8.97337 107.057 8.95867 107.196 8.95924C109.038 8.96678 112.567 9.07391 113.475 9.4588C114.389 9.84633 124.234 8.07503 129.495 7.05485C129.818 6.99206 130.153 7.00965 130.468 7.10683L135.886 8.77714C136.27 8.8955 136.68 8.8955 137.064 8.77714L142.418 7.1264C142.774 7.01684 143.153 7.00853 143.512 7.1024L150.38 8.89404C150.545 8.93704 150.715 8.9588 150.885 8.9588H165.794C165.906 8.9588 166.018 8.94939 166.128 8.93065L177.591 6.98695C177.701 6.96822 177.813 6.9588 177.925 6.9588H192.834C193.004 6.9588 193.174 6.98057 193.338 7.02357L200.177 8.80756C200.555 8.90622 200.954 8.8919 201.324 8.76637L205.933 7.20348C206.398 7.04588 206.904 7.06463 207.356 7.25615L210.779 8.70734C211.165 8.87084 211.592 8.9091 212.001 8.81672L219.814 7.05017C220.081 6.9899 220.357 6.98491 220.626 7.03552L230.372 8.87178C230.676 8.92901 230.989 8.91505 231.286 8.83097L237.644 7.03418C237.821 6.98417 238.004 6.9588 238.188 6.9588H247.077C248.105 6.9588 248.37 5.53506 247.411 5.16535L247.205 5.08618C246.556 4.83588 246.49 3.94282 247.096 3.60033C247.771 3.21871 247.593 2.20062 246.829 2.07096L243.42 1.49303C243.286 1.47027 243.15 1.46127 243.014 1.46618L216.154 2.43522C215.729 2.45054 215.311 2.33023 214.959 2.09171L213.256 0.936664C212.806 0.631343 212.251 0.522537 211.719 0.635321L203.732 2.32829C203.331 2.41324 202.914 2.37305 202.536 2.21313L201.405 1.73333C200.985 1.55565 200.518 1.52628 200.08 1.6501L198.055 2.22242C197.521 2.37319 196.949 2.29574 196.475 2.00855L193.705 0.330923C193.307 0.0903653 192.839 -0.00446293 192.379 0.0627063L177.058 2.30232C176.39 2.39996 175.718 2.15409 175.271 1.6485L174.911 1.24149C174.477 0.751147 173.831 0.504136 173.181 0.580176L158.808 2.26096C158.233 2.32818 157.888 1.64084 158.285 1.21991C158.684 0.796437 158.333 0.105537 157.755 0.179721L140.673 2.37404C140.245 2.42907 139.81 2.34397 139.434 2.13147L137.122 0.824376C136.704 0.588533 136.216 0.510381 135.746 0.604148L127.535 2.24217C126.86 2.37695 126.162 2.1545 125.689 1.6534L124.788 0.698544C124.35 0.233709 123.715 0.00648549 123.081 0.0871134L112.489 1.43422C112.36 1.45057 112.23 1.45439 112.101 1.44562L97.9855 0.48822C97.6997 0.468834 97.413 0.511079 97.1449 0.612095L92.7728 2.25955C92.4271 2.38984 92.052 2.42179 91.6892 2.35189L79.7083 0.0433071C79.4194 -0.0123447 79.1219 -0.00360762 78.8369 0.0688957L74.0254 1.29268C73.6017 1.40045 73.1543 1.36641 72.7518 1.19578L71.7147 0.756145C71.2629 0.564628 70.7565 0.545884 70.2918 0.70348L68.6289 1.26744C68.3001 1.37893 67.9382 1.24457 67.7619 0.945566C67.5927 0.658719 67.2515 0.521921 66.931 0.612486L64.7355 1.23295C64.3346 1.34627 63.9364 1.04501 63.9364 0.628325C63.9364 0.265637 63.6302 -0.0217274 63.2682 0.00128835L40.6881 1.43709C40.4621 1.45146 40.2353 1.42733 40.0173 1.36573L37.1391 0.552322C36.9201 0.490429 36.6921 0.46637 36.465 0.481181L21.9376 1.42862C21.687 1.44496 21.4748 1.24614 21.4748 0.995045C21.4748 0.718821 21.2205 0.512716 20.9502 0.569991L17.4654 1.30862C17.1005 1.38598 16.7569 1.1076 16.7569 0.734507C16.7569 0.345307 16.3849 0.0639142 16.0104 0.16976L12.4741 1.16915C11.8334 1.35022 11.1446 1.2006 10.6368 0.770048L10.4135 0.580735C9.94989 0.187655 9.33266 0.0267517 8.73613 0.143464Z" fill="#FFD700"/>
            </svg>
          </span>
        </h1>
        <RouterLink to="/courses">
          <button class="btn-explore">Explore courses</button>
        </RouterLink>
      </div>
    </section>

    <!-- Space CTA -->
    <section class="space-section">
      <img src="@/assets/second.png" alt="" class="space-bg" />
    </section>

    <!-- Team -->
    <section class="team-section">
      <div class="container">
        <div class="badge">Our Team</div>
        <h2 class="sec-title">Learn from Industry Experts</h2>
        <p class="sec-sub">Gain insights from industry experts and master real-world skills for career growth and professional development</p>

        <div class="mentors-grid">
          <div v-for="m in mentors" :key="m.name" class="mentor-card">
            <div class="mentor-avatar" :style="{ background: m.color }">
              <span>{{ m.name[0] }}</span>
            </div>
            <div class="mentor-info">
              <h3>{{ m.name }}</h3>
              <p>{{ m.role }}</p>
              <div class="mentor-meta">
                <span class="rating">⭐ {{ m.rating }}</span>
                <span class="courses-count">▷ {{ m.courses }} courses</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features -->
    <section class="features-section">
      <div class="container features-inner">
        <div class="features-visual">
          <div class="vis-card vis-card--best">
            <span class="vis-icon">🏅</span>
            <span>BEST<br/>Mentors</span>
          </div>
          <div class="vis-photos">
            <div class="vis-photo ph1"></div>
            <div class="vis-photo ph2"></div>
          </div>
          <div class="vis-card vis-card--video">
            <span class="vis-icon">▶</span>
            <span>VIDEO<br/>Lessons</span>
          </div>
        </div>

        <div class="features-text">
          <h2>Start Learning —<br/>Get Real Results<br/>Today</h2>
          <p>Practical English and Math courses with clear explanations and fast progress. Study at your own pace with short video lessons and real practice. Everything is designed to help you improve grades and pass exams.</p>

          <div class="checklist">
            <div class="check-item"><span class="check-icon">✓</span> Step-by-step learning</div>
            <div class="check-item"><span class="check-icon">✓</span> Easy-to-understand lessons</div>
            <div class="check-item"><span class="check-icon">✓</span> Proven results</div>
            <div class="check-item"><span class="check-icon">✓</span> Learn anytime, anywhere</div>
          </div>

          <RouterLink to="/courses">
            <button class="btn-start">Start Learning</button>
          </RouterLink>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer" id="contact">
      <div class="container footer-inner">
        <RouterLink to="/" class="footer-logo">
          <img src="@/assets/logo.png" alt="Bridge" class="footer-logo-img" />
          <div class="footer-logo-text">
            <span>bridge</span>
            <small>kids</small>
          </div>
        </RouterLink>

        <nav class="footer-nav">
          <RouterLink to="/">Home</RouterLink>
          <span>Courses ▾</span>
          <RouterLink to="/about#contact">Contact</RouterLink>
          <RouterLink to="/dashboard">My Learning</RouterLink>
        </nav>

        <div class="footer-social">
          <a href="#" aria-label="YouTube">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2C0 8.1 0 12 0 12s0 3.9.5 5.8a3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1C24 15.9 24 12 24 12s0-3.9-.5-5.8zM9.8 15.5V8.5l6.2 3.5-6.2 3.5z"/>
            </svg>
          </a>
          <a href="#" aria-label="Instagram">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2.2c3.2 0 3.6 0 4.9.1 3.3.1 4.8 1.7 4.9 4.9.1 1.3.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 3.2-1.7 4.8-4.9 4.9-1.3.1-1.6.1-4.9.1s-3.6 0-4.8-.1c-3.3-.1-4.8-1.7-4.9-4.9C2.2 15.6 2.2 15.3 2.2 12s0-3.6.1-4.8C2.4 3.9 4 2.3 7.2 2.3c1.2-.1 1.6-.1 4.8-.1zM12 0C8.7 0 8.3 0 7.1.1 2.7.3.3 2.7.1 7.1.0 8.3 0 8.7 0 12s0 3.7.1 4.9c.2 4.4 2.6 6.8 7 7C8.3 24 8.7 24 12 24s3.7 0 4.9-.1c4.4-.2 6.8-2.6 7-7 .1-1.2.1-1.6.1-4.9s0-3.7-.1-4.9c-.2-4.4-2.6-6.8-7-7C15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4A6.2 6.2 0 0 0 12 5.8zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.8a1.4 1.4 0 1 0 0 2.9 1.4 1.4 0 0 0 0-2.9z"/>
            </svg>
          </a>
        </div>
      </div>
      <div class="footer-copy">202X. All rights reserved.</div>
    </footer>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
const showBar = ref(true)

const mentors = [
  { name: 'Colin Munro',    role: 'AI/ML Expert Mentor',  rating: 4.7, courses: 20, color: '#f59e0b' },
  { name: 'Adolf Stalin',   role: 'UX Specialist Mentor', rating: 4.7, courses: 20, color: '#ef4444' },
  { name: 'Sophie Johnson', role: 'Data Analyst Mentor',  rating: 4.7, courses: 20, color: '#3b82f6' },
  { name: 'John Braun',     role: 'Marketing Mentor',     rating: 4.7, courses: 20, color: '#10b981' },
]
</script>

<style scoped>
* { box-sizing: border-box; }

.home {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  background: #fff;
}

.container {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 2rem;
}

/* ── Announce bar ── */
.announce-bar {
  background: #fef9c3;
  text-align: center;
  padding: 0.5rem 1rem;
  font-size: 0.85rem;
  font-weight: 500;
  color: #78350f;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.bar-close {
  position: absolute;
  right: 1rem;
  background: none;
  border: none;
  font-size: 0.9rem;
  cursor: pointer;
  color: #78350f;
  padding: 0;
  line-height: 1;
}

/* ── Header ── */
.site-header {
  background: #fff;
  border-bottom: 1px solid #f0f0f0;
  position: sticky;
  top: 0;
  z-index: 100;
}

.hdr-inner {
  width: 100%;
  padding: 0 2.5rem;
  height: 56px;
  display: flex;
  align-items: center;
  gap: 2rem;
}

.site-logo {
  display: flex;
  align-items: center;
  text-decoration: none;
  flex-shrink: 0;
}

.logo-img { height: 28px; width: auto; }

.site-nav {
  display: flex;
  align-items: center;
  gap: 2rem;
  flex: 1;
  justify-content: center;
  font-size: 0.9rem;
}

.site-nav a, .nav-drop {
  color: #444;
  text-decoration: none;
  cursor: pointer;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.25rem;
  transition: color 0.15s;
}
.site-nav a:hover, .nav-drop:hover { color: #111; }

.hdr-actions {
  display: flex;
  gap: 0.75rem;
  align-items: center;
  margin-left: auto;
}

.btn-signup {
  border: 1.5px solid #e53030;
  background: transparent;
  color: #e53030;
  border-radius: 2rem;
  padding: 0.45rem 1.25rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.15s;
  font-family: inherit;
}
.btn-signup:hover { background: #e53030; color: #fff; }

.btn-login-hdr {
  background: #e53030;
  color: #fff;
  border: none;
  border-radius: 2rem;
  padding: 0.45rem 1.25rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.15s;
  font-family: inherit;
}
.btn-login-hdr:hover { background: #c72020; }

/* ── Hero ── */
.hero {
  position: relative;
  min-height: 520px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 5rem 2rem;
  background: #fff;
}

/* Floating avatars */
.avatar {
  position: absolute;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid #fff;
  box-shadow: 0 6px 24px rgba(0,0,0,.15);
  z-index: 1;
}
.avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.av1 { top: 20%;    left: 9%; }
.av2 { top: 16%;    right: 9%; }
.av3 { bottom: 20%; left: 13%; }
.av4 { bottom: 18%; right: 8%; }

/* Decorative */
.hero-deco { position: absolute; z-index: 1; font-size: 1.75rem; color: #f5c518; }
.diamond   { top: 40%;    left: 18%; }
.starburst { bottom: 28%; right: 14%; font-size: 1.25rem; }

.hero-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  gap: 2.5rem;
  position: relative;
  z-index: 2;
  max-width: 780px;
}

.hero-title {
  font-size: clamp(2.25rem, 5vw, 3.75rem);
  font-weight: 900;
  line-height: 1.15;
  color: #111;
  margin: 0;
}

.underlined {
  position: relative;
  display: inline-block;
  white-space: nowrap;
}

.underline-svg {
  position: absolute;
  left: 0;
  bottom: -14px;
  width: 100%;
  height: auto;
  display: block;
}

.btn-explore {
  background: #cce8f4;
  border: none;
  color: #4b7a8a;
  border-radius: 2rem;
  padding: 0.8rem 2.5rem;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.15s;
  font-family: inherit;
}
.btn-explore:hover { background: #b0d8ec; color: #2c5a6a; }

/* ── Space section ── */
.space-section {
  width: 100%;
  overflow: hidden;
}

.space-bg {
  width: 100%;
  height: auto;
  display: block;
}

/* ── Team ── */
.team-section {
  padding: 5rem 0;
  background: #fff;
  text-align: center;
}

.badge {
  display: inline-block;
  background: #f0fdf4;
  border: 1px solid #86efac;
  color: #16a34a;
  font-size: 0.8rem;
  font-weight: 600;
  border-radius: 2rem;
  padding: 0.25rem 1rem;
  margin-bottom: 1rem;
}

.sec-title {
  font-size: 2rem;
  font-weight: 800;
  color: #111;
  margin: 0 0 0.75rem;
}

.sec-sub {
  font-size: 0.9rem;
  color: #6b7280;
  max-width: 480px;
  margin: 0 auto 3rem;
  line-height: 1.7;
}

.mentors-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.25rem;
  max-width: 720px;
  margin: 0 auto;
}

.mentor-card {
  display: flex;
  align-items: center;
  gap: 1rem;
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 1rem;
  padding: 1.25rem;
  text-align: left;
}

.mentor-avatar {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3rem;
  font-weight: 700;
  color: #fff;
  flex-shrink: 0;
}

.mentor-info h3 {
  font-size: 0.95rem;
  font-weight: 700;
  margin: 0 0 0.2rem;
  color: #111;
}

.mentor-info p {
  font-size: 0.8rem;
  color: #6b7280;
  margin: 0 0 0.4rem;
}

.mentor-meta {
  display: flex;
  gap: 1rem;
  font-size: 0.78rem;
  color: #6b7280;
}

.rating { color: #f59e0b; font-weight: 600; }

/* ── Features ── */
.features-section {
  padding: 5rem 0;
  background: #fafafa;
  border-top: 1px solid #f0f0f0;
}

.features-inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 5rem;
  align-items: center;
}

.features-visual {
  position: relative;
  height: 340px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.vis-photos {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.75rem;
  z-index: 1;
}

.vis-photo {
  border-radius: 1rem;
  height: 160px;
  width: 130px;
}
.ph1 { background: linear-gradient(160deg, #fde68a 0%, #f59e0b 100%); }
.ph2 { background: linear-gradient(160deg, #c4b5fd 0%, #7c3aed 100%); }

.vis-card {
  position: absolute;
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 0.75rem;
  padding: 0.6rem 1rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.78rem;
  font-weight: 700;
  color: #111;
  box-shadow: 0 4px 16px rgba(0,0,0,.08);
  line-height: 1.3;
  z-index: 2;
}
.vis-card--best  { top: 16px;   left: 0; }
.vis-card--video { bottom: 16px; left: 24px; }
.vis-icon { font-size: 1.1rem; }

.features-text h2 {
  font-size: 2rem;
  font-weight: 900;
  color: #111;
  margin: 0 0 1.25rem;
  line-height: 1.25;
}

.features-text p {
  font-size: 0.9rem;
  color: #6b7280;
  line-height: 1.75;
  margin: 0 0 1.5rem;
}

.checklist {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.6rem 1.5rem;
  margin-bottom: 2rem;
}

.check-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: #374151;
}

.check-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 18px;
  height: 18px;
  border-radius: 50%;
  background: #dcfce7;
  color: #16a34a;
  font-weight: 700;
  font-size: 0.75rem;
  flex-shrink: 0;
}

.btn-start {
  background: #e53030;
  color: #fff;
  border: none;
  border-radius: 2rem;
  padding: 0.75rem 2rem;
  font-size: 0.95rem;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.15s;
  font-family: inherit;
}
.btn-start:hover { background: #c72020; }

/* ── Footer ── */
.site-footer {
  background: #fff;
  border-top: 1px solid #f0f0f0;
  padding: 2rem 0 0;
}

.footer-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-bottom: 1.5rem;
  gap: 2rem;
  flex-wrap: wrap;
}

.footer-logo {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  text-decoration: none;
  color: #111;
  flex-shrink: 0;
}

.footer-logo-img { height: 36px; width: auto; }

.footer-logo-text {
  display: flex;
  flex-direction: column;
  line-height: 1.1;
}
.footer-logo-text span {
  font-size: 1rem;
  font-weight: 800;
  color: #111;
}
.footer-logo-text small {
  font-size: 0.7rem;
  font-weight: 500;
  color: #888;
}

.footer-nav {
  display: flex;
  gap: 2rem;
  font-size: 0.875rem;
}

.footer-nav a, .footer-nav span {
  color: #444;
  text-decoration: none;
  cursor: pointer;
}
.footer-nav a:hover { color: #111; }

.footer-social { display: flex; gap: 1rem; }

.footer-social a {
  color: #6b7280;
  transition: color 0.15s;
}
.footer-social a:hover { color: #111; }

.footer-copy {
  text-align: center;
  font-size: 0.78rem;
  color: #9ca3af;
  padding: 1rem;
  border-top: 1px solid #f0f0f0;
}

/* ── Mobile ── */
@media (max-width: 768px) {
  .hdr-inner { padding: 0 1.25rem; }
  .site-nav { display: none; }
  .hero-title { font-size: 1.75rem; }
  .av1, .av2, .av3, .av4, .diamond, .starburst { display: none; }
  .mentors-grid { grid-template-columns: 1fr; max-width: 400px; }
  .features-inner { grid-template-columns: 1fr; gap: 2rem; }
  .features-visual { height: 220px; }
}
</style>
