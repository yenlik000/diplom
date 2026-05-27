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
            <g clip-path="url(#mr-home)">
              <path d="M6.56369 11.6129C5.96694 11.6129 5.37604 11.4954 4.82472 11.267C4.27339 11.0386 3.77245 10.7039 3.35049 10.282C2.92852 9.85999 2.5938 9.35905 2.36543 8.80773C2.13707 8.2564 2.01953 7.6655 2.01953 7.06875C2.01953 6.472 2.13707 5.8811 2.36543 5.32978C2.5938 4.77845 2.92852 4.27751 3.35049 3.85554C3.77245 3.43358 4.27339 3.09886 4.82472 2.87049C5.37604 2.64213 5.96694 2.52459 6.56369 2.52459C7.76888 2.52459 8.9247 3.00335 9.7769 3.85554C10.6291 4.70774 11.1079 5.86356 11.1079 7.06875C11.1079 8.27394 10.6291 9.42976 9.7769 10.282C8.9247 11.1342 7.76888 11.6129 6.56369 11.6129ZM7.0686 21.711C5.86341 21.711 4.70759 21.2323 3.85539 20.3801C3.0032 19.5279 2.52444 18.3721 2.52444 17.1669C2.52444 15.9617 3.0032 14.8059 3.85539 13.9537C4.70759 13.1015 5.86341 12.6227 7.0686 12.6227C8.27379 12.6227 9.42961 13.1015 10.2818 13.9537C11.134 14.8059 11.6128 15.9617 11.6128 17.1669C11.6128 18.3721 11.134 19.5279 10.2818 20.3801C9.42961 21.2323 8.27379 21.711 7.0686 21.711ZM17.1667 11.6129C16.57 11.6129 15.9791 11.4954 15.4278 11.267C14.8764 11.0386 14.3755 10.7039 13.9535 10.282C13.5316 9.85999 13.1968 9.35905 12.9685 8.80773C12.7401 8.2564 12.6226 7.6655 12.6226 7.06875C12.6226 6.472 12.7401 5.8811 12.9685 5.32978C13.1968 4.77845 13.5316 4.27751 13.9535 3.85554C14.3755 3.43358 14.8764 3.09886 15.4278 2.87049C15.9791 2.64213 16.57 2.52459 17.1667 2.52459C18.3719 2.52459 19.5277 3.00335 20.3799 3.85554C21.2321 4.70774 21.7109 5.86356 21.7109 7.06875C21.7109 8.27394 21.2321 9.42976 20.3799 10.282C19.5277 11.1342 18.3719 11.6129 17.1667 11.6129ZM17.1667 21.711C15.9615 21.711 14.8057 21.2323 13.9535 20.3801C13.1013 19.5279 12.6226 18.3721 12.6226 17.1669C12.6226 15.9617 13.1013 14.8059 13.9535 13.9537C14.8057 13.1015 15.9615 12.6227 17.1667 12.6227C18.3719 12.6227 19.5277 13.1015 20.3799 13.9537C21.2321 14.8059 21.7109 15.9617 21.7109 17.1669C21.7109 18.3721 21.2321 19.5279 20.3799 20.3801C19.5277 21.2323 18.3719 21.711 17.1667 21.711Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="mr-home"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
          </svg>
          <span>Home</span>
        </RouterLink>
        <RouterLink to="/student/progress" class="nav-item nav-item--active">
          <svg width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M6 13.127H2a1 1 0 00-1 1v8a1 1 0 001 1h4a1 1 0 001-1v-8a1 1 0 00-1-1zM5 21H3v-6h2v6zM22 9.088h-4a1 1 0 00-1 1v12a1 1 0 001 1h4a1 1 0 001-1v-12a1 1 0 00-1-1zm-1 12h-2v-10h2v10zM14 1.01h-4a1 1 0 00-1 1v20a1 1 0 001 1h4a1 1 0 001-1v-20a1 1 0 00-1-1zm-1 20h-2V3.029h2V21.01z" fill="currentColor"/>
          </svg>
          <span>Progress</span>
        </RouterLink>
        <RouterLink to="/student/messages" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#mr-msg)">
              <path d="M7.36247 21.0283L3.18143 21.9576C2.64028 22.0779 2.15751 21.5951 2.27779 21.054L3.20708 16.8729C2.42502 15.4101 2.01705 13.7765 2.01954 12.1177C2.01954 6.54051 6.54048 2.01958 12.1177 2.01958C17.6949 2.01958 22.2158 6.54051 22.2158 12.1177C22.2158 17.6949 17.6949 22.2158 12.1177 22.2158C10.4589 22.2183 8.8253 21.8104 7.36247 21.0283Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="mr-msg"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
          </svg>
          <span>Messages</span>
        </RouterLink>
        <RouterLink to="/student/settings" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/>
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
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
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

      <!-- Reader body -->
      <div class="reader-body">

        <!-- Thumbnail panel -->
        <div class="thumb-panel">
          <div class="thumb-header">
            <span class="thumb-title">Thumbnails</span>
            <span class="thumb-count">{{ pages.length }} Pages</span>
          </div>
          <div class="thumb-list">
            <button
              v-for="(page, pi) in pages"
              :key="pi"
              class="thumb-item"
              :class="{ 'thumb-item--active': currentPage === pi }"
              @click="currentPage = pi"
            >
              <div class="thumb-preview">
                <!-- Page 1: text doc -->
                <template v-if="pi === 0">
                  <div class="tp-bar tp-bar--pink" style="width:70%;height:6px;margin-bottom:4px"></div>
                  <div class="tp-bar" style="width:90%;height:3px;margin-bottom:2px"></div>
                  <div class="tp-bar" style="width:85%;height:3px;margin-bottom:2px"></div>
                  <div class="tp-bar" style="width:80%;height:3px;margin-bottom:6px"></div>
                  <div style="display:flex;gap:4px">
                    <div style="flex:1">
                      <div class="tp-bar" style="width:100%;height:2px;margin-bottom:2px"></div>
                      <div class="tp-bar" style="width:100%;height:2px;margin-bottom:2px"></div>
                      <div class="tp-bar" style="width:90%;height:2px;margin-bottom:2px"></div>
                      <div class="tp-bar" style="width:95%;height:2px;margin-bottom:2px"></div>
                    </div>
                    <div style="flex:1">
                      <div class="tp-bar" style="width:100%;height:2px;margin-bottom:2px"></div>
                      <div class="tp-bar" style="width:100%;height:2px;margin-bottom:2px"></div>
                      <div class="tp-bar" style="width:88%;height:2px;margin-bottom:2px"></div>
                      <div class="tp-bar" style="width:92%;height:2px;margin-bottom:2px"></div>
                    </div>
                  </div>
                </template>
                <!-- Page 2: list doc -->
                <template v-else-if="pi === 1">
                  <div class="tp-bar" style="width:60%;height:4px;margin-bottom:5px"></div>
                  <div v-for="n in 5" :key="n" style="display:flex;align-items:center;gap:3px;margin-bottom:3px">
                    <div class="tp-dot"></div>
                    <div class="tp-bar" :style="`width:${70+n*3}%;height:2px`"></div>
                  </div>
                </template>
                <!-- Page 3: table -->
                <template v-else>
                  <div class="tp-bar tp-bar--blue" style="width:100%;height:5px;margin-bottom:3px"></div>
                  <div v-for="r in 6" :key="r" style="display:flex;gap:2px;margin-bottom:2px">
                    <div class="tp-bar tp-bar--blue" style="flex:1;height:3px"></div>
                    <div class="tp-bar" style="flex:2;height:3px"></div>
                    <div class="tp-bar" style="flex:2;height:3px"></div>
                    <div class="tp-bar" style="flex:2;height:3px"></div>
                  </div>
                </template>
              </div>
              <span class="thumb-label">Page {{ pi + 1 }}</span>
            </button>
          </div>
        </div>

        <!-- Document viewer -->
        <div class="doc-viewer">
          <div class="doc-page">
            <!-- Page 1 -->
            <template v-if="currentPage === 0">
              <div class="dp-corner-label">B</div>
              <div class="dp-section">
                <div class="dp-heading-bar"></div>
                <div class="dp-cols">
                  <div class="dp-col">
                    <div class="dp-line" style="width:95%"></div>
                    <div class="dp-line" style="width:88%"></div>
                    <div class="dp-line" style="width:92%"></div>
                    <div class="dp-line" style="width:85%"></div>
                    <div class="dp-line" style="width:90%"></div>
                    <div class="dp-line" style="width:78%"></div>
                    <div class="dp-line" style="width:93%"></div>
                    <div class="dp-line" style="width:87%"></div>
                  </div>
                  <div class="dp-col">
                    <div class="dp-line" style="width:95%"></div>
                    <div class="dp-line" style="width:90%"></div>
                    <div class="dp-line" style="width:85%"></div>
                    <div class="dp-line" style="width:92%"></div>
                    <div class="dp-line" style="width:80%"></div>
                    <div class="dp-line" style="width:88%"></div>
                    <div class="dp-line" style="width:93%"></div>
                    <div class="dp-line" style="width:76%"></div>
                  </div>
                </div>
              </div>
              <div class="dp-divider"></div>
              <div class="dp-section">
                <div class="dp-sub-bar"></div>
                <div class="dp-img-placeholder">
                  <svg width="36" height="36" viewBox="0 0 24 24" fill="none" opacity="0.3">
                    <path d="M4 19.5A2.5 2.5 0 016.5 17H20" stroke="#374151" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z" stroke="#374151" stroke-width="1.5"/>
                  </svg>
                </div>
                <div class="dp-cols" style="margin-top:10px">
                  <div class="dp-col">
                    <div class="dp-line dp-line--pink" style="width:80%"></div>
                    <div class="dp-line" style="width:60%"></div>
                    <div class="dp-line" style="width:70%"></div>
                  </div>
                  <div class="dp-col">
                    <div class="dp-block dp-block--pink"></div>
                    <div class="dp-block dp-block--pink-light"></div>
                    <div class="dp-block dp-block--gray"></div>
                  </div>
                </div>
              </div>
              <div class="dp-footer">BRIDGE ACADEMIC SERIES • 2024</div>
            </template>

            <!-- Page 2 -->
            <template v-else-if="currentPage === 1">
              <div class="dp-corner-label">B</div>
              <div class="dp-section">
                <div class="dp-heading-bar"></div>
                <div v-for="n in 8" :key="n" class="dp-list-row">
                  <div class="dp-list-num">{{ n }}.</div>
                  <div style="flex:1">
                    <div class="dp-line" :style="`width:${85-n*2}%`"></div>
                    <div class="dp-line" style="width:70%;margin-top:4px"></div>
                  </div>
                </div>
              </div>
              <div class="dp-footer">BRIDGE ACADEMIC SERIES • 2024</div>
            </template>

            <!-- Page 3 -->
            <template v-else>
              <div class="dp-corner-label">B</div>
              <div class="dp-section">
                <div class="dp-heading-bar"></div>
                <div class="dp-table">
                  <div class="dp-table-head">
                    <div class="dp-td dp-td--head">Term</div>
                    <div class="dp-td dp-td--head">Definition</div>
                    <div class="dp-td dp-td--head">Example</div>
                  </div>
                  <div v-for="r in 10" :key="r" class="dp-table-row">
                    <div class="dp-td"><div class="dp-line" style="width:80%"></div></div>
                    <div class="dp-td"><div class="dp-line" style="width:90%"></div><div class="dp-line" style="width:70%;margin-top:4px"></div></div>
                    <div class="dp-td"><div class="dp-line" style="width:85%"></div></div>
                  </div>
                </div>
              </div>
              <div class="dp-footer">BRIDGE ACADEMIC SERIES • 2024</div>
            </template>
          </div>
        </div>

        <!-- Right sidebar -->
        <div class="reader-sidebar">

          <!-- Learning Progress -->
          <div class="rs-card">
            <p class="rs-card-title">Learning Progress</p>
            <div class="rs-progress-row">
              <span class="rs-prog-label">Module Completion</span>
              <span class="rs-prog-pct">{{ completionPct }}%</span>
            </div>
            <div class="rs-prog-track">
              <div class="rs-prog-fill" :style="`width:${completionPct}%`"></div>
            </div>
            <div class="rs-stats">
              <div class="rs-stat">
                <div class="rs-stat-icon rs-stat-icon--red">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                    <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </div>
                <span class="rs-stat-label">Read Time</span>
                <span class="rs-stat-val">{{ readTime }} min</span>
              </div>
              <div class="rs-stat">
                <div class="rs-stat-icon rs-stat-icon--blue">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </div>
                <span class="rs-stat-label">Saved Notes</span>
                <span class="rs-stat-val">{{ savedNotes }}</span>
              </div>
            </div>
          </div>

          <!-- Key Definitions -->
          <div class="rs-defs">
            <p class="rs-defs-title">Key Definitions</p>
            <div v-for="def in definitions" :key="def.term" class="rs-def-item">
              <p class="rs-def-term">{{ def.term }}</p>
              <p class="rs-def-text">{{ def.desc }}</p>
            </div>
          </div>

          <button class="rs-notebook-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
              <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="white" stroke-width="2" stroke-linecap="round"/>
              <path d="M14 2v6h6" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Open Notebook
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const currentPage   = ref(0)
const completionPct = ref(68)
const readTime      = ref(14)
const savedNotes    = ref(8)

const pages = ref([
  { label: 'Page 1' },
  { label: 'Page 2' },
  { label: 'Page 3' },
  { label: 'Page 4' },
  { label: 'Page 5' },
])

const definitions = ref([
  {
    term: 'Subjunctive Mood',
    desc: 'Used to express various states of unreality such as wish, emotion...',
  },
  {
    term: 'Dangling Participle',
    desc: 'A participle intended to modify a noun that is not actually present...',
  },
])
</script>

<style scoped>
/* ── Layout ────────────────────────────────────────────────── */
.lms-wrap { display: flex; height: 100vh; background: #7f1d1d; overflow: hidden; }

/* ── Sidebar ───────────────────────────────────────────────── */
.lms-sidebar {
  width: 220px; flex-shrink: 0; display: flex; flex-direction: column;
  padding: 28px 16px 24px; overflow-y: auto;
}
.sidebar-logo     { margin-bottom: 32px; display: flex; align-items: center; }
.sidebar-logo-img { height: 38px; object-fit: contain; }
.sidebar-nav      { display: flex; flex-direction: column; gap: 4px; flex: 1; }
.nav-item {
  display: flex; align-items: center; gap: 12px; padding: 11px 14px;
  border-radius: 12px; color: rgba(255,255,255,.65); text-decoration: none;
  font-size: .88rem; font-weight: 500; transition: background .15s, color .15s;
}
.nav-item:hover   { background: rgba(255,255,255,.1); color: #fff; }
.nav-item--active { background: rgba(255,255,255,.18); color: #fff; font-weight: 600; }
.support-card {
  background: #fff; border-radius: 16px; padding: 16px 14px 0;
  margin-top: 20px; overflow: hidden;
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
  background: #fff; border-radius: 24px 0 0 24px; overflow: hidden; min-width: 0;
}

/* ── Topbar ────────────────────────────────────────────────── */
.topbar {
  display: flex; align-items: center; gap: 14px;
  padding: 18px 24px 14px; flex-shrink: 0;
}
.search-wrap {
  flex: 1; display: flex; align-items: center; gap: 10px;
  background: #f3f4f6; border-radius: 12px; padding: 10px 16px;
}
.search-input { border: none; outline: none; font-size: .9rem; color: #374151; width: 100%; background: transparent; }
.topbar-right { display: flex; align-items: center; gap: 8px; }
.topbar-icon-btn {
  width: 42px; height: 42px; border-radius: 50%; border: none;
  background: #f3f4f6; cursor: pointer; display: flex; align-items: center; justify-content: center;
}
.topbar-avatar-btn {
  width: 42px; height: 42px; border-radius: 50%; border: none;
  background: #7f1d1d; cursor: pointer; display: flex; align-items: center; justify-content: center;
}

/* ── Reader body ───────────────────────────────────────────── */
.reader-body {
  flex: 1; display: grid; grid-template-columns: 148px 1fr 196px;
  overflow: hidden; min-height: 0;
}

/* ── Thumbnail panel ───────────────────────────────────────── */
.thumb-panel {
  display: flex; flex-direction: column;
  border-right: 1px solid #f3f4f6; overflow: hidden;
}
.thumb-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 10px 12px 8px; flex-shrink: 0;
}
.thumb-title { font-size: .72rem; font-weight: 700; color: #374151; }
.thumb-count { font-size: .65rem; color: #9ca3af; }
.thumb-list  { flex: 1; overflow-y: auto; padding: 4px 8px 16px; display: flex; flex-direction: column; gap: 10px; }
.thumb-item  {
  background: none; border: 2px solid transparent; border-radius: 8px;
  padding: 0; cursor: pointer; display: flex; flex-direction: column; align-items: center; gap: 4px;
}
.thumb-item--active { border-color: #7f1d1d; }
.thumb-preview {
  width: 100%; background: #fff; border: 1px solid #e5e7eb; border-radius: 6px;
  padding: 8px; min-height: 88px; display: flex; flex-direction: column; justify-content: flex-start;
}
.thumb-item--active .thumb-preview { border-color: #fca5a5; }
.thumb-label { font-size: .65rem; color: #6b7280; font-weight: 500; }
.tp-bar      { background: #e5e7eb; border-radius: 2px; }
.tp-bar--pink { background: #fca5a5; }
.tp-bar--blue { background: #93c5fd; }
.tp-dot      { width: 4px; height: 4px; border-radius: 50%; background: #d1d5db; flex-shrink: 0; }

/* ── Document viewer ───────────────────────────────────────── */
.doc-viewer {
  overflow-y: auto; background: #f3f4f6; display: flex;
  align-items: flex-start; justify-content: center; padding: 24px 16px 32px;
}
.doc-page {
  background: #fff; width: 100%; max-width: 520px; min-height: 680px;
  border-radius: 4px; box-shadow: 0 2px 12px rgba(0,0,0,.08);
  padding: 32px 36px 24px; position: relative; display: flex; flex-direction: column;
}
.dp-corner-label {
  position: absolute; top: 16px; right: 20px;
  font-size: .9rem; font-weight: 800; color: #e5e7eb;
}
.dp-section     { margin-bottom: 20px; }
.dp-heading-bar { height: 10px; width: 55%; background: #fca5a5; border-radius: 3px; margin-bottom: 14px; }
.dp-sub-bar     { height: 7px; width: 40%; background: #fca5a5; border-radius: 3px; margin-bottom: 12px; }
.dp-cols        { display: flex; gap: 16px; }
.dp-col         { flex: 1; display: flex; flex-direction: column; gap: 5px; }
.dp-line        { height: 5px; background: #e5e7eb; border-radius: 2px; }
.dp-line--pink  { background: #fca5a5; }
.dp-divider     { height: 1px; background: #f3f4f6; margin: 8px 0 16px; }
.dp-img-placeholder {
  width: 80px; height: 70px; background: #f9fafb; border: 1px solid #e5e7eb;
  border-radius: 6px; display: flex; align-items: center; justify-content: center;
  margin: 0 auto 10px;
}
.dp-block       { height: 12px; border-radius: 3px; margin-bottom: 5px; width: 80%; }
.dp-block--pink      { background: #fca5a5; }
.dp-block--pink-light { background: #fde8e8; }
.dp-block--gray      { background: #e5e7eb; }
.dp-list-row    { display: flex; gap: 8px; margin-bottom: 10px; }
.dp-list-num    { font-size: .75rem; font-weight: 600; color: #9ca3af; width: 16px; flex-shrink: 0; padding-top: 1px; }
.dp-table       { width: 100%; border-collapse: collapse; }
.dp-table-head  { display: flex; background: #93c5fd; border-radius: 4px 4px 0 0; }
.dp-table-row   { display: flex; border-bottom: 1px solid #f3f4f6; }
.dp-td          { flex: 1; padding: 6px 8px; }
.dp-td--head    { font-size: .7rem; font-weight: 700; color: #fff; }
.dp-footer      {
  margin-top: auto; padding-top: 20px;
  font-size: .6rem; color: #d1d5db; text-align: center; letter-spacing: .1em;
}

/* ── Right sidebar ─────────────────────────────────────────── */
.reader-sidebar {
  border-left: 1px solid #f3f4f6; padding: 16px 14px 20px;
  display: flex; flex-direction: column; gap: 16px; overflow-y: auto;
}
.rs-card        { background: #f9fafb; border-radius: 12px; padding: 14px 14px 12px; }
.rs-card-title  { font-size: .78rem; font-weight: 700; color: #111827; margin: 0 0 10px; }
.rs-progress-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; }
.rs-prog-label  { font-size: .7rem; color: #6b7280; }
.rs-prog-pct    { font-size: .7rem; font-weight: 700; color: #111827; }
.rs-prog-track  { height: 5px; background: #e5e7eb; border-radius: 3px; margin-bottom: 14px; }
.rs-prog-fill   { height: 100%; background: #7f1d1d; border-radius: 3px; transition: width .4s ease; }
.rs-stats       { display: flex; gap: 8px; }
.rs-stat        {
  flex: 1; background: #fff; border-radius: 8px; padding: 8px;
  display: flex; flex-direction: column; align-items: center; gap: 3px;
}
.rs-stat-icon   {
  width: 26px; height: 26px; border-radius: 6px;
  display: flex; align-items: center; justify-content: center;
}
.rs-stat-icon--red  { background: #fee2e2; color: #dc2626; }
.rs-stat-icon--blue { background: #dbeafe; color: #2563eb; }
.rs-stat-label { font-size: .6rem; color: #9ca3af; text-align: center; }
.rs-stat-val   { font-size: .82rem; font-weight: 800; color: #111827; }

.rs-defs       { flex: 1; }
.rs-defs-title { font-size: .72rem; font-weight: 700; color: #374151; margin: 0 0 10px; letter-spacing: .04em; }
.rs-def-item   { margin-bottom: 12px; }
.rs-def-term   { font-size: .76rem; font-weight: 700; color: #7f1d1d; margin: 0 0 2px; cursor: pointer; }
.rs-def-text   { font-size: .7rem; color: #6b7280; margin: 0; line-height: 1.5; }

.rs-notebook-btn {
  display: flex; align-items: center; justify-content: center; gap: 7px;
  background: #111827; color: #fff; border: none; border-radius: 10px;
  padding: 10px 14px; font-size: .8rem; font-weight: 600; cursor: pointer;
  width: 100%; transition: background .15s;
}
.rs-notebook-btn:hover { background: #1f2937; }
</style>
