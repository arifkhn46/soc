<template>
  <div id="app">
    <Header />
    <div class="min-h-screen" v-if="isAuthenticated">
      <div class="pt-16 flex flex-1 h-screen">
        <div class="w-56 bg-white">
          <Sidebar />
        </div>
        <div class="flex-1 pt-8 pl-8 ">
          <!-- <div class="w-full h-8 bg-white" v-text="pageTitle" v-if="pageTitle"></div> -->
          <page-transition>
            <router-view class="view"></router-view>
          </page-transition>
        </div>
      </div>
    </div>
    <div class="min-h-screen" v-if="!isAuthenticated" >
      <div class="pt-16">
        <page-transition>
          <router-view class="view"></router-view>
        </page-transition>
      </div>
    </div>

    <notifications position="bottom right" group="app" />

  </div>
</template>

<script>
// console.log(process.env);
import Header from '@/components/Header.vue'
import Sidebar from '@/components/Sidebar.vue'
import PageTransition from '@/components/PageTransition.vue'

import { mapState } from 'vuex'

export default {
  name: 'App',
  computed: mapState('User', ['isAuthenticated']),
  components: {
    Header,
    Sidebar,
    PageTransition
  },
  watch: {
    '$route' (to) {
      this.pageTitle = to.meta.title || '';
      document.title = to.meta.title || 'SSCONLINECOACHING.COM';
    }
  },
}
</script>