<template>
  <TeacherLayout :noPadding="true">
    <template #header-left>
      <h1 class="text-xl font-bold" style="color:#111827;margin:0;">Support Tickets</h1>
    </template>

    <div class="flex" style="height:100%;">

      <!-- ── Left panel: ticket list ───────────────────────────── -->
      <div class="left-panel">

        <!-- Search -->
        <div class="px-5 pt-5 pb-3" style="flex-shrink:0;">
          <div class="search-bar">
            <i class="pi pi-search" style="color:#9ca3af;font-size:.8rem;flex-shrink:0;"></i>
            <input v-model="search" type="text" placeholder="Search tickets..."
                   class="flex-1 bg-transparent border-0 outline-0 text-sm" style="color:#374151;" />
          </div>
        </div>

        <!-- Loading -->
        <div v-if="loading" class="px-4 space-y-3 flex-1">
          <div v-for="i in 4" :key="i" class="animate-pulse rounded-xl" style="height:90px;background:#f9fafb;"></div>
        </div>

        <!-- Empty -->
        <div v-else-if="!filtered.length" class="flex-1 flex items-center justify-center text-sm" style="color:#9ca3af;">
          No tickets found
        </div>

        <!-- List -->
        <div v-else class="flex-1 overflow-y-auto">
          <button
            v-for="t in filtered" :key="t.id"
            class="ticket-row" :class="{ 'ticket-row--active': selected?.id === t.id }"
            @click="openTicket(t)"
          >
            <div class="flex items-start justify-between gap-2 mb-1">
              <span class="text-sm font-bold"
                    :style="{ color: selected?.id === t.id ? '#7B1A1A' : '#111827' }">
                {{ t.student_name }}
              </span>
              <span class="status-badge" :class="`status-badge--${t.status}`">
                {{ STATUS_LABELS[t.status] }}
              </span>
            </div>
            <p class="text-sm font-semibold mb-1" style="color:#111827;">{{ t.title }}</p>
            <p class="text-xs truncate mb-1" style="color:#9ca3af;">{{ t.last_message || t.category || 'No messages yet' }}</p>
            <p class="text-xs" :style="{ color: t.hours_ago <= 1 ? '#7B1A1A' : '#9ca3af' }">
              {{ formatAgo(t.hours_ago) }}
            </p>
          </button>
        </div>
      </div>

      <!-- ── Right panel: ticket detail ────────────────────────── -->
      <div class="flex-1 flex flex-col" style="min-width:0;border-left:1px solid #e5e7eb;">

        <!-- Empty state -->
        <div v-if="!selected" class="flex-1 flex flex-col items-center justify-center" style="color:#9ca3af;">
          <i class="pi pi-ticket" style="font-size:3rem;display:block;margin-bottom:16px;"></i>
          <p class="text-sm font-medium">Select a ticket to view the conversation</p>
        </div>

        <template v-else>

          <!-- Ticket header -->
          <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid #e5e7eb;flex-shrink:0;">
            <div class="flex items-center gap-3">
              <div class="t-avatar" :style="{ background: selected.color }">
                {{ selected.initials }}
              </div>
              <div>
                <div class="font-bold" style="color:#111827;font-size:.95rem;">{{ selected.student_name }}</div>
                <div class="text-xs" style="color:#9ca3af;">
                  ID: {{ selected.ticket_no }} • {{ selected.category || selected.title }}
                </div>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <button class="btn-assign" @click="assignTeam">Assign Team</button>
              <button
                v-if="selected.status !== 'resolved'"
                class="btn-close-ticket"
                @click="closeTicket"
                :disabled="closing"
              >
                {{ closing ? 'Closing…' : 'Close Ticket' }}
              </button>
              <button
                v-else
                class="btn-reopen"
                @click="reopenTicket"
              >
                Reopen
              </button>
            </div>
          </div>

          <!-- Messages -->
          <div class="flex-1 overflow-y-auto px-6 py-5 flex flex-col gap-5" ref="msgsEl">
            <div v-if="detailLoading" class="flex-1 flex items-center justify-center">
              <p class="text-sm" style="color:#9ca3af;">Loading…</p>
            </div>

            <div v-else-if="!messages.length" class="flex-1 flex items-center justify-center">
              <p class="text-sm" style="color:#9ca3af;">No messages yet in this ticket.</p>
            </div>

            <template v-else>
              <div v-for="m in messages" :key="m.id"
                   class="flex flex-col"
                   :class="m.sender_id === myId ? 'items-end' : 'items-start'">
                <div class="flex items-end gap-2"
                     :class="m.sender_id === myId ? 'flex-row-reverse' : ''">
                  <div v-if="m.sender_id !== myId"
                       class="t-avatar" style="width:34px;height:34px;font-size:.7rem;flex-shrink:0;"
                       :style="{ background: selected.color }">
                    {{ selected.initials }}
                  </div>
                  <div class="msg-bubble"
                       :class="m.sender_id === myId ? 'msg--mine' : 'msg--theirs'">
                    {{ m.body }}
                  </div>
                </div>
                <span class="text-xs mt-1" style="color:#9ca3af;padding:0 4px;">
                  {{ fmtTime(m.created_at) }}
                </span>
              </div>
            </template>
          </div>

          <!-- Input -->
          <div class="px-5 py-4" style="border-top:1px solid #e5e7eb;flex-shrink:0;">
            <div class="input-wrap">
              <textarea
                v-model="draft"
                rows="3"
                placeholder="Type your response..."
                class="flex-1 bg-transparent border-0 outline-0 text-sm resize-none"
                style="color:#374151;font-family:inherit;"
                @keydown.ctrl.enter="sendMsg"
                @keydown.meta.enter="sendMsg"
              ></textarea>
              <button class="send-btn" @click="sendMsg" :disabled="!draft.trim() || sending">
                <i class="pi pi-send" style="font-size:.85rem;"></i>
              </button>
            </div>
          </div>

        </template>
      </div>
    </div>
  </TeacherLayout>
</template>

<script setup>
import { ref, computed, nextTick, onMounted } from 'vue'
import TeacherLayout from '@/components/teacher/TeacherLayout.vue'
import { ticketsApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()
const myId = computed(() => auth.user?.id)

const STATUS_LABELS = { open: 'OPEN', in_progress: 'IN PROGRESS', resolved: 'RESOLVED' }

const COLORS = ['#7B1A1A', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#14b8a6', '#6b7280']
const colorMap = {}
function colorFor(id) {
  if (!colorMap[id]) colorMap[id] = COLORS[Object.keys(colorMap).length % COLORS.length]
  return colorMap[id]
}
function initials(name) {
  return (name || 'U').split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2)
}

// ── State ────────────────────────────────────────────────────
const loading     = ref(true)
const detailLoading = ref(false)
const sending     = ref(false)
const closing     = ref(false)
const tickets     = ref([])
const selected    = ref(null)
const messages    = ref([])
const search      = ref('')
const draft       = ref('')
const msgsEl      = ref(null)

// ── Computed ─────────────────────────────────────────────────
const filtered = computed(() => {
  const q = search.value.toLowerCase()
  return q
    ? tickets.value.filter(t =>
        t.student_name.toLowerCase().includes(q) ||
        t.title.toLowerCase().includes(q) ||
        (t.last_message || '').toLowerCase().includes(q)
      )
    : tickets.value
})

// ── Helpers ──────────────────────────────────────────────────
function formatAgo(hours) {
  if (hours < 0.017) return 'just now'
  if (hours < 1)    return `${Math.round(hours * 60)} mins ago`
  if (hours < 24)   return `${Math.round(hours)} hours ago`
  const d = Math.floor(hours / 24)
  return d === 1 ? 'Yesterday' : `${d} days ago`
}
function fmtTime(iso) {
  if (!iso) return ''
  return new Date(iso).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' })
}
function scrollBottom() {
  nextTick(() => {
    if (msgsEl.value) msgsEl.value.scrollTop = msgsEl.value.scrollHeight
  })
}

// ── Load tickets ─────────────────────────────────────────────
onMounted(async () => {
  try {
    const res = await ticketsApi.list()
    tickets.value = (res.data.data || []).map(t => ({
      ...t,
      color:    colorFor(t.student_id),
      initials: initials(t.student_name),
    }))
    // Auto-select first ticket if any
    if (tickets.value.length) openTicket(tickets.value[0])
  } finally {
    loading.value = false
  }
})

// ── Open ticket ──────────────────────────────────────────────
async function openTicket(t) {
  selected.value   = t
  detailLoading.value = true
  messages.value   = []
  try {
    const res = await ticketsApi.get(t.id)
    const d   = res.data.data
    // Merge any detail fields back (ticket_no, etc.)
    selected.value = { ...t, ...d }
    messages.value = d.messages || []
    scrollBottom()
  } finally {
    detailLoading.value = false
  }
}

// ── Send message ─────────────────────────────────────────────
async function sendMsg() {
  if (!draft.value.trim() || !selected.value) return
  const body = draft.value.trim()
  draft.value = ''
  sending.value = true
  try {
    const res = await ticketsApi.addMessage(selected.value.id, body)
    const msg = res.data.data || { id: Date.now(), sender_id: myId.value, body, created_at: new Date().toISOString() }
    messages.value.push(msg)
    // Update status to in_progress locally
    if (selected.value.status === 'open') {
      selected.value.status = 'in_progress'
      const t = tickets.value.find(t => t.id === selected.value.id)
      if (t) t.status = 'in_progress'
    }
    // Update last_message on list
    const t = tickets.value.find(t => t.id === selected.value.id)
    if (t) { t.last_message = body; t.hours_ago = 0 }
    scrollBottom()
  } catch {
    draft.value = body
  } finally {
    sending.value = false
  }
}

// ── Close ticket ─────────────────────────────────────────────
async function closeTicket() {
  if (!selected.value) return
  closing.value = true
  try {
    await ticketsApi.updateStatus(selected.value.id, 'resolved')
    selected.value.status = 'resolved'
    const t = tickets.value.find(t => t.id === selected.value.id)
    if (t) t.status = 'resolved'
  } finally {
    closing.value = false
  }
}

async function reopenTicket() {
  if (!selected.value) return
  await ticketsApi.updateStatus(selected.value.id, 'open')
  selected.value.status = 'open'
  const t = tickets.value.find(t => t.id === selected.value.id)
  if (t) t.status = 'open'
}

function assignTeam() {
  // Placeholder — no team management in MVP
  alert('Team assignment feature coming soon.')
}
</script>

<style scoped>
/* Left panel */
.left-panel {
  width: 340px;
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  border-right: 1px solid #e5e7eb;
  background: #fff;
}

/* Search */
.search-bar {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #f3f4f6;
  border-radius: 9999px;
  padding: .5rem 1rem;
}

/* Ticket row */
.ticket-row {
  width: 100%;
  text-align: left;
  padding: 14px 20px;
  border: none;
  background: transparent;
  border-bottom: 1px solid #f3f4f6;
  cursor: pointer;
  transition: background .1s;
}
.ticket-row:hover         { background: #fef9f9; }
.ticket-row--active       { background: #fef2f2; border-left: 3px solid #7B1A1A; }

/* Status badge */
.status-badge {
  font-size: .65rem;
  font-weight: 700;
  padding: .2rem .55rem;
  border-radius: 9999px;
  white-space: nowrap;
  flex-shrink: 0;
}
.status-badge--in_progress { background: #7B1A1A; color: #fff; }
.status-badge--open        { background: transparent; color: #6b7280; border: 1px solid #d1d5db; }
.status-badge--resolved    { background: #f3f4f6; color: #6b7280; }

/* Ticket header avatar */
.t-avatar {
  width: 42px; height: 42px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: .8rem; font-weight: 700; color: #fff; flex-shrink: 0;
}

/* Header buttons */
.btn-assign {
  padding: .45rem 1rem;
  border: 1.5px solid #e5e7eb; border-radius: 8px;
  background: #fff; color: #374151;
  font-size: .85rem; font-weight: 600; cursor: pointer;
  transition: border-color .15s;
}
.btn-assign:hover { border-color: #7B1A1A; color: #7B1A1A; }

.btn-close-ticket {
  padding: .45rem 1rem;
  border: none; border-radius: 8px;
  background: #7B1A1A; color: #fff;
  font-size: .85rem; font-weight: 600; cursor: pointer;
  transition: background .15s;
}
.btn-close-ticket:hover:not(:disabled) { background: #6a1616; }
.btn-close-ticket:disabled { opacity: .5; cursor: not-allowed; }

.btn-reopen {
  padding: .45rem 1rem;
  border: 1.5px solid #10b981; border-radius: 8px;
  background: #fff; color: #10b981;
  font-size: .85rem; font-weight: 600; cursor: pointer;
}

/* Messages */
.msg-bubble {
  max-width: 68%;
  padding: .8rem 1.1rem;
  font-size: .875rem; line-height: 1.65; border-radius: 14px;
}
.msg--theirs { background: #f3f4f6; color: #111827; border-bottom-left-radius: 4px; }
.msg--mine   { background: #7B1A1A; color: #fff; border-bottom-right-radius: 4px; }

/* Input */
.input-wrap {
  display: flex;
  align-items: flex-end;
  gap: 12px;
  background: #f3f4f6;
  border-radius: 12px;
  padding: .75rem 1rem;
}
.send-btn {
  width: 38px; height: 38px;
  background: #7B1A1A; border: none; border-radius: 8px;
  color: #fff; cursor: pointer; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  transition: background .15s;
}
.send-btn:hover:not(:disabled) { background: #6a1616; }
.send-btn:disabled { opacity: .4; cursor: not-allowed; }
</style>
