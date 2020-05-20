<template>
  <v-app>
    <v-app-bar
      app
      color="deep-purple accent-4"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>{{ title }}</v-toolbar-title>

      <v-spacer></v-spacer>

      <!-- <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> -->
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      absolute
      temporary
    >
      <!-- <v-list-item>
        <v-list-item-content>
          <v-list-item-title>John Leider</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->

        <v-divider></v-divider>

        <v-list dense>

          <v-list-item
            v-for="item in items"
            :key="item.title"
            router
            :to="item.link"
          >

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
    </v-navigation-drawer>
    <v-content>
      <router-view/>
    </v-content>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      title: process.env.VUE_APP_TITLE,
      drawer: null,
      items: [
        { title: 'Home', icon: 'dashboard', link: '/'},
        { title: 'About', icon: 'question_answer', link: '/about' },
      ],
    }
  }
}
</script>