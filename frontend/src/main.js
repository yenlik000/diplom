import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createI18n } from 'vue-i18n'
import PrimeVue from 'primevue/config'
import Aura from '@primevue/themes/aura'
import { definePreset } from '@primevue/themes'
import ToastService from 'primevue/toastservice'
import 'primeicons/primeicons.css'

import router from './router'
import App from './App.vue'
import './assets/main.css'
import en from './locales/en.json'
import ru from './locales/ru.json'
import kz from './locales/kz.json'

const savedLocale = localStorage.getItem('locale') || 'en'

const i18n = createI18n({
  legacy: false,
  locale: savedLocale,
  fallbackLocale: 'en',
  messages: { en, ru, kz },
})

const BridgePreset = definePreset(Aura, {
  semantic: {
    primary: {
      50:  '#fcf1f1',
      100: '#f9dede',
      200: '#f2b8b8',
      300: '#e88585',
      400: '#d95252',
      500: '#c02b2b',
      600: '#a32020',
      700: '#8B1A1A',
      800: '#721515',
      900: '#5c1111',
      950: '#380a0a',
    },
    colorScheme: {
      light: {
        primary: {
          color:        '{primary.700}',
          inverseColor: '#ffffff',
          hoverColor:   '{primary.800}',
          activeColor:  '{primary.900}',
        },
        highlight: {
          background:      '{primary.700}',
          focusBackground: '{primary.600}',
          color:           '#ffffff',
          focusColor:      '#ffffff',
        },
      },
    },
  },
})

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(i18n)
app.use(PrimeVue, {
  theme: {
    preset: BridgePreset,
    options: { darkModeSelector: '.dark' },
  },
})
app.use(ToastService)

app.mount('#app')
