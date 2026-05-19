import axios from 'axios'

const api = axios.create({
  baseURL: '/api',
  headers: { 'Content-Type': 'application/json' },
})

// Attach JWT to every request
api.interceptors.request.use(config => {
  const token = localStorage.getItem('token')
  if (token) config.headers.Authorization = `Bearer ${token}`
  return config
})

// On 401, clear token and redirect to login
api.interceptors.response.use(
  res => res,
  err => {
    if (err.response?.status === 401) {
      localStorage.removeItem('token')
      window.location.href = '/login'
    }
    return Promise.reject(err)
  }
)

export default api

// ── Auth ──────────────────────────────────────────────────────
export const authApi = {
  login:        data => api.post('/login',         data),
  me:           ()   => api.get('/me'),
  google:       data => api.post('/auth/google',   data),  // { credential }
  facebook:     data => api.post('/auth/facebook', data),  // { access_token, user_id }
  register:     data => api.post('/auth/register', data),  // { full_name, email, password }
}

// ── User management (admin) ───────────────────────────────────
// POST /users/create  { full_name, username, password, role }
export const userApi = {
  create: data => api.post('/users/create', data),
}

// ── Courses ───────────────────────────────────────────────────
export const coursesApi = {
  list:    ()         => api.get('/courses'),
  get:     id         => api.get(`/courses/${id}`),
  create:  data       => api.post('/courses', data),
  update:  (id, data) => api.put(`/courses/${id}`, data),
  remove:  id         => api.delete(`/courses/${id}`),
}

// ── Modules ───────────────────────────────────────────────────
export const modulesApi = {
  create: (courseId, data) => api.post(`/courses/${courseId}/modules`, data),
  update: (id, data)       => api.put(`/modules/${id}`, data),
  remove: id               => api.delete(`/modules/${id}`),
}

// ── Lessons ───────────────────────────────────────────────────
export const lessonsApi = {
  get:    id               => api.get(`/lessons/${id}`),
  create: (moduleId, data) => api.post(`/modules/${moduleId}/lessons`, data),
  update: (id, data)       => api.put(`/lessons/${id}`, data),
  remove: id               => api.delete(`/lessons/${id}`),
}

// ── Enrollments ───────────────────────────────────────────────
export const enrollmentsApi = {
  list:   ()       => api.get('/enrollments'),
  enroll: courseId => api.post('/enrollments', { course_id: courseId }),
}

// ── Progress ──────────────────────────────────────────────────
export const progressApi = {
  course:         courseId => api.get(`/progress/courses/${courseId}`),
  completeLesson: lessonId => api.post(`/progress/lessons/${lessonId}/complete`),
}

// ── Homework ──────────────────────────────────────────────────
export const homeworkApi = {
  get:    id         => api.get(`/homeworks/${id}`),
  submit: (id, data) => api.post(`/homeworks/${id}/submit`, data),
}

// ── Teacher ───────────────────────────────────────────────────
export const teacherApi = {
  myCourses: ()         => api.get('/teacher/courses'),
  stats:     ()         => api.get('/teacher/stats'),
}

// ── Admin ─────────────────────────────────────────────────────
export const adminApi = {
  stats:      ()         => api.get('/admin/stats'),
  users:      ()         => api.get('/admin/users'),
  createUser: data       => api.post('/admin/users', data),
}

// ── Groups ────────────────────────────────────────────────────
export const groupsApi = {
  list:   ()         => api.get('/groups'),
  create: data       => api.post('/groups', data),
  update: (id, data) => api.put(`/groups/${id}`, data),
  remove: id         => api.delete(`/groups/${id}`),
}
