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
  list:        ()         => api.get('/courses'),
  get:         id         => api.get(`/courses/${id}`),
  create:      data       => api.post('/courses', data),
  update:      (id, data) => api.put(`/courses/${id}`, data),
  remove:      id         => api.delete(`/courses/${id}`),
  uploadCover: (id, file) => {
    const fd = new FormData(); fd.append('cover', file)
    return api.post(`/courses/${id}/upload-cover`, fd, { headers: { 'Content-Type': null } })
  },
}

// ── Modules ───────────────────────────────────────────────────
export const modulesApi = {
  create: (courseId, data) => api.post(`/courses/${courseId}/modules`, data),
  update: (id, data)       => api.put(`/modules/${id}`, data),
  remove: id               => api.delete(`/modules/${id}`),
}

// ── Lessons ───────────────────────────────────────────────────
export const lessonsApi = {
  get:         id               => api.get(`/lessons/${id}`),
  create:      (moduleId, data) => api.post(`/modules/${moduleId}/lessons`, data),
  update:      (id, data)       => api.put(`/lessons/${id}`, data),
  remove:      id               => api.delete(`/lessons/${id}`),
  uploadVideo: (id, file, onProgress) => {
    const fd = new FormData(); fd.append('file', file)
    return api.post(`/lessons/${id}/upload-video`, fd, {
      headers: { 'Content-Type': null },
      onUploadProgress: onProgress ? e => onProgress(Math.round(e.loaded * 100 / e.total)) : undefined,
    })
  },
  uploadAudio: (id, file, onProgress) => {
    const fd = new FormData(); fd.append('file', file)
    return api.post(`/lessons/${id}/upload-audio`, fd, {
      headers: { 'Content-Type': null },
      onUploadProgress: onProgress ? e => onProgress(Math.round(e.loaded * 100 / e.total)) : undefined,
    })
  },
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
  get:     id               => api.get(`/homeworks/${id}`),
  submit:  (id, data)       => api.post(`/homeworks/${id}/submit`, data),
  // teacher
  create:  (lessonId, data) => api.post(`/lessons/${lessonId}/homeworks`, data),
  edit:    id               => api.get(`/homeworks/${id}/edit`),
  update:  (id, data)       => api.put(`/homeworks/${id}`, data),
  destroy: id               => api.delete(`/homeworks/${id}`),
}

// ── Teacher ───────────────────────────────────────────────────
export const teacherApi = {
  myCourses:         ()              => api.get('/teacher/courses'),
  getCourse:         id              => api.get(`/teacher/courses/${id}`),
  stats:             ()              => api.get('/teacher/stats'),
  submissions:       (courseId)      => api.get('/teacher/submissions', { params: courseId ? { course_id: courseId } : {} }),
  allSubmissions:    ()              => api.get('/teacher/submissions', { params: { all: '1' } }),
  submissionDetail:  (id)            => api.get(`/teacher/submissions/${id}`),
  grade:             (id, score, feedback, status) => api.patch(`/teacher/submissions/${id}/grade`, { score, feedback, status }),
  students:          ()              => api.get('/teacher/students'),
  efficiency:        ()              => api.get('/teacher/efficiency'),
}

// ── Admin ─────────────────────────────────────────────────────
export const adminApi = {
  stats:      ()         => api.get('/admin/stats'),
  users:      ()         => api.get('/admin/users'),
  createUser: data       => api.post('/admin/users', data),
  deleteUser: id         => api.delete(`/admin/users/${id}`),
  teachers:   ()         => api.get('/admin/teachers'),
}

// ── Comments ──────────────────────────────────────────────────
export const commentsApi = {
  list:  ()     => api.get('/comments'),
  store: data   => api.post('/comments', data),
}

// ── Reviews ───────────────────────────────────────────────────
export const reviewsApi = {
  list:  ()         => api.get('/reviews'),
  store: data       => api.post('/reviews', data),
  vote:  (id, data) => api.patch(`/reviews/${id}/vote`, data),
}

// ── Profile ───────────────────────────────────────────────────
export const profileApi = {
  get:             ()     => api.get('/profile'),
  update:          data   => api.put('/profile', data),
  changePassword:  data   => api.post('/profile/password', data),
  updatePrivacy:   data   => api.put('/profile/privacy', data),
  uploadAvatar:    file   => {
    const fd = new FormData()
    fd.append('avatar', file)
    return api.post('/profile/avatar', fd, { headers: { 'Content-Type': null } })
  },
}

// ── Messages ──────────────────────────────────────────────────
export const messagesApi = {
  contacts:    ()        => api.get('/messages/contacts'),
  list:        withId    => api.get('/messages', { params: { with: withId } }),
  send:        data      => api.post('/messages', data),
  uploadImage: formData  => api.post('/messages/upload-image', formData, { headers: { 'Content-Type': null } }),
}

// ── Groups ────────────────────────────────────────────────────
export const groupsApi = {
  list:   ()         => api.get('/groups'),
  create: data       => api.post('/groups', data),
  update: (id, data) => api.put(`/groups/${id}`, data),
  remove: id         => api.delete(`/groups/${id}`),
}

export const aiApi = {
  chat: data => api.post('/ai/chat', data),
}


// ── Support Tickets ───────────────────────────────────────────
export const ticketsApi = {
  list:          ()              => api.get('/tickets'),
  get:           id              => api.get(`/tickets/${id}`),
  addMessage:    (id, body)      => api.post(`/tickets/${id}/messages`, { body }),
  updateStatus:  (id, status)    => api.patch(`/tickets/${id}/status`, { status }),
}
