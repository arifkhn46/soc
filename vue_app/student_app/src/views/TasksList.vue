<template>
   <v-data-table
    :headers="headers"
    :items="tasks"
    :items-per-page="15"
    class="elevation-1"
  >
    <!-- <template v-slot:item.start_at="{ item }">
      <v-chip color="primary" dark>{{ item.start_at }}</v-chip>
    </template> -->
  </v-data-table>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  data: () => ({
    headers: [
      { text: 'Title', value: 'title' },
      { text: 'Description', value: 'description' },
      { text: 'Type', value: 'type' },
      { text: 'Subject', value: 'subject' },
      { text: 'Chapter', value: 'chapter' },
      { text: 'Start', value: 'start_at' },
      { text: 'End', value: 'end_at' },
      { text: 'Created', value: 'created_at' },
      { text: 'Updated', value: 'updated_at' },
    ],
  }),
  computed: {
    ...mapGetters({
      tasks: 'Task/getTasks'   
    })
  },
  methods: {
    ...mapActions({
      fetchMyTasks: 'Task/fetchTasks',
    }),
  },
  mounted() {
    this.fetchMyTasks()
  }
}
</script>
