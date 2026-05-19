<template>
  <RouterView />
  <Toast position="top-right" />
</template>

<script setup>
import Toast from 'primevue/toast'
import { useAuthStore } from '@/stores/auth'
import { onMounted } from 'vue'

const auth = useAuthStore()
onMounted(() => auth.init())
</script>
