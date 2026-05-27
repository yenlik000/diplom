<template>
  <div class="lms-wrap">

    <!-- ── Sidebar ───────────────────────────────────────────── -->
    <aside class="lms-sidebar">
      <!-- <div class="sidebar-logo">
        <img src="@/assets/logo.png" alt="Bridge" class="sidebar-logo-img" />
      </div> -->
      <nav class="sidebar-nav">
        <RouterLink to="/dashboard" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <g clip-path="url(#nv-home)">
              <path d="M6.56369 11.6129C5.96694 11.6129 5.37604 11.4954 4.82472 11.267C4.27339 11.0386 3.77245 10.7039 3.35049 10.282C2.92852 9.85999 2.5938 9.35905 2.36543 8.80773C2.13707 8.2564 2.01953 7.6655 2.01953 7.06875C2.01953 6.472 2.13707 5.8811 2.36543 5.32978C2.5938 4.77845 2.92852 4.27751 3.35049 3.85554C3.77245 3.43358 4.27339 3.09886 4.82472 2.87049C5.37604 2.64213 5.96694 2.52459 6.56369 2.52459C7.76888 2.52459 8.9247 3.00335 9.7769 3.85554C10.6291 4.70774 11.1079 5.86356 11.1079 7.06875C11.1079 8.27394 10.6291 9.42976 9.7769 10.282C8.9247 11.1342 7.76888 11.6129 6.56369 11.6129ZM7.0686 21.711C5.86341 21.711 4.70759 21.2323 3.85539 20.3801C3.0032 19.5279 2.52444 18.3721 2.52444 17.1669C2.52444 15.9617 3.0032 14.8059 3.85539 13.9537C4.70759 13.1015 5.86341 12.6227 7.0686 12.6227C8.27379 12.6227 9.42961 13.1015 10.2818 13.9537C11.134 14.8059 11.6128 15.9617 11.6128 17.1669C11.6128 18.3721 11.134 19.5279 10.2818 20.3801C9.42961 21.2323 8.27379 21.711 7.0686 21.711ZM17.1667 11.6129C16.57 11.6129 15.9791 11.4954 15.4278 11.267C14.8764 11.0386 14.3755 10.7039 13.9535 10.282C13.5316 9.85999 13.1968 9.35905 12.9685 8.80773C12.7401 8.2564 12.6226 7.6655 12.6226 7.06875C12.6226 6.472 12.7401 5.8811 12.9685 5.32978C13.1968 4.77845 13.5316 4.27751 13.9535 3.85554C14.3755 3.43358 14.8764 3.09886 15.4278 2.87049C15.9791 2.64213 16.57 2.52459 17.1667 2.52459C18.3719 2.52459 19.5277 3.00335 20.3799 3.85554C21.2321 4.70774 21.7109 5.86356 21.7109 7.06875C21.7109 8.27394 21.2321 9.42976 20.3799 10.282C19.5277 11.1342 18.3719 11.6129 17.1667 11.6129ZM17.1667 21.711C15.9615 21.711 14.8057 21.2323 13.9535 20.3801C13.1013 19.5279 12.6226 18.3721 12.6226 17.1669C12.6226 15.9617 13.1013 14.8059 13.9535 13.9537C14.8057 13.1015 15.9615 12.6227 17.1667 12.6227C18.3719 12.6227 19.5277 13.1015 20.3799 13.9537C21.2321 14.8059 21.7109 15.9617 21.7109 17.1669C21.7109 18.3721 21.2321 19.5279 20.3799 20.3801C19.5277 21.2323 18.3719 21.711 17.1667 21.711Z" fill="currentColor"/>
            </g>
            <defs><clipPath id="nv-home"><rect width="24.2355" height="24.2355" fill="white"/></clipPath></defs>
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
            <path d="M7.36247 21.0283L3.18143 21.9576C2.64028 22.0779 2.15751 21.5951 2.27779 21.054L3.20708 16.8729C2.42502 15.4101 2.01705 13.7765 2.01954 12.1177C2.01954 6.54051 6.54048 2.01958 12.1177 2.01958C17.6949 2.01958 22.2158 6.54051 22.2158 12.1177C22.2158 17.6949 17.6949 22.2158 12.1177 22.2158C10.4589 22.2183 8.8253 21.8104 7.36247 21.0283Z" fill="currentColor"/>
          </svg>
          <span>Messages</span>
        </RouterLink>
        <RouterLink to="/student/settings" class="nav-item">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none">
            <path d="M12 15a3 3 0 100-6 3 3 0 000 6zM19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/>
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

    <!-- ── Main ──────────────────────────────────────────────── -->
    <div class="lms-main">
      <div class="notes-layout">

        <!-- Left: editor area -->
        <div class="editor-area">

          <!-- Header -->
          <div class="notes-header">
            <RouterLink :to="backPath" class="back-link">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              {{ moduleLabel }}
            </RouterLink>
            <div class="notes-title-row">
              <div>
                <h1 class="notes-title">{{ lessonTitle }}</h1>
                <p class="notes-subtitle">Lesson Notes &amp; Reference Guide</p>
              </div>
              <div class="notes-actions">
                <button class="btn-export" @click="exportPdf">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="7 10 12 15 17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <line x1="12" y1="15" x2="12" y2="3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                  Export PDF
                </button>
                <button class="btn-save" @click="saveNotes" :class="{ 'btn-save--saved': saved }">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="17 21 17 13 7 13 7 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <polyline points="7 3 7 8 15 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                  {{ saved ? 'Saved!' : 'Save Notes' }}
                </button>
              </div>
            </div>
          </div>

          <!-- Toolbar -->
          <div class="editor-wrap">
            <div class="toolbar">
              <div class="toolbar-group">
                <button class="tb-btn" @click="fmt('bold')" title="Bold"><strong>B</strong></button>
                <button class="tb-btn tb-italic" @click="fmt('italic')" title="Italic"><em>I</em></button>
                <button class="tb-btn tb-underline" @click="fmt('underline')" title="Underline"><u>U</u></button>
              </div>
              <div class="toolbar-sep"></div>
              <div class="toolbar-group">
                <button class="tb-btn" @click="fmt('insertUnorderedList')" title="Bullet List">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><line x1="9" y1="6" x2="20" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="9" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="9" y1="18" x2="20" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="4" cy="6" r="1.5" fill="currentColor"/><circle cx="4" cy="12" r="1.5" fill="currentColor"/><circle cx="4" cy="18" r="1.5" fill="currentColor"/></svg>
                </button>
                <button class="tb-btn" @click="fmt('insertOrderedList')" title="Numbered List">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><line x1="10" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="10" y1="12" x2="21" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="10" y1="18" x2="21" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 6h1v4M4 10h2M4 15h1.5a.5.5 0 010 1H4a.5.5 0 000 1h2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </button>
              </div>
              <div class="toolbar-sep"></div>
              <div class="toolbar-group">
                <button class="tb-btn" @click="fmt('justifyLeft')" title="Align Left">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><line x1="3" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="3" y1="12" x2="15" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="3" y1="18" x2="18" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <button class="tb-btn" @click="fmt('justifyRight')" title="Align Right">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><line x1="3" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="9" y1="12" x2="21" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="6" y1="18" x2="21" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
              </div>
              <div class="toolbar-sep"></div>
              <div class="toolbar-group">
                <button class="tb-btn" @click="insertBlockquote" title="Quote">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1zm12 0c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </button>
                <button class="tb-btn" @click="insertLink" title="Link">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
              </div>
              <div class="toolbar-sep"></div>
              <div class="toolbar-group">
                <button class="tb-btn" @click="fmt('undo')" title="Undo">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M3 7v6h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 17a9 9 0 00-9-9 9 9 0 00-6 2.3L3 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <button class="tb-btn" @click="fmt('redo')" title="Redo">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M21 7v6h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 17a9 9 0 019-9 9 9 0 016 2.3L21 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
              </div>
            </div>

            <!-- Editable content -->
            <div
              ref="editorEl"
              class="editor-content"
              contenteditable="true"
              @input="onInput"
              v-html="initialContent"
            ></div>
          </div>
        </div>

        <!-- Right sidebar -->
        <div class="notes-sidebar">

          <!-- Grammar Rules -->
          <div class="grammar-card">
            <div class="grammar-head">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 2a7 7 0 017 7c0 3.87-3.13 7-7 7s-7-3.13-7-7a7 7 0 017-7zM12 16v6M8 22h8" stroke="white" stroke-width="2" stroke-linecap="round"/>
              </svg>
              <span>GRAMMAR RULES</span>
            </div>
            <div v-for="rule in grammarRules" :key="rule.title" class="grammar-rule">
              <p class="gr-title">{{ rule.title }}</p>
              <p class="gr-desc" v-html="rule.desc"></p>
              <span class="gr-pill">{{ rule.formula }}</span>
            </div>
          </div>

          <!-- Quick Test -->
          <div class="quick-test-card">
            <div class="qt-head">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="2"/>
                <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
              <span class="qt-title">Quick Test</span>
            </div>
            <p class="qt-question">Which is correct?</p>
            <div class="qt-options">
              <button
                v-for="(opt, oi) in quickTest.options"
                :key="oi"
                class="qt-opt"
                :class="{
                  'qt-opt--selected': quickAnswer === oi,
                  'qt-opt--correct':  quickAnswer !== null && oi === quickTest.correct,
                  'qt-opt--wrong':    quickAnswer === oi && oi !== quickTest.correct,
                }"
                @click="quickAnswer = oi"
              >
                {{ opt }}
                <svg v-if="quickAnswer !== null && oi === quickTest.correct"
                     width="16" height="16" viewBox="0 0 24 24" fill="none" class="qt-check">
                  <circle cx="12" cy="12" r="10" fill="#22c55e"/>
                  <path d="M8 12l3 3 5-5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
import { ref, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route  = useRoute()
const router = useRouter()

const lessonTitle  = ref('Present Perfect vs Past Simple')
const moduleLabel  = ref('INTERMEDIATE ENGLISH B2')
const backPath     = computed(() => `/lessons/${route.params.id}`)
const saved        = ref(false)
const quickAnswer  = ref(null)
const editorEl     = ref(null)

const initialContent = `<h2>My Key Learnings</h2>
<p>Today we discussed the nuances between these two crucial tenses. The main takeaway is that the <strong style="color:#7f1d1d">Present Perfect</strong> connects the past to the present, while the <u style="color:#2563eb">Past Simple</u> is for completed actions at a specific time.</p>
<ul>
  <li>Use Present Perfect for life experiences where the time isn't mentioned. (e.g., "I have been to Paris.")</li>
  <li>Use Past Simple for specific events with a time marker. (e.g., "I went to Paris in 2019.")</li>
  <li>Signal words for Present Perfect: already, yet, since, for, ever, never.</li>
</ul>
<blockquote>"The Present Perfect is like a bridge between yesterday and today." — Prof. Henderson.</blockquote>
<p>I need to practice the irregular verbs more. Especially "been" vs "gone".</p>
<ul>
  <li>Been: Went and came back.</li>
  <li>Gone: Still there.</li>
</ul>`

const grammarRules = ref([
  {
    title: 'Present Perfect',
    desc:  'Focuses on the <strong>result</strong> or the fact that something happened (unspecified time).',
    formula: 'Have/Has + Past Participle',
  },
  {
    title: 'Past Simple',
    desc:  'Focuses on <strong>when</strong> something happened (finished time).',
    formula: 'Verb + -ed / Irregular',
  },
])

const quickTest = ref({
  options: [
    'I have seen that film yesterday.',
    'I saw that film yesterday.',
  ],
  correct: 1,
})

function fmt(cmd) {
  document.execCommand(cmd, false, null)
  editorEl.value?.focus()
}

function insertBlockquote() {
  const sel = window.getSelection()
  if (!sel.rangeCount) return
  const range = sel.getRangeAt(0)
  const bq    = document.createElement('blockquote')
  bq.appendChild(range.extractContents())
  range.insertNode(bq)
}

function insertLink() {
  const url = window.prompt('Enter URL:')
  if (url) document.execCommand('createLink', false, url)
}

function onInput() {
  saved.value = false
}

function saveNotes() {
  saved.value = true
  setTimeout(() => { saved.value = false }, 2500)
}

function exportPdf() {
  window.print()
}
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
  flex: 1; background: #fff; border-radius: 24px 0 0 24px;
  overflow: hidden; min-width: 0;
}
.notes-layout {
  height: 100%; display: grid;
  grid-template-columns: 1fr 220px;
}

/* ── Editor Area ───────────────────────────────────────────── */
.editor-area {
  display: flex; flex-direction: column;
  overflow: hidden; padding: 28px 24px 0 32px;
}

.notes-header { flex-shrink: 0; margin-bottom: 18px; }
.back-link {
  display: inline-flex; align-items: center; gap: 6px;
  font-size: .7rem; font-weight: 700; color: #7f1d1d;
  text-decoration: none; letter-spacing: .07em; margin-bottom: 10px;
}
.back-link:hover { text-decoration: underline; }
.notes-title-row {
  display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
}
.notes-title   { font-size: 1.55rem; font-weight: 800; color: #111827; margin: 0 0 4px; line-height: 1.2; }
.notes-subtitle { font-size: .82rem; color: #9ca3af; font-style: italic; margin: 0; }
.notes-actions { display: flex; gap: 10px; flex-shrink: 0; margin-top: 4px; }
.btn-export {
  display: flex; align-items: center; gap: 6px;
  background: #fff; border: 1.5px solid #d1d5db; color: #374151;
  font-size: .82rem; font-weight: 600; padding: 9px 16px;
  border-radius: 10px; cursor: pointer; transition: border-color .15s;
}
.btn-export:hover { border-color: #9ca3af; }
.btn-save {
  display: flex; align-items: center; gap: 6px;
  background: #111827; border: none; color: #fff;
  font-size: .82rem; font-weight: 600; padding: 9px 16px;
  border-radius: 10px; cursor: pointer; transition: background .2s;
}
.btn-save--saved { background: #16a34a; }

/* ── Editor Wrap ───────────────────────────────────────────── */
.editor-wrap {
  flex: 1; overflow: hidden; display: flex; flex-direction: column;
  border: 1.5px solid #e5e7eb; border-radius: 14px; margin-bottom: 28px;
}

/* Toolbar */
.toolbar {
  display: flex; align-items: center; flex-wrap: wrap; gap: 2px;
  padding: 8px 12px; border-bottom: 1px solid #f3f4f6;
  background: #f9fafb; flex-shrink: 0;
}
.toolbar-group { display: flex; align-items: center; gap: 1px; }
.toolbar-sep   { width: 1px; height: 18px; background: #e5e7eb; margin: 0 6px; }
.tb-btn {
  width: 28px; height: 28px; border: none; background: none; border-radius: 6px;
  cursor: pointer; display: flex; align-items: center; justify-content: center;
  font-size: .85rem; color: #374151; transition: background .12s;
}
.tb-btn:hover    { background: #e5e7eb; }
.tb-italic       { font-style: italic; }
.tb-underline    { text-decoration: underline; }

/* Content */
.editor-content {
  flex: 1; overflow-y: auto; padding: 20px 24px;
  font-size: .9rem; line-height: 1.8; color: #374151;
  outline: none;
}
.editor-content :deep(h2)         { font-size: 1.2rem; font-weight: 700; color: #7f1d1d; margin: 0 0 12px; }
.editor-content :deep(p)          { margin: 0 0 10px; }
.editor-content :deep(ul)         { padding-left: 20px; margin: 0 0 12px; }
.editor-content :deep(ol)         { padding-left: 20px; margin: 0 0 12px; }
.editor-content :deep(li)         { margin-bottom: 4px; }
.editor-content :deep(blockquote) {
  border-left: 3px solid #d1d5db; padding: 10px 16px;
  background: #f9fafb; border-radius: 0 8px 8px 0;
  font-style: italic; color: #6b7280; margin: 12px 0;
}

/* ── Notes Sidebar ─────────────────────────────────────────── */
.notes-sidebar {
  border-left: 1px solid #f3f4f6; padding: 28px 16px 24px;
  display: flex; flex-direction: column; gap: 16px; overflow-y: auto;
}

/* Grammar card */
.grammar-card  { border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; }
.grammar-head  {
  display: flex; align-items: center; gap: 8px;
  background: #1e293b; color: #fff;
  padding: 10px 14px; font-size: .7rem; font-weight: 700; letter-spacing: .07em;
}
.grammar-rule  { padding: 12px 14px; border-bottom: 1px solid #f3f4f6; }
.grammar-rule:last-child { border-bottom: none; }
.gr-title { font-size: .82rem; font-weight: 700; color: #7f1d1d; margin: 0 0 4px; }
.gr-desc  { font-size: .76rem; color: #374151; margin: 0 0 8px; line-height: 1.5; }
.gr-pill  {
  display: inline-block; background: #f3f4f6; color: #374151;
  font-size: .65rem; font-weight: 600; padding: 3px 9px; border-radius: 20px;
}

/* Quick test */
.quick-test-card {
  background: #fefce8; border: 1px solid #fef08a; border-radius: 12px; padding: 14px;
}
.qt-head {
  display: flex; align-items: center; gap: 7px; margin-bottom: 8px; color: #92400e;
}
.qt-title    { font-size: .78rem; font-weight: 800; color: #92400e; }
.qt-question { font-size: .8rem; color: #374151; font-weight: 600; margin: 0 0 10px; }
.qt-options  { display: flex; flex-direction: column; gap: 7px; }
.qt-opt {
  display: flex; align-items: center; justify-content: space-between; gap: 8px;
  background: #fff; border: 1.5px solid #e5e7eb; border-radius: 8px;
  padding: 9px 12px; font-size: .78rem; color: #374151; cursor: pointer;
  text-align: left; transition: border-color .15s, background .15s;
}
.qt-opt:hover          { border-color: #d1d5db; background: #fafafa; }
.qt-opt--selected      { border-color: #7f1d1d; background: #fff7f7; }
.qt-opt--correct       { border-color: #22c55e; background: #f0fdf4; }
.qt-opt--wrong         { border-color: #ef4444; background: #fef2f2; }
.qt-check { flex-shrink: 0; }
</style>
