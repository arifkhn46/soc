<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
      v-if="isAuthenticated"
    >
      <v-list dense>
        <v-list-group
          value="true"
          prepend-icon="mdi-account-circle"
          
        >
        <template v-slot:activator>
          <v-list-item-title>Users</v-list-item-title>
        </template>
        <v-list-item
          v-for="(menu, i) in adminMenu"
          :key="i"
          :href="menu[2]"
          active-class="highlighted"
        >
          <v-list-item-title v-text="menu[0]"></v-list-item-title>
          <v-list-item-icon>
            <v-icon v-text="menu[1]"></v-icon>
          </v-list-item-icon>
        </v-list-item>
      </v-list-group>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      color="white"
      clipped-left
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" v-if="isAuthenticated"></v-app-bar-nav-icon>
      <v-toolbar-title>SSCONLINECOACHING.COM</v-toolbar-title>
      <v-row v-if="!isAuthenticated">
        <v-spacer></v-spacer>
        <div class="my-2">
          <v-btn depressed color="white" href="/login">Login</v-btn>
        </div>
        <div class="my-2">
          <v-btn depressed color="white">Register</v-btn>
        </div>
      </v-row>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  props:['user'],
  data: () => ({
    drawer: null,
    model: 0,
    adminMenu: [
        ['Roles', 'mdi-account-settings', '/roles'],
        ['Permissions', 'mdi-account-key', '/roles/permissions'],
        ['Users', 'mdi-account', '/users'],
      ],
  }),
  computed: {
    isAuthenticated() {
      return this.user.id !== undefined;
    }
  },
}
</script>