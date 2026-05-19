<template>
  <div class="flex flex-col min-h-screen bg-slate-50">
    <AppHeader />

    <div class="flex flex-1">
      <AdminSidebar />

      <main class="flex-1 p-8">

        <!-- Page header -->
        <div class="flex items-center justify-between mb-6">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">Users</h1>
            <p class="text-sm text-gray-500 mt-0.5">Manage all platform accounts</p>
          </div>
          <button @click="openDialog"
                  class="inline-flex items-center gap-2 bg-brand-burgundy text-white
                         text-sm font-medium px-4 py-2 rounded-lg hover:bg-brand-burgundyDark transition-colors">
            <i class="pi pi-user-plus text-sm"></i>
            Create User
          </button>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
          <DataTable :value="users" :loading="loading" paginator :rows="20" stripedRows
                     table-style="min-width: 50rem">
            <Column field="id"        header="ID"         style="width: 60px" />
            <Column field="full_name" header="Full Name" />
            <Column field="username"  header="Username">
              <template #body="{ data }">
                <span class="font-mono text-sm text-gray-600">@{{ data.username }}</span>
              </template>
            </Column>
            <Column field="role"      header="Role">
              <template #body="{ data }">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold"
                      :class="roleBadgeClass(data.role)">
                  {{ roleLabel(data.role) }}
                </span>
              </template>
            </Column>
            <Column field="created_at" header="Created">
              <template #body="{ data }">
                <span class="text-sm text-gray-500">{{ formatDate(data.created_at) }}</span>
              </template>
            </Column>
          </DataTable>
        </div>

        <!-- Create User Dialog -->
        <Dialog v-model:visible="dialogVisible" header="Create New User"
                modal :style="{ width: '460px' }" @hide="resetForm">

          <form @submit.prevent="submitCreate" class="space-y-4 pt-2">

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
              <InputText v-model="form.full_name" required placeholder="e.g. Aizat Nurlanovna"
                         class="w-full" />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
              <InputText v-model="form.username" required placeholder="e.g. aizat_n (3–30 chars)"
                         class="w-full" />
              <p class="text-xs text-gray-400 mt-1">Lowercase letters, digits, underscores only.</p>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <InputText v-model="form.password" type="password" required minlength="8"
                         placeholder="Min. 8 characters" class="w-full" />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
              <Select v-model="form.role" :options="roleOptions"
                      optionLabel="label" optionValue="value" class="w-full" />
            </div>

            <div v-if="formError"
                 class="flex items-center gap-2 bg-red-50 text-red-700 text-sm px-3 py-2.5 rounded-lg">
              <i class="pi pi-exclamation-circle text-sm"></i>
              {{ formError }}
            </div>

            <div class="flex justify-end gap-3 pt-2">
              <Button type="button" label="Cancel" severity="secondary"
                      @click="dialogVisible = false" />
              <Button type="submit" label="Create User" :loading="submitting" />
            </div>

          </form>
        </Dialog>

      </main>
    </div>
  </div>
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
import AppHeader    from '@/components/layout/AppHeader.vue'
import AdminSidebar from '@/components/admin/AdminSidebar.vue'
import { adminApi } from '@/api'

const toast = useToast()

const loading = ref(true)
const users   = ref([])

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

function roleBadgeClass(role) {
  return {
    admin:   'bg-amber-100 text-amber-800',
    teacher: 'bg-blue-100 text-blue-800',
    student: 'bg-gray-100 text-gray-700',
  }[role] ?? 'bg-gray-100 text-gray-700'
}

function formatDate(str) {
  return new Date(str).toLocaleDateString()
}

function openDialog()  { dialogVisible.value = true }
function resetForm()   { form.value = defaultForm(); formError.value = '' }

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
