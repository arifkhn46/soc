import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginView from '../components/LoginView.vue'
import RegisterView from '../components/RegisterView.vue'

Vue.use(VueRouter)


const routes = [
  {
    path: '/login',
    name: 'login',
    component: LoginView,
    beforeEnter: isAnonymous
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView
  },
]

const router = new VueRouter({
  routes
})

export default router
