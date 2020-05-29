<template>
  <v-navigation-drawer
        v-model="drawer"
        app
        clipped
      >
    <v-list dense>
      <v-list-item to="create-task">
        <v-list-item-action>
          <!-- <v-icon>mdi-view-dashboard</v-icon> -->
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Create Task</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <!-- <v-list-item to="tasks">
        <v-list-item-action>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Tasks</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->
      <v-list-item to="tasks">
        <v-list-item-action>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>My Tasks</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
  
  import { mapGetters } from 'vuex'

  export default {
    props:['drawerState'],
    data() {
      return {
        drawer: false,
      }
    },
    watch: {
      drawerState(value) {
        this.drawer = value;
      }
    },
    computed: {
      ...mapGetters({
        user: 'User/getUser',
      })
    }
  }
</script>