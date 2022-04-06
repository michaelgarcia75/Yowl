import { createApp, createAdminView } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import AdminView from './views/AdminView.vue'

createApp(App).use(store).use(router).mount('#app')
createAdminView(AdminView).use(store).use(router).mount('#adminview')
