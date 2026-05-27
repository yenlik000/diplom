<template>
  <TeacherLayout :noPadding="true">
    <template #header-left>
      <h1 class="text-xl font-bold" style="color:#111827;margin:0;">Messages</h1>
    </template>

    <div class="flex" style="height:100%;">

      <!-- ── Left panel ─────────────────────────────────────────── -->
      <div class="flex flex-col" style="width:300px;flex-shrink:0;border-right:1px solid #e5e7eb;background:#fff;">

        <!-- Tab switcher -->
        <div class="tab-bar">
          <button class="tab-btn" :class="{ 'tab-btn--active': tab === 'messages' }" @click="switchTab('messages')">
            Messages
          </button>
          <button class="tab-btn" :class="{ 'tab-btn--active': tab === 'tickets' }" @click="switchTab('tickets')">
            Tickets
            <span v-if="openTicketsCount" class="tab-badge">{{ openTicketsCount }}</span>
          </button>
        </div>

        <!-- ══ MESSAGES TAB ══ -->
        <template v-if="tab === 'messages'">

          <!-- AI Summary card -->
          <div class="ai-card">
            <div class="ai-label">✦ AI Assistant Summary</div>
            <h3 class="ai-title">Class Performance Insight</h3>
            <p class="ai-body">{{ aiInsight }}</p>
            <button class="ai-report-btn">View Detailed Report</button>
          </div>

          <div class="px-4 pt-4 pb-2" style="flex-shrink:0;display:flex;align-items:center;justify-content:space-between;">
            <p class="text-xs font-bold" style="color:#9ca3af;letter-spacing:.09em;margin:0;">ACTIVE CONVERSATIONS</p>
            <button class="tc-new-btn" @click.stop="newMsgOpen = !newMsgOpen" title="New conversation">
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
            </button>
          </div>

          <!-- New conversation picker -->
          <div v-if="newMsgOpen" class="tc-picker" @click.stop>
            <div class="tc-picker-search">
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2"/><path d="M21 21l-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"/></svg>
              <input v-model="newMsgQ" type="text" placeholder="Search users…" class="tc-picker-input" />
            </div>
            <div style="max-height:200px;overflow-y:auto;">
              <button
                v-for="c in filteredPickerContacts" :key="c.id"
                class="contact-row"
                @click="startNewMsg(c)"
              >
                <div class="c-avatar" :style="{ background: c.color }">{{ c.initials }}</div>
                <div class="flex-1 min-w-0">
                  <div class="text-sm font-semibold" style="color:#111827;">{{ c.name }}</div>
                  <div class="text-xs" style="color:#9ca3af;text-transform:capitalize;">{{ c.courseTitle || 'User' }}</div>
                </div>
              </button>
              <p v-if="!filteredPickerContacts.length" style="font-size:.82rem;color:#9ca3af;text-align:center;padding:.75rem;">No users found</p>
            </div>
          </div>

          <div v-if="contactsLoading" class="px-4 space-y-2 flex-1">
            <div v-for="i in 4" :key="i" class="animate-pulse rounded-xl" style="height:64px;background:#f9fafb;"></div>
          </div>

          <div v-else-if="!contacts.length" class="flex-1 flex items-center justify-center text-sm" style="color:#9ca3af;">
            No conversations yet
          </div>

          <div v-else class="flex-1 overflow-y-auto">
            <button
              v-for="c in contacts" :key="c.id"
              class="contact-row" :class="{ 'contact-row--active': selectedContact?.id === c.id }"
              @click="selectContact(c)"
            >
              <div class="c-avatar" :style="{ background: c.color }">{{ c.initials }}</div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-0.5">
                  <span class="text-sm font-semibold" style="color:#111827;">{{ c.name }}</span>
                  <span class="text-xs" style="color:#9ca3af;">{{ c.timeAgo }}</span>
                </div>
                <p class="text-xs truncate" style="color:#9ca3af;max-width:180px;">{{ c.lastMsg || 'No messages yet' }}</p>
              </div>
              <div v-if="c.unread > 0" class="unread-dot"></div>
            </button>
          </div>

        </template>

        <!-- ══ TICKETS TAB ══ -->
        <template v-else>

          <!-- Ticket search -->
          <div class="px-4 pt-4 pb-2" style="flex-shrink:0;">
            <div class="ticket-search">
              <i class="pi pi-search" style="color:#9ca3af;font-size:.8rem;flex-shrink:0;"></i>
              <input v-model="ticketSearch" type="text" placeholder="Search tickets..."
                     class="flex-1 bg-transparent border-0 outline-0 text-sm" style="color:#374151;" />
            </div>
          </div>

          <div v-if="ticketsLoading" class="px-4 space-y-2 flex-1">
            <div v-for="i in 4" :key="i" class="animate-pulse rounded-xl" style="height:80px;background:#f9fafb;"></div>
          </div>

          <div v-else-if="!filteredTickets.length" class="flex-1 flex items-center justify-center text-sm" style="color:#9ca3af;">
            No tickets found
          </div>

          <div v-else class="flex-1 overflow-y-auto">
            <button
              v-for="t in filteredTickets" :key="t.id"
              class="contact-row" :class="{ 'contact-row--active': selectedTicket?.id === t.id }"
              @click="openTicket(t)"
            >
              <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2 mb-1">
                  <span class="text-sm font-bold" :style="{ color: selectedTicket?.id === t.id ? '#7B1A1A' : '#111827' }">
                    {{ t.student_name }}
                  </span>
                  <span class="status-badge" :class="`status-badge--${t.status}`">
                    {{ STATUS_LABELS[t.status] }}
                  </span>
                </div>
                <p class="text-xs font-semibold mb-0.5" style="color:#374151;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ t.title }}</p>
                <p class="text-xs truncate" style="color:#9ca3af;">{{ t.last_message || t.category || 'No messages yet' }}</p>
              </div>
            </button>
          </div>

        </template>
      </div>

      <!-- ── Right panel ────────────────────────────────────────── -->
      <div class="flex-1 flex flex-col" style="min-width:0;background:#fff;">

        <!-- ══ MESSAGES CHAT ══ -->
        <template v-if="tab === 'messages'">

          <div v-if="!selectedContact" class="flex-1 flex flex-col items-center justify-center" style="color:#9ca3af;">
            <i class="pi pi-comments" style="font-size:3rem;display:block;margin-bottom:16px;"></i>
            <p class="text-sm font-medium">Select a conversation</p>
          </div>

          <template v-else>
            <!-- Chat header -->
            <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid #e5e7eb;flex-shrink:0;">
              <div class="flex items-center gap-3">
                <div class="c-avatar" :style="{ background: selectedContact.color }">{{ selectedContact.initials }}</div>
                <div>
                  <div class="font-bold" style="color:#111827;font-size:.95rem;">{{ selectedContact.name }}</div>
                  <div class="text-xs" style="color:#9ca3af;">{{ selectedContact.courseTitle || 'Student' }}</div>
                </div>
              </div>
              <div class="flex items-center gap-1">
                <button class="hdr-icon-btn"><i class="pi pi-video" style="font-size:.95rem;"></i></button>
                <button class="hdr-icon-btn"><i class="pi pi-phone" style="font-size:.95rem;"></i></button>
                <button class="hdr-icon-btn"><i class="pi pi-ellipsis-v" style="font-size:.95rem;"></i></button>
              </div>
            </div>

            <!-- AI context bar -->
            <div v-if="aiContext" class="ai-context-bar" style="flex-shrink:0;">
              <i class="pi pi-info-circle" style="color:#6b7280;font-size:.82rem;flex-shrink:0;"></i>
              <span class="text-sm" style="color:#374151;" v-html="aiContext"></span>
            </div>

            <!-- Messages -->
            <div class="flex-1 overflow-y-auto px-6 py-5 flex flex-col gap-5" ref="messagesEl">
              <div v-if="msgsLoading" class="flex-1 flex items-center justify-center">
                <p class="text-sm" style="color:#9ca3af;">Loading…</p>
              </div>
              <div v-else-if="!messages.length" class="flex-1 flex items-center justify-center">
                <p class="text-sm" style="color:#9ca3af;">No messages yet. Say hello!</p>
              </div>
              <div v-else v-for="m in messages" :key="m.id"
                   class="flex flex-col"
                   :class="Number(m.sender_id) === Number(myId) ? 'items-end' : 'items-start'">
                <div class="flex items-end gap-2" :class="Number(m.sender_id) === Number(myId) ? 'flex-row-reverse' : ''">
                  <div v-if="Number(m.sender_id) !== Number(myId)"
                       class="c-avatar" style="width:34px;height:34px;font-size:.7rem;flex-shrink:0;"
                       :style="{ background: selectedContact.color }">
                    {{ selectedContact.initials }}
                  </div>
                  <div class="msg-bubble" :class="Number(m.sender_id) === Number(myId) ? 'msg--mine' : 'msg--theirs'" v-html="m.body"></div>
                </div>
                <span class="text-xs mt-1" style="color:#9ca3af;padding:0 4px;">{{ fmtTime(m.created_at) }}</span>
              </div>
            </div>

            <!-- Input bar -->
            <div class="px-5 py-3" style="border-top:1px solid #e5e7eb;flex-shrink:0;" @click.stop>
              <!-- Rich text toolbar -->
              <div class="rte-toolbar">
                <button @mousedown.prevent="msgFmt('bold')" class="rte-btn" :class="{ 'rte-btn--on': msgFormats.bold }" title="Bold"><strong>B</strong></button>
                <button @mousedown.prevent="msgFmt('italic')" class="rte-btn" :class="{ 'rte-btn--on': msgFormats.italic }" title="Italic"><em>I</em></button>
                <button @mousedown.prevent="msgFmt('underline')" class="rte-btn" :class="{ 'rte-btn--on': msgFormats.underline }" title="Underline"><u>U</u></button>
                <button @mousedown.prevent="msgFmt('strikeThrough')" class="rte-btn" title="Strike"><s>S</s></button>
                <span class="rte-sep"></span>
                <button @mousedown.prevent="msgFmt('insertUnorderedList')" class="rte-btn" title="Bullet list">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
              </div>
              <div class="input-bar">
                <div
                  ref="msgEditorEl"
                  contenteditable="true"
                  class="rte-editor flex-1"
                  data-placeholder="Type your response..."
                  @keydown.enter.exact.prevent="sendMsg"
                  @keyup="updateMsgFormats"
                  @mouseup="updateMsgFormats"
                ></div>
                <input ref="msgPhotoInputEl" type="file" accept="image/*" style="display:none" @change="onMsgPhotoSelected" />
                <button class="attach-btn" title="Upload photo" @click.stop="msgPhotoInputEl.click()" :disabled="msgUploading">
                  <svg v-if="!msgUploading" width="18" height="18" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/><circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/><path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                  <svg v-else width="18" height="18" viewBox="0 0 24 24" fill="none" class="rte-spin"><circle cx="12" cy="12" r="10" stroke="#d1d5db" stroke-width="2"/><path d="M12 2a10 10 0 0110 10" stroke="#7B1A1A" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <div class="emoji-wrap" style="position:relative;">
                  <button class="emoji-btn" @click.stop="showMsgEmoji = !showMsgEmoji"><i class="pi pi-face-smile" style="font-size:1.1rem;"></i></button>
                  <div v-if="showMsgEmoji" class="tc-emoji-panel" @click.stop>
                    <div v-for="(cat, label) in emojiCategories" :key="label" class="emoji-cat">
                      <div class="emoji-cat-label">{{ label }}</div>
                      <div class="emoji-grid">
                        <button v-for="e in cat" :key="e" class="emoji-item" @mousedown.prevent="insertMsgEmoji(e)">{{ e }}</button>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="send-btn" @click="sendMsg" :disabled="!msgEditorHasText">
                  <i class="pi pi-send" style="font-size:.85rem;"></i>
                </button>
              </div>
              <div class="flex items-center gap-5 mt-2 px-1">
                <button class="action-link" @click="getSuggestedResponse" :disabled="suggestLoading">
                  <span style="color:#7B1A1A;margin-right:3px;">✦</span>
                  {{ suggestLoading ? 'Thinking…' : 'Suggested response' }}
                </button>
                <button class="action-link">Attach solution key</button>
                <button class="action-link">Schedule follow-up</button>
              </div>
            </div>
          </template>

        </template>

        <!-- ══ TICKETS CHAT ══ -->
        <template v-else>

          <div v-if="!selectedTicket" class="flex-1 flex flex-col items-center justify-center" style="color:#9ca3af;">
            <i class="pi pi-ticket" style="font-size:3rem;display:block;margin-bottom:16px;"></i>
            <p class="text-sm font-medium">Select a ticket to view the conversation</p>
          </div>

          <template v-else>
            <!-- Ticket header -->
            <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid #e5e7eb;flex-shrink:0;">
              <div class="flex items-center gap-3">
                <div class="c-avatar" :style="{ background: selectedTicket.color }">{{ selectedTicket.initials }}</div>
                <div>
                  <div class="font-bold" style="color:#111827;font-size:.95rem;">{{ selectedTicket.student_name }}</div>
                  <div class="text-xs" style="color:#9ca3af;">
                    ID: {{ selectedTicket.ticket_no }} • {{ selectedTicket.category || selectedTicket.title }}
                  </div>
                </div>
              </div>
              <div class="flex items-center gap-2">
                <button
                  v-if="selectedTicket.status !== 'resolved'"
                  class="btn-close-ticket"
                  @click="closeTicket"
                  :disabled="ticketClosing"
                >
                  {{ ticketClosing ? 'Closing…' : 'Close Ticket' }}
                </button>
                <button v-else class="btn-reopen" @click="reopenTicket">Reopen</button>
              </div>
            </div>

            <!-- Ticket messages -->
            <div class="flex-1 overflow-y-auto px-6 py-5 flex flex-col gap-5" ref="ticketMsgsEl">
              <div v-if="ticketDetailLoading" class="flex-1 flex items-center justify-center">
                <p class="text-sm" style="color:#9ca3af;">Loading…</p>
              </div>
              <div v-else-if="!ticketMessages.length" class="flex-1 flex items-center justify-center">
                <p class="text-sm" style="color:#9ca3af;">No messages yet in this ticket.</p>
              </div>
              <template v-else>
                <div v-for="m in ticketMessages" :key="m.id"
                     class="flex flex-col"
                     :class="Number(m.sender_id) === Number(myId) ? 'items-end' : 'items-start'">
                  <div class="flex items-end gap-2" :class="Number(m.sender_id) === Number(myId) ? 'flex-row-reverse' : ''">
                    <div v-if="Number(m.sender_id) !== Number(myId)"
                         class="c-avatar" style="width:34px;height:34px;font-size:.7rem;flex-shrink:0;"
                         :style="{ background: selectedTicket.color }">
                      {{ selectedTicket.initials }}
                    </div>
                    <div class="msg-bubble" :class="Number(m.sender_id) === Number(myId) ? 'msg--mine' : 'msg--theirs'" v-html="m.body"></div>
                  </div>
                  <span class="text-xs mt-1" style="color:#9ca3af;padding:0 4px;">{{ fmtTime(m.created_at) }}</span>
                </div>
              </template>
            </div>

            <!-- Ticket input -->
            <div class="px-5 py-3" style="border-top:1px solid #e5e7eb;flex-shrink:0;" @click.stop>
              <div class="rte-toolbar">
                <button @mousedown.prevent="tkFmt('bold')" class="rte-btn" title="Bold"><strong>B</strong></button>
                <button @mousedown.prevent="tkFmt('italic')" class="rte-btn" title="Italic"><em>I</em></button>
                <button @mousedown.prevent="tkFmt('underline')" class="rte-btn" title="Underline"><u>U</u></button>
                <span class="rte-sep"></span>
                <button @mousedown.prevent="tkFmt('insertUnorderedList')" class="rte-btn" title="List">
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <div class="emoji-wrap" style="position:relative;margin-left:auto;">
                  <button class="emoji-btn rte-btn" @click.stop="showTkEmoji = !showTkEmoji"><i class="pi pi-face-smile" style="font-size:1rem;"></i></button>
                  <div v-if="showTkEmoji" class="tc-emoji-panel tc-emoji-panel--right" @click.stop>
                    <div v-for="(cat, label) in emojiCategories" :key="label" class="emoji-cat">
                      <div class="emoji-cat-label">{{ label }}</div>
                      <div class="emoji-grid">
                        <button v-for="e in cat" :key="e" class="emoji-item" @mousedown.prevent="insertTkEmoji(e)">{{ e }}</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="input-bar">
                <div
                  ref="tkEditorEl"
                  contenteditable="true"
                  class="rte-editor flex-1"
                  data-placeholder="Type your response… (Enter to send)"
                  @keydown.enter.exact.prevent="sendTicketMsg"
                  @keydown.ctrl.enter.prevent="sendTicketMsg"
                ></div>
                <input ref="tkPhotoInputEl" type="file" accept="image/*" style="display:none" @change="onTkPhotoSelected" />
                <button class="attach-btn" title="Upload photo" @click.stop="tkPhotoInputEl.click()" :disabled="tkUploading">
                  <svg v-if="!tkUploading" width="18" height="18" fill="none" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/><circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"/><path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                  <svg v-else width="18" height="18" viewBox="0 0 24 24" fill="none" class="rte-spin"><circle cx="12" cy="12" r="10" stroke="#d1d5db" stroke-width="2"/><path d="M12 2a10 10 0 0110 10" stroke="#7B1A1A" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <button class="send-btn" @click="sendTicketMsg" :disabled="!tkEditorHasText || ticketSending">
                  <i class="pi pi-send" style="font-size:.85rem;"></i>
                </button>
              </div>
            </div>
          </template>

        </template>

      </div>
    </div>
  </TeacherLayout>
</template>

<script setup>
import { ref, computed, nextTick, onMounted, onUnmounted } from 'vue'
import TeacherLayout from '@/components/teacher/TeacherLayout.vue'
import { messagesApi, ticketsApi, aiApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

// ── Photo upload helpers (shared) ─────────────────────────────
async function uploadImageToEditor(editorRef, inputRef) {
  const file = inputRef.value?.files?.[0]
  if (!file) return
  inputRef.value.value = ''
  try {
    const fd = new FormData()
    fd.append('file', file)
    const res = await messagesApi.uploadImage(fd)
    const url = res.data.data?.url
    if (url && editorRef.value) {
      const img = Object.assign(document.createElement('img'), { src: url, className: 'msg-img', alt: 'photo' })
      editorRef.value.appendChild(img)
      editorRef.value.focus()
    }
  } catch (err) {
    console.error('Photo upload failed:', err?.response?.data || err)
  }
}

const auth  = useAuthStore()
const myId  = computed(() => auth.user?.id)

const COLORS = ['#7B1A1A', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#14b8a6', '#6b7280']
const colorMap = {}
function colorFor(id) {
  if (!colorMap[id]) colorMap[id] = COLORS[Object.keys(colorMap).length % COLORS.length]
  return colorMap[id]
}
function initials(name) {
  return (name || 'U').split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2)
}

function bodyPreview(html) {
  if (!html) return ''
  if (/<img/i.test(html)) return '📷 Photo'
  return html.replace(/<[^>]+>/g, '').trim()
}

// ── Tab ──────────────────────────────────────────────────────
const tab = ref('messages')

function switchTab(t) {
  tab.value = t
  if (t === 'tickets' && !tickets.value.length && !ticketsLoading.value) loadTickets()
}

// ── Helpers ──────────────────────────────────────────────────
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

// ── Emoji & Rich Text ─────────────────────────────────────────
const emojiCategories = {
  'Smileys':   ['😀','😂','😅','😍','🥹','😎','🤔','😢','😭','😤','🥳','😇','🤩','😏','😴'],
  'Gestures':  ['👍','👎','👏','🙏','🤝','✌️','🤞','💪','🙌','👋','🤜','👀'],
  'Hearts':    ['❤️','🧡','💛','💚','💙','💜','🖤','🤍','💕','💯','🔥','✨','⭐','🎉','🎊'],
  'Education': ['📚','📖','✏️','📝','🎓','🏆','💡','🔬','🧪','📊','📈','🖥️','⏰','🗓️'],
}

// Messages editor
const msgEditorEl      = ref(null)
const msgPhotoInputEl  = ref(null)
const msgUploading     = ref(false)
const showMsgEmoji     = ref(false)
const msgFormats       = ref({ bold: false, italic: false, underline: false })
const msgEditorHasText = computed(() => !!(msgEditorEl.value?.innerText?.trim() || msgEditorEl.value?.querySelector('img')))

function msgFmt(cmd) { msgEditorEl.value?.focus(); document.execCommand(cmd, false, null); updateMsgFormats() }
function updateMsgFormats() {
  msgFormats.value = { bold: document.queryCommandState('bold'), italic: document.queryCommandState('italic'), underline: document.queryCommandState('underline') }
}
function insertMsgEmoji(e) { msgEditorEl.value?.focus(); document.execCommand('insertText', false, e); showMsgEmoji.value = false }
async function onMsgPhotoSelected() {
  msgUploading.value = true
  await uploadImageToEditor(msgEditorEl, msgPhotoInputEl)
  msgUploading.value = false
}

// Ticket editor
const tkEditorEl       = ref(null)
const tkPhotoInputEl   = ref(null)
const tkUploading      = ref(false)
const showTkEmoji      = ref(false)
const tkEditorHasText  = computed(() => !!(tkEditorEl.value?.innerText?.trim() || tkEditorEl.value?.querySelector('img')))

function tkFmt(cmd)  { tkEditorEl.value?.focus(); document.execCommand(cmd, false, null) }
function insertTkEmoji(e) { tkEditorEl.value?.focus(); document.execCommand('insertText', false, e); showTkEmoji.value = false }
async function onTkPhotoSelected() {
  tkUploading.value = true
  await uploadImageToEditor(tkEditorEl, tkPhotoInputEl)
  tkUploading.value = false
}

function closeEmojis() { showMsgEmoji.value = false; showTkEmoji.value = false; newMsgOpen.value = false }

// ── New conversation (messages tab) ──────────────────────────
const newMsgOpen = ref(false)
const newMsgQ    = ref('')

const filteredPickerContacts = computed(() => {
  const q = newMsgQ.value.toLowerCase()
  return contacts.value.filter(c => !q || c.name.toLowerCase().includes(q) || (c.courseTitle || '').toLowerCase().includes(q))
})

function startNewMsg(c) {
  selectContact(c)
  newMsgOpen.value = false
  newMsgQ.value = ''
}

// ── MESSAGES state ────────────────────────────────────────────
const contactsLoading = ref(true)
const msgsLoading     = ref(false)
const contacts        = ref([])
const messages        = ref([])
const selectedContact = ref(null)
const messagesEl      = ref(null)
const aiInsight       = ref('Analyzing recent student conversations...')
const aiContext       = ref('')
const suggestLoading  = ref(false)

function scrollMsgsBottom() {
  nextTick(() => { if (messagesEl.value) messagesEl.value.scrollTop = messagesEl.value.scrollHeight })
}

onMounted(async () => {
  try {
    const res = await messagesApi.contacts()
    const raw = res.data.data || res.data || []
    contacts.value = raw.map((c, i) => ({
      id:          c.id,
      name:        c.full_name || c.name || 'Unknown',
      initials:    initials(c.full_name || c.name),
      color:       COLORS[i % COLORS.length],
      lastMsg:     bodyPreview(c.last_message || ''),
      lastMsgAt:   c.last_message_at || null,
      timeAgo:     timeAgo(c.last_message_at),
      unread:      c.unread_count || 0,
      courseTitle: c.course_title || 'Student',
    }))
    generateAIInsight(raw)
  } finally {
    contactsLoading.value = false
  }
  document.addEventListener('click', closeEmojis)
})

onUnmounted(() => document.removeEventListener('click', closeEmojis))

async function generateAIInsight(raw) {
  const snippets = raw.filter(c => c.last_message).slice(0, 5)
    .map(c => `${c.full_name || c.name}: "${c.last_message}"`).join('\n')
  if (!snippets) { aiInsight.value = 'No recent student messages to analyze yet.'; return }
  try {
    const res = await aiApi.chat({ message: `You are a teacher assistant. Based on these recent student messages, write ONE concise sentence (max 15 words) summarizing a common academic struggle:\n${snippets}\nRespond with just the insight sentence.` })
    aiInsight.value = (res.data.data?.reply || res.data.reply || '').trim() || 'Students are actively engaging with course material.'
  } catch { aiInsight.value = 'Students are actively engaging with course material.' }
}

async function selectContact(c) {
  selectedContact.value = c
  aiContext.value = ''
  msgsLoading.value = true
  messages.value = []
  if (msgEditorEl.value) msgEditorEl.value.innerHTML = ''
  try {
    const res = await messagesApi.list(c.id)
    messages.value = res.data.data || res.data || []
    c.unread = 0
    scrollMsgsBottom()
    detectTopic()
  } finally { msgsLoading.value = false }
}

async function detectTopic() {
  const studentMsgs = messages.value.filter(m => m.sender_id !== myId.value).slice(-3)
    .map(m => (m.body || '').replace(/<[^>]+>/g, '')).join(' ')
  if (!studentMsgs.trim()) return
  try {
    const res = await aiApi.chat({ message: `Based on this student's message, identify the academic topic in 3-5 words (e.g. "Quadratic Formula application"): "${studentMsgs.slice(0, 300)}"\nRespond ONLY with the topic phrase, nothing else.` })
    const topic = (res.data.data?.reply || res.data.reply || '').trim().replace(/[."]/g, '')
    if (topic && selectedContact.value) {
      aiContext.value = `${selectedContact.value.name.split(' ')[0]} is asking about the <strong>${topic}</strong>.`
    }
  } catch {}
}

async function sendMsg() {
  const html = msgEditorEl.value?.innerHTML?.trim()
  const hasContent = !!(msgEditorEl.value?.innerText?.trim() || msgEditorEl.value?.querySelector('img'))
  if (!hasContent || !selectedContact.value) return
  if (msgEditorEl.value) msgEditorEl.value.innerHTML = ''
  showMsgEmoji.value = false
  try {
    await messagesApi.send({ to_user_id: selectedContact.value.id, body: html })
    const refreshed = await messagesApi.list(selectedContact.value.id)
    messages.value = refreshed.data.data || refreshed.data || []
    const c = contacts.value.find(c => c.id === selectedContact.value.id)
    if (c) { c.lastMsg = bodyPreview(html); c.timeAgo = 'just now' }
    scrollMsgsBottom()
  } catch { if (msgEditorEl.value) msgEditorEl.value.innerHTML = html }
}

async function getSuggestedResponse() {
  if (!selectedContact.value || !messages.value.length) return
  suggestLoading.value = true
  try {
    const history = messages.value.slice(-6).map(m => `${m.sender_id === myId.value ? 'Teacher' : 'Student'}: ${(m.body || '').replace(/<[^>]+>/g, '')}`).join('\n')
    const res = await aiApi.chat({ message: `You are a helpful teacher. Based on this conversation, write a brief, helpful teacher response (2-3 sentences max):\n${history}\nTeacher:` })
    const reply = (res.data.data?.reply || res.data.reply || '').trim()
    if (reply && msgEditorEl.value) { msgEditorEl.value.innerHTML = reply; msgEditorEl.value.focus() }
  } catch {} finally { suggestLoading.value = false }
}

// ── TICKETS state ─────────────────────────────────────────────
const STATUS_LABELS = { open: 'OPEN', in_progress: 'IN PROGRESS', resolved: 'RESOLVED' }

const ticketsLoading     = ref(false)
const ticketDetailLoading = ref(false)
const ticketSending      = ref(false)
const ticketClosing      = ref(false)
const tickets            = ref([])
const selectedTicket     = ref(null)
const ticketMessages     = ref([])
const ticketSearch       = ref('')
const ticketMsgsEl       = ref(null)

const filteredTickets = computed(() => {
  const q = ticketSearch.value.toLowerCase()
  return q
    ? tickets.value.filter(t =>
        t.student_name.toLowerCase().includes(q) ||
        t.title.toLowerCase().includes(q) ||
        (t.last_message || '').toLowerCase().includes(q)
      )
    : tickets.value
})

const openTicketsCount = computed(() =>
  tickets.value.filter(t => t.status !== 'resolved').length
)

function scrollTicketsBottom() {
  nextTick(() => { if (ticketMsgsEl.value) ticketMsgsEl.value.scrollTop = ticketMsgsEl.value.scrollHeight })
}

async function loadTickets() {
  ticketsLoading.value = true
  try {
    const res = await ticketsApi.list()
    tickets.value = (res.data.data || []).map(t => ({
      ...t,
      color:    colorFor(t.student_id),
      initials: initials(t.student_name),
    }))
  } finally { ticketsLoading.value = false }
}

async function openTicket(t) {
  selectedTicket.value = t
  ticketDetailLoading.value = true
  ticketMessages.value = []
  try {
    const res = await ticketsApi.get(t.id)
    const d = res.data.data
    selectedTicket.value = { ...t, ...d, color: t.color, initials: t.initials }
    ticketMessages.value = d.messages || []
    scrollTicketsBottom()
  } finally { ticketDetailLoading.value = false }
}

async function sendTicketMsg() {
  const html = tkEditorEl.value?.innerHTML?.trim()
  const hasContent = !!(tkEditorEl.value?.innerText?.trim() || tkEditorEl.value?.querySelector('img'))
  if (!hasContent || !selectedTicket.value) return
  if (tkEditorEl.value) tkEditorEl.value.innerHTML = ''
  showTkEmoji.value = false
  ticketSending.value = true
  try {
    const res = await ticketsApi.addMessage(selectedTicket.value.id, html)
    const msg = res.data.data || { id: Date.now(), sender_id: myId.value, body: html, created_at: new Date().toISOString() }
    ticketMessages.value.push(msg)
    if (selectedTicket.value.status === 'open') {
      selectedTicket.value.status = 'in_progress'
      const t = tickets.value.find(t => t.id === selectedTicket.value.id)
      if (t) t.status = 'in_progress'
    }
    const t = tickets.value.find(t => t.id === selectedTicket.value.id)
    if (t) { t.last_message = bodyPreview(html) }
    scrollTicketsBottom()
  } catch { if (tkEditorEl.value) tkEditorEl.value.innerHTML = html }
  finally { ticketSending.value = false }
}

async function closeTicket() {
  if (!selectedTicket.value) return
  ticketClosing.value = true
  try {
    await ticketsApi.updateStatus(selectedTicket.value.id, 'resolved')
    selectedTicket.value.status = 'resolved'
    const t = tickets.value.find(t => t.id === selectedTicket.value.id)
    if (t) t.status = 'resolved'
  } finally { ticketClosing.value = false }
}

async function reopenTicket() {
  if (!selectedTicket.value) return
  await ticketsApi.updateStatus(selectedTicket.value.id, 'open')
  selectedTicket.value.status = 'open'
  const t = tickets.value.find(t => t.id === selectedTicket.value.id)
  if (t) t.status = 'open'
}
</script>

<style scoped>
/* Tab switcher */
.tab-bar {
  display: flex;
  border-bottom: 1px solid #e5e7eb;
  flex-shrink: 0;
}
.tab-btn {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  padding: 13px 0;
  background: none;
  border: none;
  border-bottom: 2px solid transparent;
  font-size: .875rem;
  font-weight: 600;
  color: #6b7280;
  cursor: pointer;
  transition: color .15s, border-color .15s;
  margin-bottom: -1px;
}
.tab-btn:hover { color: #374151; }
.tab-btn--active { color: #7B1A1A; border-bottom-color: #7B1A1A; }

.tab-badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 18px;
  height: 18px;
  padding: 0 4px;
  background: #7B1A1A;
  color: #fff;
  border-radius: 9999px;
  font-size: .65rem;
  font-weight: 700;
}

/* Ticket search */
.ticket-search {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #f3f4f6;
  border-radius: 9999px;
  padding: .45rem .85rem;
}

/* Status badges */
.status-badge {
  font-size: .6rem;
  font-weight: 700;
  padding: .15rem .45rem;
  border-radius: 9999px;
  white-space: nowrap;
  flex-shrink: 0;
}
.status-badge--in_progress { background: #7B1A1A; color: #fff; }
.status-badge--open        { background: transparent; color: #6b7280; border: 1px solid #d1d5db; }
.status-badge--resolved    { background: #f3f4f6; color: #6b7280; }

/* Close / Reopen buttons */
.btn-close-ticket {
  padding: .4rem .9rem;
  border: none; border-radius: 8px;
  background: #7B1A1A; color: #fff;
  font-size: .82rem; font-weight: 600; cursor: pointer;
  transition: background .15s;
}
.btn-close-ticket:hover:not(:disabled) { background: #6a1616; }
.btn-close-ticket:disabled { opacity: .5; cursor: not-allowed; }
.btn-reopen {
  padding: .4rem .9rem;
  border: 1.5px solid #10b981; border-radius: 8px;
  background: #fff; color: #10b981;
  font-size: .82rem; font-weight: 600; cursor: pointer;
}

/* AI Summary card */
.ai-card {
  margin: 16px;
  background: #7B1A1A;
  border-radius: 14px;
  padding: 18px;
  flex-shrink: 0;
}
.ai-label { font-size: .72rem; font-weight: 700; color: rgba(255,255,255,.65); letter-spacing: .05em; margin-bottom: 6px; }
.ai-title { font-size: 1rem; font-weight: 800; color: #fff; margin: 0 0 8px; }
.ai-body  { font-size: .82rem; color: rgba(255,255,255,.8); line-height: 1.5; margin: 0 0 14px; }
.ai-report-btn {
  width: 100%; padding: .5rem;
  background: rgba(255,255,255,.15); border: 1.5px solid rgba(255,255,255,.35);
  border-radius: 8px; color: #fff;
  font-size: .82rem; font-weight: 600; cursor: pointer;
  transition: background .15s;
}
.ai-report-btn:hover { background: rgba(255,255,255,.25); }

/* Contact row (shared for both tabs) */
.contact-row {
  display: flex; align-items: center; gap: 10px;
  width: 100%; padding: 12px 16px;
  border: none; background: transparent; cursor: pointer; text-align: left;
  border-bottom: 1px solid #f9fafb;
  transition: background .1s;
}
.contact-row:hover         { background: #fef9f9; }
.contact-row--active       { background: #fef2f2; border-left: 3px solid #7B1A1A; }

.c-avatar {
  width: 40px; height: 40px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: .78rem; font-weight: 700; color: #fff; flex-shrink: 0;
}
.unread-dot {
  width: 9px; height: 9px; border-radius: 50%;
  background: #7B1A1A; flex-shrink: 0;
}

/* Chat header icons */
.hdr-icon-btn {
  width: 36px; height: 36px; border: none; background: transparent;
  border-radius: 8px; display: flex; align-items: center; justify-content: center;
  color: #6b7280; cursor: pointer; transition: background .15s;
}
.hdr-icon-btn:hover { background: #f3f4f6; color: #111827; }

/* AI context bar */
.ai-context-bar {
  display: flex; align-items: center; gap: 8px;
  margin: 12px 24px 0;
  background: #f9fafb; border: 1px solid #e5e7eb;
  border-radius: 9999px; padding: .4rem 1rem;
  font-size: .82rem;
}

/* Message bubbles */
.msg-bubble {
  max-width: 68%; padding: .7rem 1rem;
  font-size: .875rem; line-height: 1.6; border-radius: 14px;
}
.msg--theirs { background: #f3f4f6; color: #111827; border-bottom-left-radius: 4px; }
.msg--mine   { background: #7B1A1A; color: #fff; border-bottom-right-radius: 4px; }

/* Rich text toolbar */
.rte-toolbar {
  display: flex; align-items: center; gap: .15rem;
  padding: .35rem 0 .35rem; margin-bottom: .35rem;
  border-bottom: 1px solid #f0f0f0;
}
.rte-btn {
  width: 26px; height: 26px; background: none; border: none; cursor: pointer;
  color: #6b7280; border-radius: 5px; font-size: .82rem;
  display: flex; align-items: center; justify-content: center;
}
.rte-btn:hover { background: #f3f4f6; color: #111; }
.rte-btn--on   { background: #e5e7eb; color: #111; }
.rte-sep { width: 1px; height: 16px; background: #e5e7eb; margin: 0 .2rem; }

.rte-editor {
  min-height: 36px; max-height: 100px; overflow-y: auto;
  outline: none; font-size: .875rem; color: #374151;
  font-family: inherit; line-height: 1.5; padding: .1rem 0;
}
.rte-editor:empty::before { content: attr(data-placeholder); color: #9ca3af; pointer-events: none; }
.rte-editor ul, .rte-editor ol { padding-left: 1.2rem; margin: .2rem 0; }

/* Emoji panel (teacher) */
.tc-emoji-panel {
  position: absolute; bottom: calc(100% + 8px); left: 0;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 14px;
  box-shadow: 0 8px 24px rgba(0,0,0,.12); padding: .75rem;
  width: 272px; max-height: 240px; overflow-y: auto; z-index: 50;
}
.tc-emoji-panel--right { left: auto; right: 0; }
.emoji-cat { margin-bottom: .55rem; }
.emoji-cat-label { font-size: .65rem; font-weight: 700; color: #9ca3af; letter-spacing: .06em; text-transform: uppercase; margin-bottom: .3rem; }
.emoji-grid { display: flex; flex-wrap: wrap; gap: 2px; }
.emoji-item { background: none; border: none; cursor: pointer; font-size: 1.15rem; padding: 3px 4px; border-radius: 6px; line-height: 1; }
.emoji-item:hover { background: #f3f4f6; }

/* Input bar */
.input-bar {
  display: flex; align-items: center; gap: 8px;
  background: #f3f4f6; border-radius: 12px; padding: .5rem .75rem;
}
.attach-btn, .emoji-btn {
  background: none; border: none; cursor: pointer;
  color: #9ca3af; display: flex; align-items: center; transition: color .15s;
}
.attach-btn:hover, .emoji-btn:hover { color: #7B1A1A; }
.send-btn {
  width: 36px; height: 36px;
  background: #7B1A1A; border: none; border-radius: 8px;
  color: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; transition: background .15s;
}
.send-btn:hover:not(:disabled) { background: #6a1616; }
.send-btn:disabled { opacity: .4; cursor: not-allowed; }

/* New conversation button & picker */
.tc-new-btn {
  width: 24px; height: 24px; border-radius: 6px;
  background: #fef2f2; border: 1.5px solid #fca5a5;
  color: #7B1A1A; display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: background .15s;
}
.tc-new-btn:hover { background: #fee2e2; }

.tc-picker { background: #fff; border-bottom: 1px solid #e5e7eb; flex-shrink: 0; }
.tc-picker-search {
  display: flex; align-items: center; gap: 6px;
  background: #f3f4f6; border-radius: 9999px;
  padding: .4rem .75rem; margin: .5rem .75rem .3rem;
}
.tc-picker-input { border: none; background: transparent; outline: none; font-size: .82rem; color: #374151; flex: 1; }
.tc-picker-input::placeholder { color: #9ca3af; }

/* Images in bubbles */
.msg-bubble :deep(.msg-img) { max-width: 240px; max-height: 180px; border-radius: 8px; display: block; margin-top: .35rem; }
@keyframes rte-spin { to { transform: rotate(360deg); } }
.rte-spin { animation: rte-spin .8s linear infinite; }

/* Action links */
.action-link {
  background: none; border: none; cursor: pointer;
  font-size: .78rem; font-weight: 500; color: #6b7280; padding: 0;
  transition: color .15s; display: flex; align-items: center; gap: 2px;
}
.action-link:hover:not(:disabled) { color: #7B1A1A; }
.action-link:disabled { opacity: .5; cursor: not-allowed; }
</style>
