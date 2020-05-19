<template>
  <div id="header">
    <div role="navigation" aria-label="main navigation" class="flex bg-white border-b border-gray-200 h-16 text-gray-600 p-2 mt-0 fixed w-full z-10 pin-t">
      <div class="w-full px-16">
        <div class="w-full flex items-center h-full py-3">
          <div class="flex items-center h-full">
            <a href="#" class="navbar-item hover:text-gray-900">
              SSCONLINECOACHING.COM
            </a>
            <button class="button navbar-burger">
              <span></span>
              <span></span>
              <span></span>
            </button>
          </div>
          <div v-if="!isAuthenticated" id="soc-menu" class="flex flex-grow items-center justify-end h-full">
            <div class="navbar-start"></div>
            <div class="flex items-center h-full">
              <router-link class="px-4 flex items-center hover:text-gray-900 h-full hover:bg-gray-100 rounded" to="/login">Login</router-link>
              <router-link class="px-4 flex items-center hover:text-gray-900 h-full hover:bg-gray-100 rounded" to="/register">Register</router-link>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>


<script>

import { mapState } from 'vuex'

export default {
  computed: mapState('User', ['isAuthenticated']),

}
</script>