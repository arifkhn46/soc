import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

// route-level code splitting
const createTask = () => import('@/views/task/CreateTask');
const dashboard = () => import('@/views/Dashboard');
const login = () => import('@/views/LoginView');
const register = () => import('@/views/RegisterView');



export function createRouter (store) {
  function requireAuth(to, from, next) {
    if (store.getters['User/isAuthenticated']) {
      next()
      return
    }
    next('/login')
  }

  function ifAnonymous(to, from, next) {

    if (!store.getters['User/isAuthenticated']) {
      next()
      return
    }

    next('/dashboard')
  }

  const router = new Router({
    mode: 'history',
    fallback: false,
    scrollBehavior: () => ({ y: 0 }),
    routes: [
      // { path: '/top/:page(\\d+)?', component: createListView('top') },
      // { path: '/new/:page(\\d+)?', component: createListView('new') },
      // { path: '/show/:page(\\d+)?', component: createListView('show') },
      // { path: '/ask/:page(\\d+)?', component: createListView('ask') },
      // { path: '/job/:page(\\d+)?', component: createListView('job') },
      // { path: '/item/:id(\\d+)', component: ItemView },
      // { path: '/user/:id', component: UserView },
      // { path: '/', redirect: '/top' }
      {
        path: '/create-task',
        component: createTask,
        name: 'createTask',
        meta: {
          title: 'Create Task'
        },
        beforeEnter: requireAuth
      },
      {
        path: '/dashboard',
        component: dashboard,
        name: 'dashboard',
        meta: {
          title: 'Dashboard'
        },
        beforeEnter: requireAuth
      },
      {
        path: '/login',
        component: login,
        name: 'login',
        meta: {
          title: 'Login',
          transitionName: 'slide'
        },
        beforeEnter: ifAnonymous
      },
      {
        path: '/register',
        component: register,
        name: 'Register',
        meta: {
          title: 'Registration',
          transitionName: 'slide'
        },
        beforeEnter: ifAnonymous
      }
    ]
  })

  return router

}