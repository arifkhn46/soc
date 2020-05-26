import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import CreateTaskView from '@/views/CreateTaskView.vue'
import TasksList from '@/views/TasksList.vue'
import TodayTasksListView from '@/views/TodayTasksListView.vue'


import store from '@/store'

Vue.use(VueRouter)

const isAnonymous = (to, from, next) => {
  if (!store.getters["User/isAuthenticated"]) {
    next()
  } else {
    next({
      name: "About" // back to safety route //
    });
  }
}


const isAuthenticated = (to, from, next) => {
  if (store.getters["User/isAuthenticated"]) {
    next()
  } else {
    next({
      name: "login" // back to safety route //
    });
  }
}

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
  {
    path: '/create-task',
    name: 'create-task',
    component: CreateTaskView,
    beforeEnter: isAuthenticated
  },
  {
    path: '/tasks',
    name: 'tasks',
    component: TasksList,
    beforeEnter: isAuthenticated
  },
  {
    path: '/todays-tasks',
    name: 'todays-tasks',
    component: TodayTasksListView,
    beforeEnter: isAuthenticated
  },
  {
    path: '/',
    name: 'dashboard',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/Dashboard.vue'),
    beforeEnter: isAuthenticated
  }
]

const router = new VueRouter({
  routes
})

export default router
