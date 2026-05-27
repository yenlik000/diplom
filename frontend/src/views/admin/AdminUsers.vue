<template>
  <AdminLayout title="Users">
    <template #header-left>
      <div>
        <h1 style="margin:0;font-size:1.25rem;font-weight:700;color:#111827;">Users</h1>
        <p style="margin:2px 0 0;font-size:.8rem;color:#9ca3af;">Manage all platform accounts</p>
      </div>
    </template>

    <!-- Page toolbar -->
    <div style="display:flex;align-items:center;justify-content:flex-end;margin-bottom:1.5rem;">
      <button @click="openDialog" class="create-btn">
        <i class="pi pi-user-plus" style="font-size:.85rem;"></i>
        Create User
      </button>
    </div>

    <!-- Table -->
    <div class="table-card">
      <DataTable :value="users" :loading="loading" paginator :rows="20" stripedRows
                 table-style="min-width: 50rem">
        <Column field="id"        header="ID"         style="width: 60px" />
        <Column field="full_name" header="Full Name" />
        <Column field="username"  header="Username">
          <template #body="{ data }">
            <span style="font-family:monospace;font-size:.85rem;color:#6b7280;">@{{ data.username }}</span>
          </template>
        </Column>
        <Column field="role" header="Role">
          <template #body="{ data }">
            <span class="role-badge" :class="`role-badge--${data.role}`">
              {{ roleLabel(data.role) }}
            </span>
          </template>
        </Column>
        <Column field="created_at" header="Created">
          <template #body="{ data }">
            <span style="font-size:.85rem;color:#9ca3af;">{{ formatDate(data.created_at) }}</span>
          </template>
        </Column>
        <Column header="Actions" style="width:90px;text-align:center;">
          <template #body="{ data }">
            <button
              class="del-btn"
              :disabled="data.id === currentUserId"
              :title="data.id === currentUserId ? 'Cannot delete yourself' : 'Delete user'"
              @click="confirmDelete(data)"
            >
              <i class="pi pi-trash" style="font-size:.85rem;"></i>
            </button>
          </template>
        </Column>
      </DataTable>
    </div>

    <!-- Delete confirmation dialog -->
    <Dialog v-model:visible="deleteDialog" header="Delete User" modal :style="{ width: '400px' }">
      <div style="display:flex;flex-direction:column;gap:1rem;padding-top:.25rem;">
        <p style="margin:0;font-size:.95rem;color:#374151;">
          Are you sure you want to delete
          <strong>{{ deleteTarget?.full_name }}</strong>?
          This will also remove all their enrollments, submissions, and progress.
        </p>
        <div v-if="deleteError" class="form-error">
          <i class="pi pi-exclamation-circle" style="font-size:.85rem;"></i>
          {{ deleteError }}
        </div>
        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
          <Button label="Cancel" severity="secondary" @click="deleteDialog = false" />
          <Button label="Delete" severity="danger" :loading="deleting" @click="doDelete" />
        </div>
      </div>
    </Dialog>

    <!-- Create User Dialog -->
    <Dialog v-model:visible="dialogVisible" header="Create New User"
            modal :style="{ width: '460px' }" @hide="resetForm">
      <form @submit.prevent="submitCreate" class="dialog-form">

        <div class="field">
          <label>Full Name</label>
          <InputText v-model="form.full_name" required placeholder="e.g. Aizat Nurlanovna" class="w-full" />
        </div>

        <div class="field">
          <label>Username</label>
          <InputText v-model="form.username" required placeholder="e.g. aizat_n (3–30 chars)" class="w-full" />
          <p class="field-hint">Lowercase letters, digits, underscores only.</p>
        </div>

        <div class="field">
          <label>Password</label>
          <InputText v-model="form.password" type="password" required minlength="8"
                     placeholder="Min. 8 characters" class="w-full" />
        </div>

        <div class="field">
          <label>Role</label>
          <Select v-model="form.role" :options="roleOptions"
                  optionLabel="label" optionValue="value" class="w-full" />
        </div>

        <div v-if="formError" class="form-error">
          <i class="pi pi-exclamation-circle" style="font-size:.85rem;"></i>
          {{ formError }}
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;padding-top:.5rem;">
          <Button type="button" label="Cancel" severity="secondary" @click="dialogVisible = false" />
          <Button type="submit" label="Create User" :loading="submitting" />
        </div>

      </form>
    </Dialog>
  </AdminLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useToast }  from 'primevue/usetoast'
import DataTable from 'primevue/datatable'
import Column    from 'primevue/column'
import Dialog    from 'primevue/dialog'
import InputText from 'primevue/inputtext'
import Select    from 'primevue/select'
import Button    from 'primevue/button'
import AdminLayout from '@/components/admin/AdminLayout.vue'
import { adminApi } from '@/api'
import { useAuthStore } from '@/stores/auth'

const toast = useToast()
const auth  = useAuthStore()

const currentUserId = auth.user?.id

const loading = ref(true)
const users   = ref([])

const deleteDialog = ref(false)
const deleteTarget = ref(null)
const deleting     = ref(false)
const deleteError  = ref('')

const dialogVisible = ref(false)
const submitting    = ref(false)
const formError     = ref('')

const defaultForm = () => ({ full_name: '', username: '', password: '', role: 'student' })
const form = ref(defaultForm())

const roleOptions = [
  { label: 'Student', value: 'student' },
  { label: 'Teacher', value: 'teacher' },
  { label: 'Admin',   value: 'admin'   },
]

onMounted(async () => {
  const res     = await adminApi.users()
  users.value   = res.data.data
  loading.value = false
})

function roleLabel(role) {
  return { admin: 'Admin', teacher: 'Teacher', student: 'Student' }[role] ?? role
}

function formatDate(str) {
  return new Date(str).toLocaleDateString()
}

function openDialog()  { dialogVisible.value = true }
function resetForm()   { form.value = defaultForm(); formError.value = '' }

function confirmDelete(user) {
  deleteTarget.value = user
  deleteError.value  = ''
  deleteDialog.value = true
}

async function doDelete() {
  deleting.value    = true
  deleteError.value = ''
  try {
    await adminApi.deleteUser(deleteTarget.value.id)
    users.value    = users.value.filter(u => u.id !== deleteTarget.value.id)
    deleteDialog.value = false
    toast.add({ severity: 'success', summary: 'Deleted', detail: `${deleteTarget.value.full_name} has been removed.`, life: 3000 })
  } catch (err) {
    deleteError.value = err.response?.data?.error || 'Failed to delete user.'
  } finally {
    deleting.value = false
  }
}

async function submitCreate() {
  formError.value  = ''
  submitting.value = true
  try {
    const res = await adminApi.createUser(form.value)
    users.value.unshift(res.data.data)
    dialogVisible.value = false
    toast.add({ severity: 'success', summary: 'Created', detail: 'User account created.', life: 3000 })
  } catch (err) {
    formError.value = err.response?.data?.error || 'Something went wrong.'
  } finally {
    submitting.value = false
  }
}
</script>

<style scoped>
.create-btn {
  display: inline-flex; align-items: center; gap: 6px;
  background: #7B1A1A; color: #fff;
  font-size: .875rem; font-weight: 500;
  padding: 9px 16px; border-radius: 8px; border: none;
  cursor: pointer; transition: background .15s;
}
.create-btn:hover { background: #6a1616; }

.table-card {
  background: #fff; border-radius: 12px;
  border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,.06);
  overflow: hidden;
}

.role-badge {
  display: inline-flex; align-items: center;
  padding: 2px 10px; border-radius: 9999px;
  font-size: .75rem; font-weight: 600;
}
.role-badge--admin   { background: #fef3c7; color: #92400e; }
.role-badge--teacher { background: #dbeafe; color: #1e40af; }
.role-badge--student { background: #f3f4f6; color: #374151; }

.dialog-form { display: flex; flex-direction: column; gap: 1rem; padding-top: .5rem; }
.field { display: flex; flex-direction: column; gap: .35rem; }
.field label { font-size: .875rem; font-weight: 500; color: #374151; }
.field-hint { font-size: .75rem; color: #9ca3af; margin: 2px 0 0; }

.form-error {
  display: flex; align-items: center; gap: 6px;
  background: #fef2f2; color: #b91c1c;
  font-size: .875rem; padding: 10px 12px; border-radius: 8px;
}

.w-full { width: 100%; }

.del-btn {
  width: 32px; height: 32px;
  display: inline-flex; align-items: center; justify-content: center;
  border: 1.5px solid #fecaca; border-radius: 8px;
  background: #fff; color: #dc2626;
  cursor: pointer; transition: background .15s, border-color .15s;
}
.del-btn:hover:not(:disabled) { background: #fef2f2; border-color: #f87171; }
.del-btn:disabled { opacity: .35; cursor: not-allowed; }
</style>
