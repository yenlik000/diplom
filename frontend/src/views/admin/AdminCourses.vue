<template>
  <AdminLayout :title="t('admin.courses')">
    <template #header-left>
      <div>
        <h1 style="margin:0;font-size:1.25rem;font-weight:700;color:#1a1a1a;">{{ t('admin.courses') }}</h1>
        <p style="margin:2px 0 0;font-size:.8rem;color:#9ca3af;">Manage all platform courses</p>
      </div>
    </template>

    <div class="page-header">
      <div></div>
      <Button :label="t('admin.createCourse')" icon="pi pi-plus" @click="openCreate" />
    </div>

    <div class="table-card">
        <DataTable :value="courses" :loading="loading" stripedRows table-style="min-width: 50rem">
          <Column field="id"      :header="t('common.id')"    style="width: 60px" />
          <Column field="title"   :header="t('common.title')" />
          <Column field="subject" :header="t('common.subject')" />
          <Column field="level"   :header="t('common.level')" />
          <Column field="price"   :header="t('common.price')" />

          <!-- Teacher column -->
          <Column header="Teacher">
            <template #body="{ data }">
              <span v-if="data.teacher_name" class="teacher-chip">
                <i class="pi pi-user" style="font-size:.72rem;"></i>
                {{ data.teacher_name }}
              </span>
              <span v-else style="color:#9ca3af;font-size:.85rem;">— Unassigned —</span>
            </template>
          </Column>

          <!-- Published toggle -->
          <Column :header="t('common.status')" style="width: 90px">
            <template #body="{ data }">
              <button class="star-btn" @click.stop="togglePublished(data)"
                      :title="data.is_published ? t('common.published') : t('common.draft')">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                  <path d="M12 2l2.9 5.9 6.5.9-4.7 4.6 1.1 6.4L12 17l-5.8 3.1 1.1-6.4L2.6 9l6.5-.9L12 2z"
                    :fill="data.is_published ? '#FFD700' : 'none'"
                    :stroke="data.is_published ? '#FFD700' : '#aaa'"
                    stroke-width="1.8" stroke-linejoin="round"/>
                </svg>
              </button>
            </template>
          </Column>

          <!-- Actions -->
          <Column :header="t('common.actions')" style="width: 120px">
            <template #body="{ data }">
              <div style="display:flex;gap:.5rem">
                <Button icon="pi pi-pencil" size="small" outlined @click="openEdit(data)" />
                <Button icon="pi pi-trash"  size="small" severity="danger" outlined @click="confirmDelete(data)" />
              </div>
            </template>
          </Column>
        </DataTable>
    </div>

    <!-- Create / Edit dialog -->
    <Dialog v-model:visible="dialogVisible"
                :header="editingId ? t('admin.editCourse') : t('admin.createCourse')"
                modal :style="{ width: '540px' }">
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

            <!-- Teacher assignment -->
            <div class="field">
              <label>Assign Teacher</label>
              <select v-model="form.teacher_id" class="teacher-select">
                <option :value="null">— No teacher assigned —</option>
                <option v-for="t in teachers" :key="t.id" :value="t.id">
                  {{ t.full_name }} (@{{ t.username }})
                </option>
              </select>
              <p v-if="!teachers.length" style="font-size:.8rem;color:#9ca3af;margin:2px 0 0;">
                No teachers found. Create a user with role "Teacher" first.
              </p>
            </div>

            <!-- Cover image -->
            <div class="field">
              <label>Cover Image</label>
              <div class="cover-wrap">
                <img v-if="coverPreview || form.cover_image" :src="coverPreview || form.cover_image" class="cover-preview" />
                <div v-else class="cover-empty">No image</div>
                <label class="cover-upload-btn">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  Upload
                  <input type="file" accept="image/*" style="display:none" @change="onCoverFile" />
                </label>
              </div>
            </div>

            <div class="field-row">
              <div class="field">
                <label>{{ t('admin.priceLabel') }}</label>
                <InputNumber v-model="form.price" :min="0" class="w-full" />
              </div>
              <div class="field">
                <label>Original Price <span style="font-size:.75rem;color:#9ca3af">(for strikethrough)</span></label>
                <InputNumber v-model="form.original_price" :min="0" class="w-full" />
              </div>
              <div class="field field-check">
                <label>{{ t('admin.isPublished') }}</label>
                <ToggleSwitch v-model="form.is_published" />
              </div>
            </div>

            <Message v-if="saveError" severity="error" :closable="false">{{ saveError }}</Message>

            <div style="display:flex;justify-content:flex-end;gap:.75rem;margin-top:1rem">
              <Button :label="t('common.cancel')" severity="secondary" outlined
                      @click="dialogVisible = false" type="button" />
              <Button :label="editingId ? t('common.save') : t('common.create')"
                      type="submit" :loading="saving" />
            </div>
          </form>
        </Dialog>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useI18n }    from 'vue-i18n'
import { useToast }   from 'primevue/usetoast'
import DataTable      from 'primevue/datatable'
import Column         from 'primevue/column'
import Button         from 'primevue/button'
import Dialog         from 'primevue/dialog'
import InputText      from 'primevue/inputtext'
import InputNumber    from 'primevue/inputnumber'
import Textarea       from 'primevue/textarea'
import ToggleSwitch   from 'primevue/toggleswitch'
import Message        from 'primevue/message'
import AdminLayout    from '@/components/admin/AdminLayout.vue'
import { teacherApi, coursesApi, adminApi } from '@/api'

const { t }   = useI18n()
const toast   = useToast()
const loading = ref(true)
const courses  = ref([])
const teachers = ref([])

const dialogVisible = ref(false)
const editingId     = ref(null)
const saving        = ref(false)
const saveError     = ref('')

const emptyForm = () => ({
  title: '', description: '', subject: '', level: '',
  price: 0, original_price: null, is_published: false, teacher_id: null, cover_image: null,
})
const form        = ref(emptyForm())
const coverFile   = ref(null)
const coverPreview = ref('')

function onCoverFile(e) {
  const file = e.target.files[0]
  if (!file) return
  coverFile.value    = file
  coverPreview.value = URL.createObjectURL(file)
}

onMounted(async () => {
  const [, tRes] = await Promise.all([loadCourses(), adminApi.teachers()])
  teachers.value = tRes.data.data || []
})

async function loadCourses() {
  loading.value = true
  // teacherApi.myCourses() returns ALL courses with teacher_name when role=admin
  const res = await teacherApi.myCourses()
  courses.value = res.data.data || []
  loading.value = false
}

function openCreate() {
  editingId.value    = null
  form.value         = emptyForm()
  coverFile.value    = null
  coverPreview.value = ''
  saveError.value    = ''
  dialogVisible.value = true
}

function openEdit(course) {
  editingId.value    = course.id
  coverFile.value    = null
  coverPreview.value = ''
  form.value = {
    ...course,
    price:      Number(course.price),
    teacher_id: course.teacher_id ?? null,
  }
  saveError.value = ''
  dialogVisible.value = true
}

async function handleSave() {
  saveError.value = ''
  saving.value = true
  try {
    let courseId = editingId.value
    if (editingId.value) {
      await coursesApi.update(editingId.value, form.value)
      toast.add({ severity: 'success', summary: t('toast.saved'), life: 3000 })
    } else {
      const res = await coursesApi.create(form.value)
      courseId  = res.data.data?.id
      toast.add({ severity: 'success', summary: t('toast.created'), life: 3000 })
    }
    if (coverFile.value && courseId) {
      await coursesApi.uploadCover(courseId, coverFile.value)
    }
    dialogVisible.value = false
    await loadCourses()
  } catch (e) {
    saveError.value = e.response?.data?.error || t('toast.saveError')
  } finally {
    saving.value = false
  }
}

async function togglePublished(course) {
  await coursesApi.update(course.id, { ...course, is_published: !course.is_published })
  await loadCourses()
}

async function confirmDelete(course) {
  if (!confirm(t('admin.deleteConfirm', { title: course.title }))) return
  await coursesApi.remove(course.id)
  toast.add({ severity: 'warn', summary: t('toast.deleted'), life: 3000 })
  await loadCourses()
}
</script>

<style scoped>
.table-card {
  background: #fff; border-radius: 12px;
  border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,.06);
  overflow: hidden;
}

.page-header {
  display: flex; align-items: center; justify-content: flex-end;
  margin-bottom: 1.5rem;
}

.dialog-form { display: flex; flex-direction: column; gap: 1rem; }

.cover-wrap { display: flex; align-items: center; gap: 1rem; }
.cover-preview { width: 100px; height: 70px; object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb; }
.cover-empty { width: 100px; height: 70px; border-radius: 8px; border: 1.5px dashed #d1d5db; display: flex; align-items: center; justify-content: center; font-size: .75rem; color: #9ca3af; }
.cover-upload-btn { display: inline-flex; align-items: center; gap: 6px; padding: .45rem .9rem; border: 1.5px solid #7B1A1A; border-radius: 8px; color: #7B1A1A; font-size: .82rem; font-weight: 600; cursor: pointer; transition: background .15s; }
.cover-upload-btn:hover { background: #fef2f2; }

.field       { display: flex; flex-direction: column; gap: 0.4rem; flex: 1; }
.field label { font-size: 0.875rem; font-weight: 500; }
.field-row   { display: flex; gap: 1rem; }
.field-check { justify-content: flex-start; align-items: flex-start; }

.teacher-select {
  width: 100%;
  padding: .5rem .75rem;
  border: 1px solid #d1d5db; border-radius: 6px;
  font-size: .875rem; color: #374151;
  outline: none; background: #fff; cursor: pointer;
  transition: border-color .15s;
}
.teacher-select:focus { border-color: #7B1A1A; }

.teacher-chip {
  display: inline-flex; align-items: center; gap: 5px;
  background: #fef2f2; color: #7B1A1A;
  font-size: .8rem; font-weight: 600;
  padding: .2rem .6rem; border-radius: 9999px;
}

.star-btn { background: none; border: none; cursor: pointer; padding: 2px; }

.w-full { width: 100%; }
:deep(.w-full .p-inputnumber)       { width: 100%; }
:deep(.w-full .p-inputnumber input) { width: 100%; }
</style>
