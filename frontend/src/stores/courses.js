import { defineStore } from 'pinia'
import { ref } from 'vue'
import { coursesApi, enrollmentsApi, progressApi } from '@/api'

export const useCoursesStore = defineStore('courses', () => {
  const courses     = ref([])
  const current     = ref(null)
  const enrollments = ref([])
  const progress    = ref({})

  async function fetchCourses() {
    const res = await coursesApi.list()
    courses.value = res.data.data
  }

  async function fetchCourse(id) {
    const res = await coursesApi.get(id)
    current.value = res.data.data
  }

  async function fetchEnrollments() {
    const res = await enrollmentsApi.list()
    enrollments.value = res.data.data
  }

  async function fetchProgress(courseId) {
    const res = await progressApi.course(courseId)
    progress.value[courseId] = res.data.data
  }

  function isEnrolled(courseId) {
    return enrollments.value.some(e => e.id === courseId)
  }

  return {
    courses, current, enrollments, progress,
    fetchCourses, fetchCourse, fetchEnrollments, fetchProgress, isEnrolled,
  }
})
