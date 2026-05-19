<template>
  <div class="page">
    <AppHeader />
    <div class="teacher-layout">
      <TeacherSidebar />
      <main class="teacher-main">
        <div class="page-header">
          <h1 class="page-title" style="margin:0">{{ t('teacher.myCourses') }}</h1>
          <Button :label="t('admin.createCourse')" icon="pi pi-plus" @click="openCreate" />
        </div>

        <DataTable :value="courses" :loading="loading" stripedRows table-style="min-width: 50rem">
          <Column field="id"           :header="t('common.id')"      style="width: 60px" />
          <Column field="title"        :header="t('common.title')" />
          <Column field="subject"      :header="t('common.subject')" />
          <Column field="level"        :header="t('common.level')" />
          <Column field="price"        :header="t('common.price')" />
          <Column field="is_published" :header="t('common.status')">
            <template #body="{ data }">
              <Tag :value="data.is_published ? t('common.published') : t('common.draft')"
                   :severity="data.is_published ? 'success' : 'secondary'" />
            </template>
          </Column>
          <Column :header="t('common.actions')" style="width: 120px">
            <template #body="{ data }">
              <div style="display:flex;gap:.5rem">
                <Button icon="pi pi-pencil" size="small" outlined @click="openEdit(data)" />
                <Button icon="pi pi-trash"  size="small" severity="danger" outlined @click="confirmDelete(data)" />
              </div>
            </template>
          </Column>
        </DataTable>

        <Dialog v-model:visible="dialogVisible"
                :header="editingId ? t('admin.editCourse') : t('admin.createCourse')"
                modal :style="{ width: '520px' }">
          <form @submit.prevent="handleSave" class="dialog-form">
            <div class="field">
              <label>{{ t('admin.courseTitle') }}</label>
              <InputText v-model="form.title" class="w-full" required />
            </div>
            <div class="field">
              <label>{{ t('common.description') }}</label>
              <Textarea v-model="form.description" rows="3" class="w-full" autoResize />
            </div>
            <div class="field-row">
              <div class="field">
                <label>{{ t('common.subject') }}</label>
                <InputText v-model="form.subject" :placeholder="t('admin.subjectPlaceholder')" class="w-full" />
              </div>
              <div class="field">
                <label>{{ t('common.level') }}</label>
                <InputText v-model="form.level" :placeholder="t('admin.levelPlaceholder')" class="w-full" />
              </div>
            </div>
            <div class="field-row">
              <div class="field">
                <label>{{ t('admin.priceLabel') }}</label>
                <InputNumber v-model="form.price" :min="0" class="w-full" />
              </div>
              <div class="field field-check">
                <label>{{ t('admin.isPublished') }}</label>
                <ToggleSwitch v-model="form.is_published" />
              </div>
            </div>

            <Message v-if="saveError" severity="error" :closable="false">{{ saveError }}</Message>

            <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1rem">
              <Button :label="t('common.cancel')" severity="secondary" outlined @click="dialogVisible = false" type="button" />
              <Button :label="editingId ? t('common.save') : t('common.create')" type="submit" :loading="saving" />
            </div>
          </form>
        </Dialog>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useToast } from 'primevue/usetoast'
import DataTable   from 'primevue/datatable'
import Column      from 'primevue/column'
import Tag         from 'primevue/tag'
import Button      from 'primevue/button'
import Dialog      from 'primevue/dialog'
import InputText   from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import Textarea    from 'primevue/textarea'
import ToggleSwitch from 'primevue/toggleswitch'
import Message     from 'primevue/message'
import AppHeader      from '@/components/layout/AppHeader.vue'
import TeacherSidebar from '@/components/teacher/TeacherSidebar.vue'
import { teacherApi, coursesApi } from '@/api'

const { t } = useI18n()
const toast   = useToast()
const loading = ref(true)
const courses = ref([])
const dialogVisible = ref(false)
const editingId = ref(null)
const saving    = ref(false)
const saveError = ref('')

const emptyForm = () => ({ title: '', description: '', subject: '', level: '', price: 0, is_published: false })
const form = ref(emptyForm())

onMounted(async () => { await loadCourses() })

async function loadCourses() {
  loading.value = true
  const res = await teacherApi.myCourses()
  courses.value = res.data.data
  loading.value = false
}

function openCreate() {
  editingId.value = null
  form.value = emptyForm()
  saveError.value = ''
  dialogVisible.value = true
}

function openEdit(course) {
  editingId.value = course.id
  form.value = { ...course, price: Number(course.price) }
  saveError.value = ''
  dialogVisible.value = true
}

async function handleSave() {
  saveError.value = ''
  saving.value = true
  try {
    if (editingId.value) {
      await coursesApi.update(editingId.value, form.value)
      toast.add({ severity: 'success', summary: t('toast.saved'), life: 3000 })
    } else {
      await coursesApi.create(form.value)
      toast.add({ severity: 'success', summary: t('toast.created'), life: 3000 })
    }
    dialogVisible.value = false
    await loadCourses()
  } catch (e) {
    saveError.value = e.response?.data?.error || t('toast.saveError')
  } finally {
    saving.value = false
  }
}

async function confirmDelete(course) {
  if (!confirm(t('admin.deleteConfirm', { title: course.title }))) return
  await coursesApi.remove(course.id)
  toast.add({ severity: 'warn', summary: t('toast.deleted'), life: 3000 })
  await loadCourses()
}
</script>

<style scoped>
.page { display: flex; flex-direction: column; min-height: 100vh; }
.teacher-layout { display: grid; grid-template-columns: 220px 1fr; flex: 1; }
.teacher-main { padding: 2rem; }

.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1.5rem;
}

.dialog-form { display: flex; flex-direction: column; gap: 1rem; }

.field { display: flex; flex-direction: column; gap: 0.4rem; flex: 1; }
.field label { font-size: 0.875rem; font-weight: 500; }
.field-row { display: flex; gap: 1rem; }
.field-check { justify-content: flex-start; align-items: flex-start; }

.w-full { width: 100%; }
:deep(.w-full .p-inputnumber) { width: 100%; }
:deep(.w-full .p-inputnumber input) { width: 100%; }
</style>
