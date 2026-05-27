<template>
  <TeacherLayout title="Settings">
    <div class="flex gap-6">

      <!-- Profile card -->
      <div class="bg-white rounded-xl p-6 flex flex-col items-center" style="border:1px solid #e5e7eb;width:240px;flex-shrink:0;">
        <div class="flex items-center justify-center rounded-full font-bold text-white mb-4"
             style="width:80px;height:80px;background:#7B1A1A;font-size:1.75rem;">
          {{ initials }}
        </div>
        <div class="text-base font-semibold text-center" style="color:#111827;">{{ form.full_name }}</div>
        <div class="text-xs mt-1 text-center" style="color:#6b7280;">{{ form.email }}</div>
        <div class="mt-3 text-xs font-semibold px-3 py-1 rounded-full" style="background:#fef2f2;color:#7B1A1A;">
          {{ roleLabel }}
        </div>
      </div>

      <!-- Settings form -->
      <div class="flex-1 flex flex-col gap-5">

        <!-- Personal info -->
        <div class="bg-white rounded-xl p-6" style="border:1px solid #e5e7eb;">
          <h3 class="font-semibold mb-5" style="color:#111827;font-size:0.95rem;margin:0 0 1.25rem;">{{ t('teacher.personalInformation') }}</h3>
          <div class="grid gap-4" style="grid-template-columns:1fr 1fr;">
            <div>
              <label class="field-label">{{ t('teacher.fullName') }}</label>
              <input v-model="form.full_name" class="field-input" type="text" />
            </div>
            <div>
              <label class="field-label">{{ t('teacher.emailField') }}</label>
              <input v-model="form.email" class="field-input" type="email" />
            </div>
          </div>
          <div class="flex justify-end mt-4">
            <button class="save-btn" @click="saveProfile" :disabled="saving">
              {{ saving ? t('common.saving') : t('teacher.saveChanges') }}
            </button>
          </div>
          <p v-if="profileMsg" class="text-sm mt-2 text-right" :style="{ color: profileError ? '#ef4444' : '#10b981' }">{{ profileMsg }}</p>
        </div>

        <!-- Change password -->
        <div class="bg-white rounded-xl p-6" style="border:1px solid #e5e7eb;">
          <h3 class="font-semibold mb-5" style="color:#111827;font-size:0.95rem;margin:0 0 1.25rem;">{{ t('teacher.changePassword') }}</h3>
          <div class="flex flex-col gap-4" style="max-width:400px;">
            <div>
              <label class="field-label">{{ t('teacher.currentPassword') }}</label>
              <input v-model="pwd.current" class="field-input" type="password" />
            </div>
            <div>
              <label class="field-label">{{ t('teacher.newPassword') }}</label>
              <input v-model="pwd.next" class="field-input" type="password" />
            </div>
            <div>
              <label class="field-label">{{ t('teacher.confirmNewPassword') }}</label>
              <input v-model="pwd.confirm" class="field-input" type="password" />
            </div>
          </div>
          <div class="flex justify-end mt-4">
            <button class="save-btn" @click="savePwd" :disabled="pwdSaving">
              {{ pwdSaving ? t('teacher.updating') : t('teacher.updatePassword') }}
            </button>
          </div>
          <p v-if="pwdMsg" class="text-sm mt-2 text-right" :style="{ color: pwdError ? '#ef4444' : '#10b981' }">{{ pwdMsg }}</p>
        </div>

      </div>
    </div>
  </TeacherLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import TeacherLayout from '@/components/teacher/TeacherLayout.vue'
import { profileApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const { t } = useI18n()
const auth = useAuthStore()
const roleLabel = computed(() => auth.isAdmin ? t('teacher.roleAdmin') : t('teacher.roleTeacher'))

const form = ref({ full_name: '', email: '' })
const initials = computed(() =>
  form.value.full_name.split(' ').map(w => w[0]).join('').toUpperCase().slice(0, 2) || 'TP'
)

const saving = ref(false)
const profileMsg = ref('')
const profileError = ref(false)

const pwd = ref({ current: '', next: '', confirm: '' })
const pwdSaving = ref(false)
const pwdMsg = ref('')
const pwdError = ref(false)

onMounted(async () => {
  try {
    const res = await profileApi.get()
    const d = res.data.data || res.data
    form.value.full_name = d.full_name || d.name || ''
    form.value.email = d.email || ''
  } catch {}
})

async function saveProfile() {
  saving.value = true
  profileMsg.value = ''
  try {
    await profileApi.update({ full_name: form.value.full_name, email: form.value.email })
    profileMsg.value = t('teacher.profileUpdated')
    profileError.value = false
    auth.user && (auth.user.full_name = form.value.full_name)
  } catch (e) {
    profileMsg.value = e.response?.data?.message || t('teacher.failedUpdateProfile')
    profileError.value = true
  } finally {
    saving.value = false
  }
}

async function savePwd() {
  if (pwd.value.next !== pwd.value.confirm) {
    pwdMsg.value = t('teacher.passwordsNoMatch')
    pwdError.value = true
    return
  }
  pwdSaving.value = true
  pwdMsg.value = ''
  try {
    await profileApi.changePassword({ current_password: pwd.value.current, new_password: pwd.value.next })
    pwdMsg.value = t('teacher.passwordUpdated')
    pwdError.value = false
    pwd.value = { current: '', next: '', confirm: '' }
  } catch (e) {
    pwdMsg.value = e.response?.data?.message || t('teacher.failedUpdatePassword')
    pwdError.value = true
  } finally {
    pwdSaving.value = false
  }
}
</script>

<style scoped>
.field-label { display:block;font-size:.8rem;font-weight:600;color:#374151;margin-bottom:.35rem; }
.field-input { width:100%;padding:.55rem .75rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.875rem;color:#111827;outline:none;transition:border-color .15s; }
.field-input:focus { border-color:#7B1A1A; }
.save-btn { padding:.5rem 1.25rem;background:#7B1A1A;color:#fff;border:none;border-radius:8px;font-size:.875rem;font-weight:600;cursor:pointer;transition:background .15s; }
.save-btn:hover:not(:disabled) { background:#6a1616; }
.save-btn:disabled { opacity:.5;cursor:not-allowed; }
</style>
