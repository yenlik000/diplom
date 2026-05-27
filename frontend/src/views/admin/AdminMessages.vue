<template>
  <AdminLayout :noPadding="true">
    <template #header-left>
      <h1 style="margin:0;font-size:1.25rem;font-weight:700;color:#111827;">Messages</h1>
    </template>

    <div class="flex" style="height:100%;overflow:hidden;">

      <!-- ── Contact list ──────────────────────────────────────── -->
      <div class="flex flex-col" style="width:300px;flex-shrink:0;border-right:1px solid #e5e7eb;background:#fff;">

        <!-- Search + New Chat -->
        <div style="padding:1rem 1rem .5rem;display:flex;flex-direction:column;gap:.5rem;">
          <div class="am-search">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/></svg>
            <input v-model="searchQ" type="text" placeholder="Search users…" class="am-search-input" />
          </div>
          <button class="am-new-btn" @click.stop="newChatOpen = !newChatOpen">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
            New Conversation
          </button>
        </div>

        <!-- New-chat user picker dropdown -->
        <div v-if="newChatOpen" class="am-picker" @click.stop>
          <div class="am-search" style="margin:.5rem .75rem .25rem;">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/></svg>
            <input v-model="pickerQ" type="text" placeholder="Search all users…" class="am-search-input" autofocus />
          </div>
          <div class="am-picker-list">
            <button
              v-for="c in filteredPickerUsers" :key="c.id"
              class="am-contact"
              @click="startChat(c)"
            >
              <div class="am-avatar" :style="{ background: c.color }">{{ c.initials }}</div>
              <div class="flex-1 min-w-0">
                <div style="font-size:.875rem;font-weight:600;color:#111827;">{{ c.name }}</div>
                <div style="font-size:.72rem;color:#9ca3af;text-transform:capitalize;">{{ c.role }}</div>
              </div>
            </button>
            <p v-if="!filteredPickerUsers.length" style="font-size:.82rem;color:#9ca3af;text-align:center;padding:.75rem;">No users found</p>
          </div>
        </div>

        <div v-if="contactsLoading" class="flex-1 flex items-center justify-center">
          <p style="font-size:.85rem;color:#9ca3af;">Loading…</p>
        </div>
        <div v-else class="flex-1 overflow-y-auto">

          <!-- Active conversations -->
          <template v-if="activeConversations.length">
            <div class="am-section-label">Conversations</div>
            <button
              v-for="c in activeConversations" :key="c.id"
              class="am-contact" :class="{ 'am-contact--active': selected?.id === c.id }"
              @click="selectContact(c)"
            >
              <div class="am-avatar" :style="{ background: c.color }">{{ c.initials }}</div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-0.5">
                  <span style="font-size:.875rem;font-weight:600;color:#111827;">{{ c.name }}</span>
                  <span style="font-size:.7rem;color:#9ca3af;white-space:nowrap;">{{ c.timeAgo }}</span>
                </div>
                <p class="am-preview">{{ c.lastMsg }}</p>
              </div>
              <span v-if="c.unread > 0" class="am-badge">{{ c.unread }}</span>
            </button>
          </template>

          <!-- All other users -->
          <template v-if="filteredOtherUsers.length">
            <div class="am-section-label" style="margin-top:.25rem;">All Users</div>
            <button
              v-for="c in filteredOtherUsers" :key="c.id"
              class="am-contact" :class="{ 'am-contact--active': selected?.id === c.id }"
              @click="selectContact(c)"
            >
              <div class="am-avatar" :style="{ background: c.color }">{{ c.initials }}</div>
              <div class="flex-1 min-w-0">
                <div style="font-size:.875rem;font-weight:600;color:#111827;">{{ c.name }}</div>
                <div style="font-size:.72rem;color:#9ca3af;text-transform:capitalize;">{{ c.role }}</div>
              </div>
            </button>
          </template>

          <p v-if="!activeConversations.length && !filteredOtherUsers.length"
             class="flex-1 flex items-center justify-center"
             style="font-size:.85rem;color:#9ca3af;padding:2rem;text-align:center;">
            No users found
          </p>
        </div>
      </div>

      <!-- ── Chat panel ────────────────────────────────────────── -->
      <div class="flex-1 flex flex-col" style="min-width:0;background:#fff;">

        <div v-if="!selected" class="flex-1 flex flex-col items-center justify-center" style="color:#9ca3af;">
          <svg width="48" height="48" fill="none" viewBox="0 0 24 24" style="margin-bottom:12px;">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
          <p style="font-size:.9rem;">Select a conversation to start messaging</p>
        </div>

        <template v-else>
          <!-- Header -->
          <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid #e5e7eb;flex-shrink:0;">
            <div class="flex items-center gap-3">
              <div class="am-avatar" :style="{ background: selected.color }">{{ selected.initials }}</div>
              <div>
                <div style="font-weight:700;color:#111827;font-size:.95rem;">{{ selected.name }}</div>
                <div style="font-size:.75rem;color:#9ca3af;text-transform:capitalize;">{{ selected.role || 'User' }}</div>
              </div>
            </div>
          </div>

          <!-- Messages -->
          <div class="flex-1 overflow-y-auto px-6 py-5 flex flex-col gap-4" ref="msgsEl">
            <div v-if="msgsLoading" class="flex-1 flex items-center justify-center">
              <p style="font-size:.85rem;color:#9ca3af;">Loading…</p>
            </div>
            <div v-else-if="!messages.length" class="flex-1 flex items-center justify-center">
              <p style="font-size:.85rem;color:#9ca3af;">No messages yet. Say hello!</p>
            </div>
            <div v-else v-for="m in messages" :key="m.id"
                 class="flex flex-col"
                 :class="Number(m.sender_id) === Number(myId) ? 'items-end' : 'items-start'">
              <div class="flex items-end gap-2" :class="Number(m.sender_id) === Number(myId) ? 'flex-row-reverse' : ''">
                <div v-if="Number(m.sender_id) !== Number(myId)"
                     class="am-avatar" style="width:32px;height:32px;font-size:.68rem;flex-shrink:0;"
                     :style="{ background: selected.color }">{{ selected.initials }}</div>
                <div class="am-bubble" :class="Number(m.sender_id) === Number(myId) ? 'am-bubble--mine' : 'am-bubble--theirs'" v-html="m.body"></div>
              </div>
              <span style="font-size:.68rem;color:#9ca3af;margin-top:3px;padding:0 4px;">{{ fmtTime(m.created_at) }}</span>
            </div>
          </div>

          <!-- Compose -->
          <div class="px-5 py-3" style="border-top:1px solid #e5e7eb;flex-shrink:0;" @click.stop>
            <!-- Toolbar -->
            <div class="am-toolbar">
              <button @mousedown.prevent="fmt('bold')" class="am-tb-btn" :class="{ 'am-tb-btn--on': formats.bold }" title="Bold"><strong>B</strong></button>
              <button @mousedown.prevent="fmt('italic')" class="am-tb-btn" :class="{ 'am-tb-btn--on': formats.italic }" title="Italic"><em>I</em></button>
              <button @mousedown.prevent="fmt('underline')" class="am-tb-btn" :class="{ 'am-tb-btn--on': formats.underline }" title="Underline"><u>U</u></button>
              <button @mousedown.prevent="fmt('strikeThrough')" class="am-tb-btn" title="Strike"><s>S</s></button>
              <span class="am-sep"></span>
              <button @mousedown.prevent="fmt('insertUnorderedList')" class="am-tb-btn" title="Bullet list">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
              </button>
              <button @mousedown.prevent="fmt('insertOrderedList')" class="am-tb-btn" title="Numbered list">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24"><line x1="10" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="10" y1="12" x2="21" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="10" y1="18" x2="21" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 6h1v4M4 10h2M4 14v1a1 1 0 001 1h1a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 01-1-1v-1a1 1 0 011-1h1a1 1 0 011 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
              </button>
            </div>
            <!-- Input row -->
            <div class="am-input-bar">
              <div
                ref="editorEl"
                contenteditable="true"
                class="am-editor flex-1"
                data-placeholder="Type a message…"
                @keydown.enter.exact.prevent="send"
                @keyup="updateFormats"
                @mouseup="updateFormats"
              ></div>
              <input ref="photoInputEl" type="file" accept="image/*" style="display:none" @change="onPhotoSelected" />
              <button class="am-icon-btn" title="Upload photo" @click.stop="photoInputEl.click()" :disabled="uploading">
                <svg v-if="!uploading" width="18" height="18" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/><circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/><path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                <svg v-else width="18" height="18" viewBox="0 0 24 24" fill="none" class="am-spin"><circle cx="12" cy="12" r="10" stroke="#d1d5db" stroke-width="2"/><path d="M12 2a10 10 0 0110 10" stroke="#7B1A1A" stroke-width="2" stroke-linecap="round"/></svg>
              </button>
              <div style="position:relative;">
                <button class="am-icon-btn" @click.stop="showEmoji = !showEmoji" title="Emoji">
                  <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M8 14s1.5 2 4 2 4-2 4-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <circle cx="9" cy="10" r="1" fill="currentColor"/><circle cx="15" cy="10" r="1" fill="currentColor"/>
                  </svg>
                </button>
                <div v-if="showEmoji" class="am-emoji-panel" @click.stop>
                  <div v-for="(cat, label) in emojiCategories" :key="label" class="am-emoji-cat">
                    <div class="am-emoji-cat-label">{{ label }}</div>
                    <div class="am-emoji-grid">
                      <button v-for="e in cat" :key="e" class="am-emoji-item" @mousedown.prevent="insertEmoji(e)">{{ e }}</button>
                    </div>
                  </div>
                </div>
              </div>
              <button class="am-send-btn" @click="send" :disabled="!editorHasText">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Send
              </button>
            </div>
          </div>
        </template>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, nextTick, onMounted, onUnmounted } from 'vue'
import AdminLayout from '@/components/admin/AdminLayout.vue'
import { messagesApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()
const myId = computed(() => auth.user?.id)

const COLORS = ['#7B1A1A', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#14b8a6', '#6b7280']
function initials(name) {
  return (name || 'U').split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2)
}
function bodyPreview(html) {
  if (!html) return ''
  if (/<img/i.test(html)) return '📷 Photo'
  return html.replace(/<[^>]+>/g, '').trim()
}

function timeAgo(iso) {
  if (!iso) return ''
  const diff = (Date.now() - new Date(iso)) / 1000
  if (diff < 60)    return 'just now'
  if (diff < 3600)  return `${Math.round(diff / 60)}m ago`
  if (diff < 86400) return `${Math.round(diff / 3600)}h ago`
  return `${Math.round(diff / 86400)}d ago`
}
function fmtTime(iso) {
  if (!iso) return ''
  return new Date(iso).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' })
}

const emojiCategories = {
  'Smileys':   ['😀','😂','😅','😍','🥹','😎','🤔','😢','😭','😤','🥳','😇','🤩','😏','😴'],
  'Gestures':  ['👍','👎','👏','🙏','🤝','✌️','🤞','💪','🙌','👋','🤜','👀'],
  'Hearts':    ['❤️','🧡','💛','💚','💙','💜','🖤','🤍','💕','💯','🔥','✨','⭐','🎉','🎊'],
  'Education': ['📚','📖','✏️','📝','🎓','🏆','💡','🔬','🧪','📊','📈','🖥️','⏰','🗓️'],
}

const contactsLoading = ref(true)
const msgsLoading     = ref(false)
const contacts        = ref([])
const messages        = ref([])
const selected        = ref(null)
const searchQ         = ref('')
const newChatOpen     = ref(false)
const pickerQ         = ref('')
const msgsEl          = ref(null)
const editorEl        = ref(null)
const photoInputEl    = ref(null)
const uploading       = ref(false)
const showEmoji       = ref(false)
const formats         = ref({ bold: false, italic: false, underline: false })

const editorHasText = computed(() => !!(editorEl.value?.innerText?.trim() || editorEl.value?.querySelector('img')))

// Contacts with at least one message
const activeConversations = computed(() => {
  const q = searchQ.value.toLowerCase()
  return contacts.value.filter(c => c.lastMsg && (!q || c.name.toLowerCase().includes(q) || c.lastMsg.toLowerCase().includes(q)))
})

// Contacts with no messages yet (show in "All Users" section)
const filteredOtherUsers = computed(() => {
  const q = searchQ.value.toLowerCase()
  return contacts.value.filter(c => !c.lastMsg && (!q || c.name.toLowerCase().includes(q)))
})

// Picker: all users filtered by pickerQ, excluding already-selected
const filteredPickerUsers = computed(() => {
  const q = pickerQ.value.toLowerCase()
  return contacts.value.filter(c => !q || c.name.toLowerCase().includes(q) || c.role.toLowerCase().includes(q))
})

function fmt(cmd) {
  editorEl.value?.focus()
  document.execCommand(cmd, false, null)
  updateFormats()
}
function updateFormats() {
  formats.value = {
    bold: document.queryCommandState('bold'),
    italic: document.queryCommandState('italic'),
    underline: document.queryCommandState('underline'),
  }
}
function insertEmoji(e) {
  editorEl.value?.focus()
  document.execCommand('insertText', false, e)
  showEmoji.value = false
}

async function onPhotoSelected(ev) {
  const file = ev.target.files?.[0]
  if (!file) return
  ev.target.value = ''
  uploading.value = true
  try {
    const fd = new FormData()
    fd.append('file', file)
    const res = await messagesApi.uploadImage(fd)
    const url = res.data.data?.url
    if (url && editorEl.value) {
      const img = Object.assign(document.createElement('img'), { src: url, className: 'msg-img', alt: 'photo' })
      editorEl.value.appendChild(img)
      editorEl.value.focus()
    }
  } catch (err) {
    console.error('Photo upload failed:', err?.response?.data || err)
  } finally {
    uploading.value = false
  }
}

function scrollBottom() {
  nextTick(() => { if (msgsEl.value) msgsEl.value.scrollTop = msgsEl.value.scrollHeight })
}

onMounted(async () => {
  try {
    const res = await messagesApi.contacts()
    const raw = res.data.data || res.data || []
    contacts.value = raw.map((c, i) => ({
      id:       c.id,
      name:     c.full_name || c.name || 'Unknown',
      initials: initials(c.full_name || c.name),
      color:    COLORS[i % COLORS.length],
      role:     c.role || '',
      lastMsg:  bodyPreview(c.last_message || ''),
      timeAgo:  timeAgo(c.last_message_at),
      unread:   c.unread_count || 0,
    }))
  } finally {
    contactsLoading.value = false
  }
  document.addEventListener('click', () => { showEmoji.value = false; newChatOpen.value = false })
})

onUnmounted(() => document.removeEventListener('click', () => { showEmoji.value = false }))

async function selectContact(c) {
  selected.value = c
  newChatOpen.value = false
  pickerQ.value = ''
  msgsLoading.value = true
  messages.value = []
  if (editorEl.value) editorEl.value.innerHTML = ''
  try {
    const res = await messagesApi.list(c.id)
    messages.value = res.data.data || res.data || []
    c.unread = 0
    scrollBottom()
  } finally { msgsLoading.value = false }
}

function startChat(c) {
  // Move to top of contacts if not already in activeConversations
  selectContact(c)
}

async function send() {
  const html = editorEl.value?.innerHTML?.trim()
  const hasContent = !!(editorEl.value?.innerText?.trim() || editorEl.value?.querySelector('img'))
  if (!hasContent || !selected.value) return
  if (editorEl.value) editorEl.value.innerHTML = ''
  showEmoji.value = false
  try {
    await messagesApi.send({ to_user_id: selected.value.id, body: html })
    const res = await messagesApi.list(selected.value.id)
    messages.value = res.data.data || res.data || []
    const c = contacts.value.find(c => c.id === selected.value.id)
    if (c) { c.lastMsg = bodyPreview(html); c.timeAgo = 'just now' }
    scrollBottom()
  } catch { if (editorEl.value) editorEl.value.innerHTML = html }
}
</script>

<style scoped>
.am-search {
  display: flex; align-items: center; gap: 6px;
  background: #f3f4f6; border-radius: 10px; padding: .45rem .75rem;
}
.am-search-input {
  flex: 1; border: none; background: transparent; outline: none;
  font-size: .83rem; color: #374151;
}
.am-search-input::placeholder { color: #9ca3af; }

.am-new-btn {
  display: flex; align-items: center; justify-content: center; gap: 6px;
  width: 100%; padding: .5rem; border-radius: 8px;
  background: #fef2f2; color: #7B1A1A;
  border: 1.5px dashed #fca5a5; font-size: .82rem; font-weight: 600;
  cursor: pointer; transition: background .15s;
}
.am-new-btn:hover { background: #fee2e2; }

.am-picker {
  background: #fff; border-bottom: 1px solid #e5e7eb;
}
.am-picker-list { max-height: 220px; overflow-y: auto; }

.am-section-label {
  font-size: .62rem; font-weight: 700; color: #9ca3af;
  letter-spacing: .08em; text-transform: uppercase;
  padding: .6rem 1rem .2rem;
}

.am-contact {
  display: flex; align-items: center; gap: 10px;
  width: 100%; padding: .85rem 1rem;
  border: none; background: transparent; cursor: pointer; text-align: left;
  border-bottom: 1px solid #f9fafb; transition: background .1s;
}
.am-contact:hover         { background: #fef9f9; }
.am-contact--active       { background: #fef2f2; border-left: 3px solid #7B1A1A; }

.am-avatar {
  width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: .78rem; font-weight: 700; color: #fff;
}
.am-preview {
  font-size: .78rem; color: #9ca3af;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
  max-width: 190px; margin: 0;
}
.am-badge {
  background: #7B1A1A; color: #fff; font-size: .65rem; font-weight: 700;
  padding: 2px 6px; border-radius: 99px; flex-shrink: 0;
}

.am-bubble {
  max-width: 66%; padding: .65rem 1rem;
  font-size: .875rem; line-height: 1.6; border-radius: 14px;
}
.am-bubble--theirs { background: #f3f4f6; color: #111827; border-bottom-left-radius: 4px; }
.am-bubble--mine   { background: #7B1A1A; color: #fff; border-bottom-right-radius: 4px; }
.am-bubble ul, .am-bubble ol { padding-left: 1.2rem; margin: .2rem 0; }

/* Toolbar */
.am-toolbar {
  display: flex; align-items: center; gap: .15rem;
  padding-bottom: .35rem; margin-bottom: .35rem;
  border-bottom: 1px solid #f0f0f0;
}
.am-tb-btn {
  width: 26px; height: 26px; background: none; border: none; cursor: pointer;
  color: #6b7280; border-radius: 5px; font-size: .82rem;
  display: flex; align-items: center; justify-content: center;
}
.am-tb-btn:hover { background: #f3f4f6; color: #111; }
.am-tb-btn--on   { background: #e5e7eb; color: #111; }
.am-sep { width: 1px; height: 16px; background: #e5e7eb; margin: 0 .2rem; }

/* Input bar */
.am-input-bar {
  display: flex; align-items: center; gap: 8px;
  background: #f3f4f6; border-radius: 12px; padding: .55rem .75rem;
}
.am-editor {
  min-height: 34px; max-height: 100px; overflow-y: auto;
  outline: none; font-size: .875rem; color: #374151;
  font-family: inherit; line-height: 1.5;
}
.am-editor:empty::before { content: attr(data-placeholder); color: #9ca3af; pointer-events: none; }
.am-editor ul, .am-editor ol { padding-left: 1.2rem; margin: .2rem 0; }

.am-icon-btn {
  background: none; border: none; cursor: pointer; color: #9ca3af;
  display: flex; align-items: center; padding: 2px; transition: color .15s;
}
.am-icon-btn:hover { color: #7B1A1A; }

.am-send-btn {
  display: flex; align-items: center; gap: 5px;
  background: #7B1A1A; color: #fff; border: none; padding: .4rem .9rem;
  border-radius: 8px; font-size: .82rem; font-weight: 600; cursor: pointer;
  flex-shrink: 0; transition: background .15s;
}
.am-send-btn:hover:not(:disabled) { background: #6a1616; }
.am-send-btn:disabled { opacity: .4; cursor: not-allowed; }

/* Emoji panel */
.am-emoji-panel {
  position: absolute; bottom: calc(100% + 8px); right: 0;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
  box-shadow: 0 8px 24px rgba(0,0,0,.12); padding: .75rem;
  width: 272px; max-height: 240px; overflow-y: auto; z-index: 50;
}
.am-emoji-cat { margin-bottom: .55rem; }
.am-emoji-cat-label { font-size: .65rem; font-weight: 700; color: #9ca3af; letter-spacing: .06em; text-transform: uppercase; margin-bottom: .3rem; }
.am-emoji-grid { display: flex; flex-wrap: wrap; gap: 2px; }
.am-emoji-item { background: none; border: none; cursor: pointer; font-size: 1.15rem; padding: 3px 4px; border-radius: 6px; line-height: 1; }
.am-emoji-item:hover { background: #f3f4f6; }

.am-bubble :deep(.msg-img) { max-width: 240px; max-height: 180px; border-radius: 8px; display: block; margin-top: .35rem; }
@keyframes am-spin { to { transform: rotate(360deg); } }
.am-spin { animation: am-spin .8s linear infinite; }
</style>
