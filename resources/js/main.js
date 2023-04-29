import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import './bootstrap';

import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import { iconsSet as icons } from '@/assets/icons'
import DocsExample from '@/components/DocsExample.vue'
// import VueEasyLightbox from 'vue-easy-lightbox';

const app = createApp(App)
// app.use(VueEasyLightbox, {
    // maxZoom: 1.5,
    // maxWidth: window.innerWidth * 0.8,
    // maxHeight: window.innerHeight * 0.8,
    // zIndex: 9999
//   });
app.use(store)
app.use(router)
app.use(CoreuiVue)
app.provide('icons', icons)
app.component('CIcon', CIcon)
app.component('DocsExample', DocsExample)

app.mount('#app')
