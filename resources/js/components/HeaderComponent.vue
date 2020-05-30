<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
      v-if="user.id"
    >
      <v-list dense>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-cog</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Settings</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      color="indigo"
      dark
      clipped-left
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" v-if="user.id"></v-app-bar-nav-icon>
      <v-toolbar-title>SSCONLINECOACHING.COM</v-toolbar-title>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  props:['user'],
  data: () => ({
    drawer: null,
  }),
}
</script>