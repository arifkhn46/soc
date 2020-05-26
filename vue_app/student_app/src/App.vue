<template>
  <v-app>
    
    <NavigationDrawer :drawerState="drawer"  v-if="isAuthenticated" />

    <v-app-bar
      app
      color="primary"
      dark
      clipped-left
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" v-if="isAuthenticated"></v-app-bar-nav-icon>
      <v-toolbar-title>{{ app_name }}</v-toolbar-title>
      <v-spacer></v-spacer>

      <div v-if="!isAuthenticated">
        <v-btn class="ma-2" to="login">
          Login
        </v-btn>
        <v-btn to="register">
          Register
        </v-btn>
      </div>
    </v-app-bar>
      
    <v-content>
      <v-container 
        fluid 
        class="grey lighten-4 fill-height"
      >
        <router-view/>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>

import { mapGetters, mapActions } from 'vuex'
import NavigationDrawer from '@/components/NavigationDrawer'

export default {
  name: 'App',

  components: {
    NavigationDrawer
  },

  computed:{
    ...mapGetters({
      'isAuthenticated': 'User/isAuthenticated',
    })
  },
  data: () => ({
    app_name: process.env.VUE_APP_NAME || 'Please set your app name in .env file',
    drawer: false,
  }),
  methods: {
    ...mapActions({
      getUserDetails: 'User/getUserDetails'
    })
  },
  mounted() {
    this.getUserDetails()
      .then(() => {
        this.$router.push('/');
      })
  }
};
</script>
