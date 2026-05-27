<template>
  <div class="lms-wrap">

    <!-- ── Left Sidebar ─────────────────────────────────────── -->
    <aside class="lms-sidebar">
      <!-- <div class="sidebar-logo">
        <img src="@/assets/logo.png" alt="Bridge" class="sidebar-logo-img" />
      </div> -->

      <nav class="sidebar-nav">
        <RouterLink to="/dashboard" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#qv-home)">
              <path d="M6.56369 11.6129C5.96694 11.6129 5.37604 11.4954 4.82472 11.267C4.27339 11.0386 3.77245 10.7039 3.35049 10.282C2.92852 9.85999 2.5938 9.35905 2.36543 8.80773C2.13707 8.2564 2.01953 7.6655 2.01953 7.06875C2.01953 6.472 2.13707 5.8811 2.36543 5.32978C2.5938 4.77845 2.92852 4.27751 3.35049 3.85554C3.77245 3.43358 4.27339 3.09886 4.82472 2.87049C5.37604 2.64213 5.96694 2.52459 6.56369 2.52459C7.76888 2.52459 8.9247 3.00335 9.7769 3.85554C10.6291 4.70774 11.1079 5.86356 11.1079 7.06875C11.1079 8.27394 10.6291 9.42976 9.7769 10.282C8.9247 11.1342 7.76888 11.6129 6.56369 11.6129ZM7.0686 21.711C5.86341 21.711 4.70759 21.2323 3.85539 20.3801C3.0032 19.5279 2.52444 18.3721 2.52444 17.1669C2.52444 15.9617 3.0032 14.8059 3.85539 13.9537C4.70759 13.1015 5.86341 12.6227 7.0686 12.6227C8.27379 12.6227 9.42961 13.1015 10.2818 13.9537C11.134 14.8059 11.6128 15.9617 11.6128 17.1669C11.6128 18.3721 11.134 19.5279 10.2818 20.3801C9.42961 21.2323 8.27379 21.711 7.0686 21.711ZM17.1667 11.6129C16.57 11.6129 15.9791 11.4954 15.4278 11.267C14.8764 11.0386 14.3755 10.7039 13.9535 10.282C13.5316 9.85999 13.1968 9.35905 12.9685 8.80773C12.7401 8.2564 12.6226 7.6655 12.6226 7.06875C12.6226 6.472 12.7401 5.8811 12.9685 5.32978C13.1968 4.77845 13.5316 4.27751 13.9535 3.85554C14.3755 3.43358 14.8764 3.09886 15.4278 2.87049C15.9791 2.64213 16.57 2.52459 17.1667 2.52459C18.3719 2.52459 19.5277 3.00335 20.3799 3.85554C21.2321 4.70774 21.7109 5.86356 21.7109 7.06875C21.7109 8.27394 21.2321 9.42976 20.3799 10.282C19.5277 11.1342 18.3719 11.6129 17.1667 11.6129ZM17.1667 21.711C15.9615 21.711 14.8057 21.2323 13.9535 20.3801C13.1013 19.5279 12.6226 18.3721 12.6226 17.1669C12.6226 15.9617 13.1013 14.8059 13.9535 13.9537C14.8057 13.1015 15.9615 12.6227 17.1667 12.6227C18.3719 12.6227 19.5277 13.1015 20.3799 13.9537C21.2321 14.8059 21.7109 15.9617 21.7109 17.1669C21.7109 18.3721 21.2321 19.5279 20.3799 20.3801C19.5277 21.2323 18.3719 21.711 17.1667 21.711Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="qv-home"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
          </svg>
          <span>Home</span>
        </RouterLink>

        <RouterLink to="/student/progress" class="nav-item nav-item--active">
          <svg width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M6 13.127H2C1.73478 13.127 1.48043 13.2333 1.29289 13.4227C1.10536 13.6121 1 13.8689 1 14.1367V22.2148C1 22.4827 1.10536 22.7395 1.29289 22.9289C1.48043 23.1182 1.73478 23.2246 2 23.2246H6C6.26522 23.2246 6.51957 23.1182 6.70711 22.9289C6.89464 22.7395 7 22.4827 7 22.2148V14.1367C7 13.8689 6.89464 13.6121 6.70711 13.4227C6.51957 13.2333 6.26522 13.127 6 13.127ZM5 21.2051H3V15.1465H5V21.2051ZM22 9.08789H18C17.7348 9.08789 17.4804 9.19428 17.2929 9.38364C17.1054 9.57301 17 9.82985 17 10.0977V22.2148C17 22.4827 17.1054 22.7395 17.2929 22.9289C17.4804 23.1182 17.7348 23.2246 18 23.2246H22C22.2652 23.2246 22.5196 23.1182 22.7071 22.9289C22.8946 22.7395 23 22.4827 23 22.2148V10.0977C23 9.82985 22.8946 9.57301 22.7071 9.38364C22.5196 9.19428 22.2652 9.08789 22 9.08789ZM21 21.2051H19V11.1074H21V21.2051ZM14 1.00977H10C9.73478 1.00977 9.48043 1.11615 9.29289 1.30552C9.10536 1.49489 9 1.75172 9 2.01953V22.2148C9 22.4827 9.10536 22.7395 9.29289 22.9289C9.48043 23.1182 9.73478 23.2246 10 23.2246H14C14.2652 23.2246 14.5196 23.1182 14.7071 22.9289C14.8946 22.7395 15 22.4827 15 22.2148V2.01953C15 1.75172 14.8946 1.49489 14.7071 1.30552C14.5196 1.11615 14.2652 1.00977 14 1.00977ZM13 21.2051H11V3.0293H13V21.2051Z" fill="currentColor"/>
          </svg>
          <span>Progress</span>
        </RouterLink>

        <RouterLink to="/student/messages" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#qv-msg)">
              <path d="M7.36247 21.0283L3.18143 21.9576C2.64028 22.0779 2.15751 21.5951 2.27779 21.054L3.20708 16.8729C2.42502 15.4101 2.01705 13.7765 2.01954 12.1177C2.01954 6.54051 6.54048 2.01958 12.1177 2.01958C17.6949 2.01958 22.2158 6.54051 22.2158 12.1177C22.2158 17.6949 17.6949 22.2158 12.1177 22.2158C10.4589 22.2183 8.8253 21.8104 7.36247 21.0283ZM7.65531 18.8946L8.31472 19.248C9.48464 19.8732 10.7912 20.199 12.1177 20.1962C13.7155 20.1962 15.2774 19.7224 16.6059 18.8347C17.9344 17.9471 18.9698 16.6854 19.5812 15.2092C20.1927 13.7331 20.3527 12.1088 20.041 10.5417C19.7292 8.9746 18.9598 7.53514 17.83 6.40534C16.7002 5.27554 15.2608 4.50614 13.6937 4.19443C12.1266 3.88272 10.5023 4.0427 9.02617 4.65414C7.55001 5.26559 6.28832 6.30103 5.40064 7.62953C4.51297 8.95804 4.03917 10.5199 4.03917 12.1177C4.03917 13.4648 4.36736 14.7614 4.98839 15.9207L5.34082 16.5801L4.78269 19.0912C4.73458 19.3077 4.92768 19.5008 5.14414 19.4527L7.65531 18.8946Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="qv-msg"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
          </svg>
          <span>Messages</span>
        </RouterLink>

        <RouterLink to="/student/settings" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <path d="M21.5291 9.64366L19.6206 9.00747L20.5193 7.21001C20.6104 7.02186 20.6409 6.81008 20.6065 6.60389C20.5722 6.39769 20.4747 6.20724 20.3275 6.05882L18.1766 3.90792C18.0273 3.75855 17.8351 3.65971 17.6268 3.6253C17.4184 3.59088 17.2046 3.62262 17.0153 3.71605L15.2178 4.61479L14.5816 2.70624C14.5144 2.5073 14.3869 2.33425 14.2168 2.21118C14.0466 2.0881 13.8424 2.02112 13.6324 2.01957H10.6029C10.3912 2.01902 10.1847 2.08502 10.0126 2.20824C9.84044 2.33146 9.71137 2.50567 9.64363 2.70624L9.00744 4.61479L7.20998 3.71605C7.02183 3.62495 6.81005 3.59447 6.60386 3.62884C6.39766 3.66321 6.20721 3.76072 6.05879 3.90792L3.90789 6.05882C3.75852 6.20803 3.65968 6.40031 3.62527 6.60862C3.59085 6.81692 3.62259 7.03078 3.71602 7.22011L4.61476 9.01757L2.70621 9.65376C2.50727 9.72094 2.33422 9.84848 2.21114 10.0186C2.08807 10.1887 2.02109 10.393 2.01953 10.603V13.6324C2.01899 13.8441 2.08499 14.0506 2.20821 14.2228C2.33143 14.3949 2.50564 14.524 2.70621 14.5917L4.61476 15.2279L3.71602 17.0254C3.62492 17.2135 3.59444 17.4253 3.62881 17.6315C3.66318 17.8377 3.76069 18.0282 3.90789 18.1766L6.05879 20.3275C6.208 20.4769 6.40028 20.5757 6.60859 20.6101C6.81689 20.6445 7.03075 20.6128 7.22007 20.5194L9.01754 19.6206L9.65373 21.5292C9.72147 21.7297 9.85054 21.9039 10.0227 22.0272C10.1948 22.1504 10.4013 22.2164 10.613 22.2158H13.6425C13.8542 22.2164 14.0607 22.1504 14.2329 22.0272C14.405 21.9039 14.5341 21.7297 14.6018 21.5292L15.238 19.6206L17.0355 20.5194C17.2224 20.6082 17.4321 20.6374 17.6362 20.6031C17.8403 20.5687 18.0289 20.4725 18.1766 20.3275L20.3275 18.1766C20.4768 18.0274 20.5757 17.8351 20.6101 17.6268C20.6445 17.4185 20.6128 17.2046 20.5193 17.0153L19.6206 15.2178L21.5291 14.5816C21.7281 14.5145 21.9011 14.3869 22.0242 14.2168C22.1473 14.0467 22.2142 13.8424 22.2158 13.6324V10.603C22.2164 10.3913 22.1504 10.1848 22.0271 10.0126C21.9039 9.84047 21.7297 9.7114 21.5291 9.64366Z" fill="currentColor"/>
          </svg>
          <span>Settings</span>
        </RouterLink>
      </nav>

      <div class="support-card">
        <h4 class="support-title">Support 24/7</h4>
        <p class="support-sub">Contacts us anytime</p>
        <a class="support-btn" href="https://wa.me/87766253784" target="_blank" rel="noopener">Start</a>
        <div class="support-art">
          <svg width="110" height="80" viewBox="0 0 110 80" fill="none">
            <ellipse cx="60" cy="74" rx="36" ry="5" fill="#f9c6c6" opacity="0.5"/>
            <rect x="22" y="52" width="76" height="6" rx="3" fill="#e57373"/>
            <rect x="30" y="58" width="6" height="16" rx="2" fill="#c62828"/>
            <rect x="82" y="58" width="6" height="16" rx="2" fill="#c62828"/>
            <rect x="48" y="28" width="34" height="24" rx="3" fill="#1e293b"/>
            <rect x="51" y="31" width="28" height="18" rx="2" fill="#3b82f6" opacity="0.8"/>
            <rect x="62" y="52" width="10" height="4" fill="#1e293b"/>
            <rect x="58" y="55" width="18" height="2" rx="1" fill="#1e293b"/>
            <rect x="14" y="35" width="10" height="22" rx="5" fill="#b91c1c"/>
            <rect x="20" y="46" width="18" height="14" rx="4" fill="#7f1d1d"/>
            <circle cx="29" cy="38" r="8" fill="#fcd5b0"/>
            <path d="M21 36 Q29 28 37 36" fill="#1e293b"/>
            <path d="M20 52 Q16 56 20 60" stroke="#fcd5b0" stroke-width="4" stroke-linecap="round"/>
            <path d="M38 52 Q44 54 48 50" stroke="#fcd5b0" stroke-width="4" stroke-linecap="round"/>
            <rect x="42" y="50" width="14" height="3" rx="1" fill="#94a3b8"/>
          </svg>
        </div>
      </div>
    </aside>

    <!-- ── Main Panel ─────────────────────────────────────────── -->
    <div class="lms-main">

      <!-- Topbar -->
      <div class="topbar">
        <div class="search-wrap">
          <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none">
            <circle cx="11" cy="11" r="7" stroke="#9ca3af" stroke-width="2"/>
            <path d="M16.5 16.5L21 21" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <input class="search-input" type="text" placeholder="Search..." />
        </div>
        <div class="topbar-right">
          <button class="topbar-icon-btn">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
              <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="#6b7280" stroke-width="2" stroke-linecap="round"/>
              <circle cx="12" cy="7" r="4" stroke="#6b7280" stroke-width="2"/>
            </svg>
          </button>
          <button class="topbar-avatar-btn">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
              <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="white" stroke-width="2" stroke-linecap="round"/>
              <circle cx="12" cy="7" r="4" stroke="white" stroke-width="2"/>
            </svg>
          </button>
        </div>
      </div>

      <!-- ── Loading / Error ──────────────────────────────────── -->
      <div v-if="loading" style="flex:1;display:flex;align-items:center;justify-content:center;">
        <div style="width:36px;height:36px;border:3px solid #e5e7eb;border-top-color:#7f1d1d;border-radius:50%;animation:spin 0.7s linear infinite;"></div>
      </div>
      <div v-else-if="loadError" style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;color:#6b7280;">
        <svg width="40" height="40" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#d1d5db" stroke-width="1.5"/><path d="M12 8v4M12 16h.01" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/></svg>
        <p style="font-size:.95rem;font-weight:500;">{{ loadError }}</p>
      </div>

      <!-- ── Quiz in progress ───────────────────────────────── -->
      <template v-else-if="!finished">
        <!-- Timer bar -->
        <div class="timer-bar">
          <div class="timer-left">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="timer-icon">
              <circle cx="12" cy="12" r="9" stroke="#7f1d1d" stroke-width="2"/>
              <path d="M12 7v5l3 3" stroke="#7f1d1d" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="timer-label">Time Remaining:&nbsp;</span>
            <span class="timer-value" :class="{ 'timer-value--warn': timeLeft < 120 }">{{ formattedTime }}</span>
          </div>
          <div class="timer-right">
            <span class="module-name">{{ moduleLabel }}</span>
            <button class="pause-btn" @click="togglePause" :title="paused ? 'Resume' : 'Pause'">
              <svg v-if="!paused" width="16" height="16" viewBox="0 0 24 24" fill="none">
                <rect x="6" y="4" width="4" height="16" rx="1" fill="#374151"/>
                <rect x="14" y="4" width="4" height="16" rx="1" fill="#374151"/>
              </svg>
              <svg v-else width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M8 5l11 7-11 7V5z" fill="#374151"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Quiz Card -->
        <div class="quiz-wrap">
          <div class="quiz-card">
            <p class="q-counter">QUESTION {{ currentIndex + 1 }} OF {{ questions.length }}</p>
            <h2 class="q-text">{{ currentQuestion.text }}</h2>

            <div class="options-list">
              <label
                v-for="(opt, oi) in currentQuestion.options"
                :key="oi"
                class="option-row"
                :class="{ 'option-row--selected': answers[currentIndex] === oi }"
              >
                <input
                  type="radio"
                  class="option-radio"
                  :name="'q' + currentIndex"
                  :value="oi"
                  :checked="answers[currentIndex] === oi"
                  @change="selectAnswer(oi)"
                />
                <span class="option-text">{{ opt }}</span>
              </label>
            </div>

            <div class="quiz-nav">
              <button class="nav-prev" :disabled="currentIndex === 0" @click="prev">← Previous</button>
              <button class="nav-finish" @click="finishTest">Finish Test</button>
              <button class="nav-next" :disabled="currentIndex === questions.length - 1" @click="next">Next →</button>
            </div>
          </div>

          <div class="tip-bar" v-if="currentQuestion.tip">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="tip-icon">
              <circle cx="12" cy="12" r="9" stroke="#7f1d1d" stroke-width="2"/>
              <path d="M12 8v4" stroke="#7f1d1d" stroke-width="2" stroke-linecap="round"/>
              <circle cx="12" cy="16" r="1" fill="#7f1d1d"/>
            </svg>
            <span class="tip-label">Tip:&nbsp;</span>
            <span class="tip-text">{{ currentQuestion.tip }}</span>
          </div>
        </div>
      </template>

      <!-- ── Results screen ──────────────────────────────────── -->
      <div v-else-if="finished && !reviewMode" class="results-wrap">
        <div class="results-header">
          <h2 class="results-title">Assessment Complete</h2>
          <p class="results-sub">Well done! You've mastered this module.</p>
        </div>

        <div class="results-body">
          <!-- Left: score circle -->
          <div class="score-card">
            <div class="score-circle-wrap">
              <svg width="220" height="220" viewBox="0 0 220 220">
                <!-- track -->
                <circle cx="110" cy="110" r="90" fill="none" stroke="#e5e7eb" stroke-width="14"/>
                <!-- progress -->
                <circle
                  cx="110" cy="110" r="90" fill="none"
                  stroke="#22c55e" stroke-width="14"
                  stroke-linecap="round"
                  :stroke-dasharray="circumference"
                  :stroke-dashoffset="dashOffset"
                  transform="rotate(-90 110 110)"
                  style="transition: stroke-dashoffset 1s ease"
                />
              </svg>
              <div class="score-inner">
                <span class="score-pct">{{ scorePct }}%</span>
                <span class="score-frac">{{ score }} / {{ questions.length }} correct</span>
              </div>
            </div>

            <div class="score-actions">
              <button class="btn-review" @click="reviewAnswers">Review Answers</button>
              <RouterLink :to="`/courses/${courseId}`" class="btn-back-course">Back to Course</RouterLink>
            </div>
          </div>

          <!-- Right: metrics + next chapter -->
          <div class="metrics-col">
            <div class="metrics-card">
              <h3 class="metrics-title">Performance Metrics</h3>

              <div class="metric-row">
                <div class="metric-icon-wrap">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="9" stroke="#6b7280" stroke-width="1.8"/>
                    <path d="M12 7v5l3 3" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round"/>
                  </svg>
                </div>
                <span class="metric-label">Time Spent</span>
                <span class="metric-value">{{ formattedTimeSpent }}</span>
              </div>

              <div class="metric-row">
                <div class="metric-icon-wrap">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="9" stroke="#6b7280" stroke-width="1.8"/>
                    <path d="M9 12l2 2 4-4" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
                <span class="metric-label">Accuracy</span>
                <span class="metric-value">{{ scorePct }}%</span>
              </div>

              <div class="metric-row">
                <div class="metric-icon-wrap">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <polyline points="3 17 9 11 13 15 21 7" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
                <span class="metric-label">Performance</span>
                <span class="perf-badge" :class="perfClass">{{ perfLabel }}</span>
              </div>
            </div>

            <div class="next-card">
              <p class="next-label">Next Chapter</p>
              <p class="next-name">{{ nextChapterName }}</p>
              <RouterLink :to="`/courses/${courseId}`" class="next-link">Continue Learning →</RouterLink>
            </div>
          </div>
        </div>

      </div>

      <!-- ── Review screen ───────────────────────────────────── -->
      <div v-else-if="finished && reviewMode" class="rv-wrap">

        <!-- Left: navigator -->
        <div class="rv-left">
          <nav class="rv-breadcrumb">
            <span>Courses</span>
            <span class="rv-bc-sep">›</span>
            <span>{{ moduleLabel }}</span>
            <span class="rv-bc-sep">›</span>
            <span class="rv-bc-active">Results</span>
          </nav>

          <h2 class="rv-title">Review: {{ moduleLabel }}</h2>

          <div class="rv-score-bar">
            <div class="rv-score-item">
              <span class="rv-score-label">SCORE</span>
              <span class="rv-score-val">{{ scorePct }}/100</span>
            </div>
            <div class="rv-score-divider"></div>
            <div class="rv-score-item">
              <span class="rv-score-label">TIME SPENT</span>
              <span class="rv-score-val">{{ formattedTimeSpent }}</span>
            </div>
          </div>

          <p class="rv-nav-label">Question Navigator</p>
          <div class="rv-nav-list">
            <button
              v-for="(q, qi) in visibleNavQuestions"
              :key="qi"
              class="rv-nav-item"
              :class="{ 'rv-nav-item--active': reviewIndex === qi }"
              @click="reviewIndex = qi"
            >
              <span class="rv-nav-num">{{ String(qi + 1).padStart(2, '0') }}</span>
              <span class="rv-nav-text">{{ q.text.slice(0, 26) }}…</span>
              <span v-if="answers[qi] === q.correct" class="rv-nav-icon rv-nav-icon--ok">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="12" r="10" fill="#22c55e"/>
                  <path d="M8 12l3 3 5-5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <span v-else class="rv-nav-icon rv-nav-icon--err">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="12" r="10" fill="#ef4444"/>
                  <path d="M9 9l6 6M15 9l-6 6" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </span>
            </button>
          </div>

          <button v-if="!showAllNav" class="rv-view-all" @click="showAllNav = true">
            View all {{ questions.length }} questions
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#7f1d1d" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
        </div>

        <!-- Right: question detail -->
        <div class="rv-right">
          <div class="rv-q-card">

            <!-- Header -->
            <div class="rv-q-head">
              <span class="rv-q-num">Question {{ String(reviewIndex + 1).padStart(2, '0') }}</span>
              <span v-if="answers[reviewIndex] === questions[reviewIndex].correct" class="rv-q-badge rv-q-badge--ok">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="12" r="10" fill="#22c55e"/>
                  <path d="M8 12l3 3 5-5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Correct
              </span>
              <span v-else class="rv-q-badge rv-q-badge--err">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="12" r="10" fill="#ef4444"/>
                  <path d="M9 9l6 6M15 9l-6 6" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Incorrect
              </span>
            </div>

            <p class="rv-q-text">{{ questions[reviewIndex].text }}</p>

            <!-- Options -->
            <div class="rv-options">
              <div
                v-for="(opt, oi) in questions[reviewIndex].options"
                :key="oi"
                class="rv-opt"
                :class="{
                  'rv-opt--answer-correct': answers[reviewIndex] === oi && oi === questions[reviewIndex].correct,
                  'rv-opt--answer-wrong':   answers[reviewIndex] === oi && oi !== questions[reviewIndex].correct,
                  'rv-opt--correct-only':   answers[reviewIndex] !== oi && oi === questions[reviewIndex].correct,
                }"
              >
                <span class="rv-opt-letter">{{ String.fromCharCode(65 + oi) }}</span>
                <div class="rv-opt-body">
                  <span class="rv-opt-text">{{ opt }}</span>
                  <div v-if="answers[reviewIndex] === oi || oi === questions[reviewIndex].correct" class="rv-opt-tags">
                    <span v-if="answers[reviewIndex] === oi" class="rv-tag rv-tag--your">YOUR ANSWER</span>
                    <span v-if="oi === questions[reviewIndex].correct" class="rv-tag rv-tag--correct">CORRECT</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- AI Explanation -->
            <div class="rv-ai-box">
              <div class="rv-ai-head">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z" fill="#7f1d1d"/>
                </svg>
                <span class="rv-ai-label">BRIDGE AI EXPLANATION</span>
              </div>

              <!-- Loading -->
              <div v-if="explanationLoading && explanations[reviewIndex] === undefined" class="rv-ai-loading">
                <div class="rv-ai-spinner"></div>
                <span>Generating explanation…</span>
              </div>

              <!-- Explanation text -->
              <p v-else class="rv-ai-text">{{ explanations[reviewIndex] || '—' }}</p>

              <div class="rv-ai-actions">
                <button class="rv-ai-btn">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3H14z" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round"/>
                  </svg>
                  Helpful
                </button>
                <button class="rv-ai-btn" @click="fetchExplanation(reviewIndex, true)">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M1 4v6h6M23 20v-6h-6" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M20.49 9A9 9 0 005.64 5.64L1 10M23 14l-4.64 4.36A9 9 0 013.51 15" stroke="#6b7280" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  Retry
                </button>
              </div>
            </div>

            <!-- Navigation -->
            <div class="rv-q-nav">
              <button class="rv-q-nav-btn" :disabled="reviewIndex === 0" @click="reviewIndex--">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Previous Question
              </button>
              <button class="rv-q-nav-btn rv-q-nav-btn--next" :disabled="reviewIndex === questions.length - 1" @click="reviewIndex++">
                Next Question
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                  <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'
import { homeworkApi, aiApi } from '@/api'

const route = useRoute()

const moduleLabel     = computed(() => String(route.query.module || 'QUIZ').toUpperCase())
const courseId        = computed(() => route.query.courseId || '')
const nextChapterName = computed(() => route.query.next || 'Continue Learning')

// ── Loading state ──────────────────────────────────────────
const loading   = ref(true)
const loadError = ref('')

// ── Questions (populated from API) ────────────────────────
const questions = ref([])  // { id, text, options[], optionIds[], correct, tip, explanation }

const currentIndex = ref(0)
const answers      = ref([])   // selected option index per question
const finished     = ref(false)
const submitting   = ref(false)
const paused       = ref(false)

const currentQuestion = computed(() =>
  questions.value[currentIndex.value] || { text: '', options: [], correct: null, tip: '', explanation: '' }
)

const score = computed(() =>
  answers.value.reduce((acc, ans, i) => {
    const q = questions.value[i]
    return acc + (q && q.correct !== null && ans === q.correct ? 1 : 0)
  }, 0)
)

const scorePct = computed(() =>
  questions.value.length > 0 ? Math.round(score.value / questions.value.length * 100) : 0
)

const RADIUS        = 90
const circumference = 2 * Math.PI * RADIUS
const dashOffset    = computed(() => circumference * (1 - scorePct.value / 100))

const perfLabel = computed(() => {
  if (scorePct.value >= 85) return 'Above Average'
  if (scorePct.value >= 70) return 'Good'
  if (scorePct.value >= 50) return 'Average'
  return 'Below Average'
})
const perfClass = computed(() => {
  if (scorePct.value >= 85) return 'perf-badge--green'
  if (scorePct.value >= 70) return 'perf-badge--blue'
  if (scorePct.value >= 50) return 'perf-badge--yellow'
  return 'perf-badge--red'
})

const timeSpentSeconds   = ref(0)
const formattedTimeSpent = computed(() => {
  const m = Math.floor(timeSpentSeconds.value / 60)
  const s = timeSpentSeconds.value % 60
  return `${m}m ${String(s).padStart(2, '0')}s`
})

const reviewMode  = ref(false)
const reviewIndex = ref(0)
const showAllNav  = ref(false)

const visibleNavQuestions = computed(() =>
  showAllNav.value ? questions.value : questions.value.slice(0, 5)
)

// AI explanations: cached per question index
const explanations     = ref({})   // { [index]: string }
const explanationLoading = ref(false)
let lessonId = 0

async function fetchExplanation(index, force = false) {
  if (!force && explanations.value[index] !== undefined) return
  const q = questions.value[index]
  if (!q) return

  explanationLoading.value = true
  const letters = ['A', 'B', 'C', 'D']
  const correctLetter = letters[q.correct] ?? '?'
  const correctText   = q.options[q.correct] ?? ''
  const optionsList   = q.options.map((o, i) => `${letters[i]}) ${o}`).join(', ')

  const prompt = `Quiz question: "${q.question_text ?? q.text}"
Options: ${optionsList}
Correct answer: ${correctLetter}) ${correctText}

In 2-3 sentences explain why this is the correct answer.`

  try {
    const res = await aiApi.chat({ message: prompt, lesson_id: lessonId || undefined, history: [] })
    explanations.value = { ...explanations.value, [index]: res.data.data.reply }
  } catch {
    explanations.value = { ...explanations.value, [index]: 'Could not load explanation.' }
  } finally {
    explanationLoading.value = false
  }
}

watch([reviewMode, reviewIndex], ([mode, idx]) => {
  if (mode) fetchExplanation(idx)
})

function reviewAnswers() {
  reviewIndex.value = 0
  reviewMode.value  = true
}

// ── Timer ──────────────────────────────────────────────────
const TOTAL_SECONDS = 15 * 60
const timeLeft      = ref(TOTAL_SECONDS)
let   timerHandle   = null

const formattedTime = computed(() => {
  const m = Math.floor(timeLeft.value / 60)
  const s = timeLeft.value % 60
  return `${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`
})

function startTimer() {
  timerHandle = setInterval(() => {
    if (!paused.value && timeLeft.value > 0) {
      timeLeft.value--
    } else if (timeLeft.value === 0) {
      finishTest()
    }
  }, 1000)
}

function togglePause() { paused.value = !paused.value }

// ── Navigation ─────────────────────────────────────────────
function selectAnswer(oi) { answers.value[currentIndex.value] = oi }
function prev() { if (currentIndex.value > 0) currentIndex.value-- }
function next() { if (currentIndex.value < questions.value.length - 1) currentIndex.value++ }

// ── Apply correct_options from submit response ─────────────
function applyCorrectOptions(correctOptions) {
  questions.value.forEach(q => {
    const correctOptId = correctOptions[q.id] ?? correctOptions[String(q.id)]
    if (correctOptId !== undefined) {
      q.correct = q.optionIds.indexOf(Number(correctOptId))
    }
  })
}

// ── Load from API ──────────────────────────────────────────
onMounted(async () => {
  const hwId = Number(route.params.id)
  if (!hwId) {
    loadError.value = 'Invalid quiz ID.'
    loading.value = false
    return
  }

  try {
    const res = await homeworkApi.get(hwId)
    const hw  = res.data.data
    lessonId  = hw.lesson_id || 0

    questions.value = (hw.questions || []).map(q => {
      const opts = q.options || []
      const correctIdx = opts.findIndex(o => o.is_correct === true || o.is_correct === 'true' || o.is_correct === 1)
      return {
        id:          q.id,
        text:        q.question_text,
        options:     opts.map(o => o.option_text),
        optionIds:   opts.map(o => Number(o.id)),
        correct:     correctIdx >= 0 ? correctIdx : null,
        tip:         '',
        explanation: '',
      }
    })

    answers.value = Array(questions.value.length).fill(null)

    if (!questions.value.length) {
      loadError.value = 'This quiz has no questions yet.'
    }
  } catch {
    loadError.value = 'Failed to load quiz. Please try again.'
  } finally {
    loading.value = false
    startTimer()
  }
})

onUnmounted(() => clearInterval(timerHandle))

// ── Finish & submit ────────────────────────────────────────
async function finishTest() {
  if (submitting.value) return
  timeSpentSeconds.value = TOTAL_SECONDS - timeLeft.value
  clearInterval(timerHandle)
  submitting.value = true

  const payload = questions.value
    .map((q, i) => ({
      question_id:        q.id,
      selected_option_id: answers.value[i] !== null ? q.optionIds[answers.value[i]] : null,
    }))
    .filter(a => a.selected_option_id !== null)

  try {
    const res = await homeworkApi.submit(Number(route.params.id), { answers: payload })
    applyCorrectOptions(res.data.data?.correct_options || {})
  } catch (e) {
    if (e.response?.status === 409) {
      // Already submitted — correct answers were loaded at mount time from is_correct flags
    } else {
      console.error('Submit error:', e)
    }
  } finally {
    submitting.value = false
    finished.value   = true
  }
}
</script>

<style scoped>
/* ── Layout ────────────────────────────────────────────────── */
.lms-wrap  { display: flex; height: 100vh; background: #7f1d1d; overflow: hidden; }
@keyframes spin { to { transform: rotate(360deg); } }

/* ── Sidebar ───────────────────────────────────────────────── */
.lms-sidebar {
  width: 220px; flex-shrink: 0; display: flex; flex-direction: column;
  padding: 28px 16px 24px; gap: 0; overflow-y: auto;
}
.sidebar-logo     { margin-bottom: 32px; display: flex; align-items: center; }
.sidebar-logo-img { height: 38px; object-fit: contain; }
.sidebar-nav      { display: flex; flex-direction: column; gap: 4px; flex: 1; }
.nav-item {
  display: flex; align-items: center; gap: 12px; padding: 11px 14px;
  border-radius: 12px; color: rgba(255,255,255,.65); text-decoration: none;
  font-size: .88rem; font-weight: 500; transition: background .15s, color .15s;
}
.nav-item:hover       { background: rgba(255,255,255,.1); color: #fff; }
.nav-item--active     { background: rgba(255,255,255,.18); color: #fff; font-weight: 600; }
.support-card {
  background: #fff; border-radius: 16px; padding: 16px 14px 0;
  margin-top: 20px; overflow: hidden; position: relative;
}
.support-title { font-size: .88rem; font-weight: 700; color: #111; margin: 0 0 2px; }
.support-sub   { font-size: .72rem; color: #6b7280; margin: 0 0 10px; }
.support-btn   {
  display: inline-block; background: #7f1d1d; color: #fff;
  font-size: .75rem; font-weight: 600; padding: 6px 16px;
  border-radius: 8px; text-decoration: none;
}
.support-art { margin-top: 8px; display: flex; justify-content: flex-end; }

/* ── Main ──────────────────────────────────────────────────── */
.lms-main {
  flex: 1; display: flex; flex-direction: column;
  background: #fff; border-radius: 24px 0 0 24px;
  overflow-y: auto; min-width: 0;
}

/* ── Topbar ────────────────────────────────────────────────── */
.topbar {
  display: flex; align-items: center; gap: 14px;
  padding: 18px 28px 0; flex-shrink: 0;
}
.search-wrap {
  flex: 1; display: flex; align-items: center; gap: 10px;
  background: #fff; border-radius: 12px; padding: 10px 16px;
  box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.search-icon  { flex-shrink: 0; }
.search-input { border: none; outline: none; font-size: .9rem; color: #374151; width: 100%; background: transparent; }
.topbar-right { display: flex; align-items: center; gap: 8px; }
.topbar-icon-btn {
  width: 42px; height: 42px; border-radius: 50%; border: none;
  background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center;
  box-shadow: 0 1px 4px rgba(0,0,0,.07);
}
.topbar-avatar-btn {
  width: 42px; height: 42px; border-radius: 50%; border: none;
  background: #7f1d1d; cursor: pointer; display: flex; align-items: center; justify-content: center;
}

/* ── Timer Bar ─────────────────────────────────────────────── */
.timer-bar {
  display: flex; align-items: center; justify-content: space-between;
  background: #fff; border-radius: 12px; padding: 12px 20px;
  margin: 16px 28px 0; box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.timer-left  { display: flex; align-items: center; gap: 7px; }
.timer-icon  { flex-shrink: 0; }
.timer-label { font-size: .88rem; color: #374151; font-weight: 500; }
.timer-value { font-size: .95rem; font-weight: 700; color: #7f1d1d; }
.timer-value--warn { color: #dc2626; animation: pulse-red 1s infinite; }
@keyframes pulse-red { 0%,100% { opacity:1 } 50% { opacity:.5 } }
.timer-right { display: flex; align-items: center; gap: 12px; }
.module-name { font-size: .78rem; font-weight: 700; color: #374151; letter-spacing: .04em; }
.pause-btn {
  width: 32px; height: 32px; border-radius: 50%; border: 1.5px solid #d1d5db;
  background: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center;
  transition: background .15s;
}
.pause-btn:hover { background: #f3f4f6; }

/* ── Quiz Wrap ─────────────────────────────────────────────── */
.quiz-wrap {
  padding: 16px 28px 32px; display: flex; flex-direction: column; gap: 14px;
}

/* ── Quiz Card ─────────────────────────────────────────────── */
.quiz-card {
  background: #fff; border-radius: 16px;
  padding: 32px 32px 24px; box-shadow: 0 1px 6px rgba(0,0,0,.07);
}
.q-counter {
  font-size: .72rem; font-weight: 700; color: #7f1d1d;
  letter-spacing: .08em; margin: 0 0 14px;
}
.q-text {
  font-size: 1.22rem; font-weight: 700; color: #111827;
  line-height: 1.4; margin: 0 0 28px;
}

/* ── Options ───────────────────────────────────────────────── */
.options-list { display: flex; flex-direction: column; gap: 0; }
.option-row {
  display: flex; align-items: center; gap: 14px;
  padding: 14px 18px; border-bottom: 1px solid #f3f4f6;
  cursor: pointer; transition: background .12s;
}
.option-row:first-child { border-top: 1px solid #f3f4f6; }
.option-row:hover { background: #fafafa; }
.option-row--selected { background: #eff6ff; border-left: 3px solid #3b82f6; padding-left: 15px; }
.option-row--correct  { background: #f0fdf4; }
.option-row--wrong    { background: #fef2f2; }
.option-radio {
  width: 18px; height: 18px; flex-shrink: 0;
  accent-color: #3b82f6; cursor: pointer;
}
.option-text { font-size: .9rem; color: #374151; line-height: 1.5; }

/* ── Quiz Nav ──────────────────────────────────────────────── */
.quiz-nav {
  display: flex; align-items: center; justify-content: space-between;
  padding-top: 28px; margin-top: 8px;
}
.nav-prev {
  background: none; border: none; font-size: .88rem; font-weight: 600;
  color: #374151; cursor: pointer; padding: 0;
}
.nav-prev:disabled { color: #d1d5db; cursor: default; }
.nav-finish {
  background: #fff; border: 1.5px solid #7f1d1d; color: #7f1d1d;
  font-size: .88rem; font-weight: 600; padding: 10px 22px;
  border-radius: 10px; cursor: pointer; transition: background .12s;
}
.nav-finish:hover { background: #fef2f2; }
.nav-next {
  background: #7f1d1d; border: none; color: #fff;
  font-size: .88rem; font-weight: 600; padding: 10px 22px;
  border-radius: 10px; cursor: pointer; transition: background .12s;
}
.nav-next:hover    { background: #6b1717; }
.nav-next:disabled { background: #d1d5db; cursor: default; }

/* ── Tip Bar ───────────────────────────────────────────────── */
.tip-bar {
  display: flex; align-items: center; gap: 8px;
  background: #f9fafb; border-radius: 12px; padding: 13px 18px;
  box-shadow: 0 1px 4px rgba(0,0,0,.04);
}
.tip-icon  { flex-shrink: 0; }
.tip-label { font-size: .83rem; font-weight: 700; color: #7f1d1d; }
.tip-text  { font-size: .83rem; color: #6b7280; }

/* ── Results Screen ────────────────────────────────────────── */
.results-wrap    { padding: 28px 28px 40px; display: flex; flex-direction: column; gap: 24px; }
.results-header  { text-align: center; }
.results-title   { font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0 0 6px; }
.results-sub     { font-size: .9rem; color: #6b7280; margin: 0; }

.results-body    { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }

/* Score card */
.score-card {
  background: #fff; border-radius: 16px; padding: 36px 28px 28px;
  box-shadow: 0 1px 6px rgba(0,0,0,.07);
  display: flex; flex-direction: column; align-items: center; gap: 28px;
}
.score-circle-wrap { position: relative; width: 220px; height: 220px; }
.score-circle-wrap svg { position: absolute; top: 0; left: 0; }
.score-inner {
  position: absolute; inset: 0;
  display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px;
}
.score-pct  { font-size: 2.4rem; font-weight: 800; color: #16a34a; }
.score-frac { font-size: .82rem; color: #6b7280; }
.score-actions { display: flex; gap: 12px; }
.btn-review {
  background: #fff; border: 1.5px solid #22c55e; color: #16a34a;
  font-size: .88rem; font-weight: 600; padding: 10px 22px;
  border-radius: 10px; cursor: pointer; transition: background .12s;
}
.btn-review:hover { background: #f0fdf4; }
.btn-back-course {
  background: #38bdf8; border: none; color: #fff; text-decoration: none;
  font-size: .88rem; font-weight: 600; padding: 10px 22px;
  border-radius: 10px; display: inline-flex; align-items: center;
  transition: background .12s;
}
.btn-back-course:hover { background: #0ea5e9; }

/* Metrics card */
.metrics-col  { display: flex; flex-direction: column; gap: 16px; }
.metrics-card {
  background: #fff; border-radius: 16px; padding: 22px 22px 18px;
  box-shadow: 0 1px 6px rgba(0,0,0,.07);
}
.metrics-title { font-size: .95rem; font-weight: 700; color: #111827; margin: 0 0 18px; }
.metric-row    { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
.metric-row:last-child { border-bottom: none; }
.metric-icon-wrap { width: 20px; flex-shrink: 0; color: #6b7280; }
.metric-label  { font-size: .85rem; color: #6b7280; flex: 1; }
.metric-value  { font-size: .9rem; font-weight: 700; color: #111827; }
.perf-badge    { font-size: .75rem; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
.perf-badge--green  { background: #dcfce7; color: #16a34a; }
.perf-badge--blue   { background: #dbeafe; color: #2563eb; }
.perf-badge--yellow { background: #fef9c3; color: #ca8a04; }
.perf-badge--red    { background: #fee2e2; color: #dc2626; }

/* Next chapter card */
.next-card {
  background: linear-gradient(135deg, #38bdf8 0%, #60a5fa 100%);
  border-radius: 16px; padding: 22px 22px 20px;
  display: flex; flex-direction: column; gap: 8px;
}
.next-label { font-size: .78rem; font-weight: 700; color: rgba(255,255,255,.8); margin: 0; letter-spacing: .04em; }
.next-name  { font-size: .9rem; color: #fff; font-weight: 500; margin: 0; line-height: 1.4; }
.next-link  { font-size: .85rem; color: #fff; text-decoration: none; font-weight: 600; margin-top: 4px; }
.next-link:hover { text-decoration: underline; }

/* ── Review layout ─────────────────────────────────────────── */
.rv-wrap {
  flex: 1; display: grid; grid-template-columns: 300px 1fr;
  overflow: hidden; min-height: 0;
}

/* Left panel */
.rv-left {
  padding: 28px 20px 28px 28px; overflow-y: auto;
  border-right: 1px solid #f3f4f6; display: flex; flex-direction: column; gap: 16px;
}
.rv-breadcrumb { display: flex; align-items: center; gap: 6px; font-size: .75rem; color: #9ca3af; }
.rv-bc-sep     { color: #d1d5db; }
.rv-bc-active  { color: #7f1d1d; font-weight: 600; }
.rv-title      { font-size: 1.1rem; font-weight: 800; color: #111827; margin: 0; line-height: 1.3; }
.rv-score-bar  {
  display: flex; align-items: center; border: 1px solid #e5e7eb;
  border-radius: 10px; overflow: hidden;
}
.rv-score-item   { flex: 1; padding: 10px 14px; }
.rv-score-label  { display: block; font-size: .65rem; font-weight: 700; color: #9ca3af; letter-spacing: .06em; margin-bottom: 2px; }
.rv-score-val    { font-size: .95rem; font-weight: 800; color: #111827; }
.rv-score-divider { width: 1px; background: #e5e7eb; align-self: stretch; }
.rv-nav-label    { font-size: .75rem; font-weight: 700; color: #374151; margin: 0; letter-spacing: .04em; }
.rv-nav-list     { display: flex; flex-direction: column; gap: 6px; }
.rv-nav-item {
  display: flex; align-items: center; gap: 10px; padding: 10px 12px;
  border: 1px solid #e5e7eb; border-radius: 10px; background: #fff;
  cursor: pointer; text-align: left; transition: border-color .15s, background .15s;
}
.rv-nav-item:hover        { border-color: #7f1d1d; background: #fef2f2; }
.rv-nav-item--active      { border-color: #7f1d1d; background: #fff7f7; }
.rv-nav-num  { font-size: .72rem; font-weight: 700; color: #6b7280; width: 22px; flex-shrink: 0; }
.rv-nav-text { flex: 1; font-size: .8rem; color: #374151; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.rv-nav-icon { flex-shrink: 0; display: flex; }
.rv-view-all {
  background: none; border: none; color: #7f1d1d; font-size: .82rem; font-weight: 600;
  cursor: pointer; display: flex; align-items: center; gap: 4px; padding: 0;
}

/* Right panel */
.rv-right  { overflow-y: auto; padding: 28px 28px 28px 24px; }
.rv-q-card { background: #fff; border-radius: 16px; border: 1px solid #e5e7eb; padding: 26px 24px 20px; }

.rv-q-head  { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; }
.rv-q-num   { font-size: .78rem; font-weight: 700; color: #374151; }
.rv-q-badge {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: .72rem; font-weight: 600; padding: 3px 10px; border-radius: 20px;
}
.rv-q-badge--ok  { background: #dcfce7; color: #16a34a; }
.rv-q-badge--err { background: #fee2e2; color: #dc2626; }

.rv-q-text { font-size: .98rem; font-weight: 600; color: #111827; line-height: 1.5; margin: 0 0 20px; }

/* Options */
.rv-options { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
.rv-opt {
  display: flex; align-items: flex-start; gap: 12px; padding: 13px 16px;
  border: 1.5px solid #e5e7eb; border-radius: 10px; transition: border-color .15s;
}
.rv-opt--answer-correct { border-color: #22c55e; background: #f0fdf4; }
.rv-opt--answer-wrong   { border-color: #ef4444; background: #fef2f2; }
.rv-opt--correct-only   { border-color: #22c55e; }
.rv-opt-letter {
  width: 26px; height: 26px; border-radius: 6px; background: #f3f4f6;
  font-size: .75rem; font-weight: 700; color: #374151;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px;
}
.rv-opt--answer-correct .rv-opt-letter { background: #dcfce7; color: #16a34a; }
.rv-opt--answer-wrong   .rv-opt-letter { background: #fee2e2; color: #dc2626; }
.rv-opt--correct-only   .rv-opt-letter { background: #dcfce7; color: #16a34a; }
.rv-opt-body { flex: 1; display: flex; flex-direction: column; gap: 6px; }
.rv-opt-text { font-size: .88rem; color: #374151; line-height: 1.5; }
.rv-opt-tags { display: flex; gap: 5px; align-items: center; flex-wrap: wrap; }
.rv-tag      { font-size: .62rem; font-weight: 700; padding: 2px 8px; border-radius: 4px; letter-spacing: .05em; }
.rv-tag--your    { background: #dbeafe; color: #2563eb; }
.rv-tag--correct { background: #dcfce7; color: #16a34a; }

/* AI Explanation */
.rv-ai-box   { background: #f9fafb; border-radius: 10px; padding: 16px 18px; margin-bottom: 20px; }
.rv-ai-head  { display: flex; align-items: center; gap: 7px; margin-bottom: 10px; }
.rv-ai-label { font-size: .7rem; font-weight: 800; color: #7f1d1d; letter-spacing: .07em; }
.rv-ai-text  { font-size: .83rem; color: #374151; line-height: 1.65; margin: 0 0 12px; }
.rv-ai-loading {
  display: flex; align-items: center; gap: 8px;
  font-size: .83rem; color: #9ca3af; margin-bottom: 12px;
}
.rv-ai-spinner {
  width: 14px; height: 14px; border-radius: 50%;
  border: 2px solid #e5e7eb; border-top-color: #7f1d1d;
  animation: spin .7s linear infinite; flex-shrink: 0;
}
.rv-ai-actions { display: flex; gap: 16px; }
.rv-ai-btn {
  display: flex; align-items: center; gap: 6px;
  background: none; border: none; cursor: pointer;
  font-size: .8rem; color: #6b7280; font-weight: 500; padding: 0;
}
.rv-ai-btn:hover { color: #374151; }

/* Navigation */
.rv-q-nav { display: flex; justify-content: space-between; align-items: center; padding-top: 4px; }
.rv-q-nav-btn {
  display: flex; align-items: center; gap: 7px;
  background: none; border: none; font-size: .85rem; color: #374151;
  font-weight: 500; cursor: pointer; padding: 0;
}
.rv-q-nav-btn:disabled { color: #d1d5db; cursor: default; }
.rv-q-nav-btn--next {
  background: #111827; color: #fff; padding: 10px 18px;
  border-radius: 10px; font-weight: 600; font-size: .85rem;
}
.rv-q-nav-btn--next:hover:not(:disabled) { background: #1f2937; }
.rv-q-nav-btn--next:disabled { background: #e5e7eb; color: #9ca3af; cursor: default; }
</style>
