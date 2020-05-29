<template>
  <v-container 
        fluid 
        class="align-start"
      >
    <v-row align="center" justify="center"> 
       <v-col cols="12">
          <v-data-table
            v-if="tasks.length"
            :headers="headers"
            :items="tasks"
            :items-per-page="15"
            class="elevation-1"
          >
            <!-- <template v-slot:item.start_at="{ item }">
              <v-chip color="primary" dark>{{ item.start_at }}</v-chip>
            </template> -->
            <template v-slot:top>
              <v-toolbar flat color="white">
                <v-toolbar-title>
                  Tasks
                </v-toolbar-title>
                <v-divider
                  class="mx-4"
                  inset
                  vertical
                ></v-divider>
                <v-chip 
                  class="ma-2" 
                  @click="setDateFilter(START_DATE_FILTER_TODAY)"
                  :color="isActiveDateFilter(START_DATE_FILTER_TODAY) ? 'teal' : ''"
                  :text-color="isActiveDateFilter(START_DATE_FILTER_TODAY) ? 'white' : ''"
                >
                  <v-avatar left v-if="isActiveDateFilter(START_DATE_FILTER_TODAY)">
                    <v-icon>mdi-checkbox-marked-circle</v-icon>
                  </v-avatar>
                  Today
                </v-chip> 
                <v-chip 
                  class="ma-2"
                  @click="setDateFilter(START_DATE_FILTER_TOMORROW)"
                  :color="isActiveDateFilter(START_DATE_FILTER_TOMORROW) ? 'teal' : ''"
                  :text-color="isActiveDateFilter(START_DATE_FILTER_TOMORROW) ? 'white' : ''"
                >
                  <v-avatar left v-if="isActiveDateFilter(START_DATE_FILTER_TOMORROW)">
                    <v-icon>mdi-checkbox-marked-circle</v-icon>
                  </v-avatar>
                  Tomorrow
                </v-chip>
                <v-chip 
                  class="ma-2"
                  @click="setDateFilter(START_DATE_FILTER_YESTERDAY)"
                  :color="isActiveDateFilter(START_DATE_FILTER_YESTERDAY) ? 'teal' : ''"
                  :text-color="isActiveDateFilter(START_DATE_FILTER_YESTERDAY) ? 'white' : ''"
                >
                  <v-avatar left v-if="isActiveDateFilter(START_DATE_FILTER_YESTERDAY)">
                    <v-icon>mdi-checkbox-marked-circle</v-icon>
                  </v-avatar>
                  Yesterday
                </v-chip> 
                <v-chip 
                  class="ma-2"
                  @click="setStateFilter(TASK_STATE_FILTER_ASSIGNED)"
                  :color="isActiveStateFilter(TASK_STATE_FILTER_ASSIGNED) ? 'teal' : ''"
                  :text-color="isActiveStateFilter(TASK_STATE_FILTER_ASSIGNED) ? 'white' : ''"
                >
                  <v-avatar left v-if="isActiveStateFilter(TASK_STATE_FILTER_ASSIGNED)">
                    <v-icon>mdi-checkbox-marked-circle</v-icon>
                  </v-avatar>
                  Assinged
                </v-chip> 
                <v-chip 
                  class="ma-2"
                  @click="setStateFilter(TASK_STATE_FILTER_IN_PROGRESS)"
                  :color="isActiveStateFilter(TASK_STATE_FILTER_IN_PROGRESS) ? 'teal' : ''"
                  :text-color="isActiveStateFilter(TASK_STATE_FILTER_IN_PROGRESS) ? 'white' : ''"
                >
                  <v-avatar left v-if="isActiveStateFilter(TASK_STATE_FILTER_IN_PROGRESS)">
                    <v-icon>mdi-checkbox-marked-circle</v-icon>
                  </v-avatar>
                  In Porgress
                </v-chip>
                <v-chip 
                  class="ma-2"
                  @click="setStateFilter(TASK_STATE_FILTER_ON_HOLD)"
                  :color="isActiveStateFilter(TASK_STATE_FILTER_ON_HOLD) ? 'teal' : ''"
                  :text-color="isActiveStateFilter(TASK_STATE_FILTER_ON_HOLD) ? 'white' : ''"
                >
                  <v-avatar left v-if="isActiveStateFilter(TASK_STATE_FILTER_ON_HOLD)">
                    <v-icon>mdi-checkbox-marked-circle</v-icon>
                  </v-avatar>
                  On Hold
                </v-chip> 
                <v-chip 
                  class="ma-2"
                  @click="setStateFilter(TASK_STATE_FILTER_COMPLETED)"
                  :color="isActiveStateFilter(TASK_STATE_FILTER_COMPLETED) ? 'teal' : ''"
                  :text-color="isActiveStateFilter(TASK_STATE_FILTER_COMPLETED) ? 'white' : ''"
                >
                  <v-avatar left v-if="isActiveStateFilter(TASK_STATE_FILTER_COMPLETED)">
                    <v-icon>mdi-checkbox-marked-circle</v-icon>
                  </v-avatar>
                  Completed
                </v-chip> 
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                  <!-- <template v-slot:activator="{ on }">
                    <v-btn color="primary" dark class="mb-2" v-on="on">New Task</v-btn>
                  </template> -->
                  <v-card>
                    <v-card-title>
                      <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                      <v-container>
                        <v-row>
                          <v-col cols="12" >
                            <v-text-field v-model="editedItem.title" label="Title"></v-text-field>
                          </v-col>
                          <v-col cols="12" >
                            <v-textarea v-model="editedItem.description" label="Description"></v-textarea>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <v-select
                              :items="getTaskTypes"
                              label="Type"
                              v-model="editedItem.type"
                              item-text="name"
                              item-value="id"
                              required
                              outlined
                            ></v-select>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <v-select
                              :items="getTaskStates"
                              label="State"
                              :rules="[stateRule]"
                              v-model="editedItem.state"
                              item-text="name"
                              item-value="id"
                              required
                              outlined
                            ></v-select>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-card-text>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                      <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-toolbar>
              <v-dialog v-model="showTaskDetails" max-width="500px">
                <v-card>
                  <v-card-title>
                    Task: {{taskDetails.title}}
                  </v-card-title>
                  <v-card-text>
                      <v-container>
                        <v-row>
                          <v-col cols="12" >
                            <span class="subtitle-2">Description</span>
                            <p class="body-2">{{taskDetails.description}}</p>
                          </v-col>
                          <v-col cols="6">
                            <span class="subtitle-2">Type:</span>
                            {{taskDetails.type_name}}
                          </v-col>
                          <v-col cols="6">
                            <span class="subtitle-2">State:</span>
                            {{taskDetails.state_name}}
                          </v-col>
                          <v-col cols="6">
                            <span class="subtitle-2">Subject:</span>
                            {{taskDetails.subject}}
                          </v-col>
                          <v-col cols="6">
                            <span class="subtitle-2">Chapter:</span>
                            {{taskDetails.chapter}}
                          </v-col>
                          <v-col cols="6">
                            <span class="subtitle-2">Start:</span>
                            {{taskDetails.start_at}}
                          </v-col>
                          <v-col cols="6">
                            <span class="subtitle-2">End:</span>
                            {{taskDetails.end_at}}
                          </v-col>
                          <v-col cols="6">
                            <span class="subtitle-2">Created On:</span>
                            {{taskDetails.created_at}}
                          </v-col>
                          <v-col cols="6">
                            <span class="subtitle-2">Last updated:</span>
                            {{taskDetails.updated_at}}
                          </v-col>
                        </v-row>
                      </v-container>
                  </v-card-text>
                  <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="showTaskDetails = false">Close</v-btn>
                    </v-card-actions>
                </v-card>
              </v-dialog>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-icon
                small
                class="mr-2"
                @click="showTask(item)"
              >
                mdi-eye
              </v-icon>
              <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
              >
                mdi-pencil
              </v-icon>
              <v-icon
                small
                @click="deleteItem(item)"
              >
                mdi-delete
              </v-icon>
            </template>
          </v-data-table>
       </v-col>
    </v-row>
    <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
      {{ snackText }}
      <v-btn text @click="snack = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import { filter } from 'lodash'
import moment from "moment"

const TASK_STATE_FILTER_ASSIGNED = 2
const TASK_STATE_FILTER_IN_PROGRESS = 3
const TASK_STATE_FILTER_ON_HOLD = 4
const TASK_STATE_FILTER_COMPLETED = 5
const START_DATE_FILTER_TODAY = 1
const START_DATE_FILTER_TOMORROW = 2
const START_DATE_FILTER_YESTERDAY = 3

export default {
  data: () => ({
    snack: false,
    snackColor: '',
    snackText: '',
    dialog: false,
    showTaskDetails: false,
    stateFilter: '',
    filterDate:'',
    editedIndex: -1,
    editedItem: {
      title: '',
      description: '',
      type: 0,
      state: 0
    },
    defaultItem: {
      title: '',
      description: '',
      type: 0,
      state: 0
    },
    taskDetails:{},
    stateRule: v => (v && !!v) || "State is required",
    TASK_STATE_FILTER_ASSIGNED: TASK_STATE_FILTER_ASSIGNED,
    TASK_STATE_FILTER_IN_PROGRESS: TASK_STATE_FILTER_IN_PROGRESS,
    TASK_STATE_FILTER_ON_HOLD: TASK_STATE_FILTER_ON_HOLD,
    TASK_STATE_FILTER_COMPLETED: TASK_STATE_FILTER_COMPLETED,
    START_DATE_FILTER_TODAY: START_DATE_FILTER_TODAY,
    START_DATE_FILTER_TOMORROW: START_DATE_FILTER_TOMORROW,
    START_DATE_FILTER_YESTERDAY: START_DATE_FILTER_YESTERDAY
  }),
  computed: {
    headers() {
      return [
        { text: 'Title', value: 'title', width: 200 },
        { text: 'Description', value: 'description' },
        { text: 'Type', value: 'type_name'},
        { 
          text: 'State',
          value: 'state_name',
          filter: (value, search, item) => {
            if (this.stateFilter) {
              return item.state === this.stateFilter
            }
            return true
          },
          width: 150
        },
        { 
          text: 'Start',
          value: 'start_at',
          filter: value => {
            if (this.filterDate) {
              let today = moment();
            
              if (this.filterDate === START_DATE_FILTER_TODAY) {
                return today.isSame(value, 'days')
              }

              if (this.filterDate === START_DATE_FILTER_TOMORROW) {
                let tomorrow = moment().add(1,'days');
                return tomorrow.isSame(value, 'days')
              }

              if (this.filterDate === START_DATE_FILTER_YESTERDAY) {
                let yesterday = moment().add(-1, 'days');
                return yesterday.isSame(value, 'days')
              }

              return false
            }

            return true
          },
          width: 200
        },
        { text: 'End', value: 'end_at', width: 200 },
        { text: 'Actions', value: 'actions', sortable: false, width: 100 },
      ]
    },
    formTitle () {
      return this.editedIndex === -1 ? 'New task' : 'Edit task'
    },
    ...mapGetters({
      tasks: 'Task/getTasks',
      getStates: 'Task/getStates',
      getTaskTypes: 'Task/getTypes'
    }),
    getTaskStates() {
      let states = [];
      states = filter(this.getStates, function(state){
        return (state.id > TASK_STATE_FILTER_ASSIGNED);

      });
      return states;
    },
  },
  mounted(){
    if (!this.tasks.length) {
      this.fetchMyTasks()
    }
  },
  methods: {
    showTask(task) {
      this.taskDetails = task
      this.showTaskDetails = true
    },
    setDateFilter(value) {
      if (this.filterDate === value) {
        this.filterDate = ''
        return
      }
      this.filterDate = value
    },
    setStateFilter(value) {
      if (this.stateFilter === value) {
        this.stateFilter = ''
        return
      }
      this.stateFilter = value
    },
    isActiveStateFilter(value) {
      return this.stateFilter === value
    },
    isActiveDateFilter(value) {
      return this.filterDate === value
    },
    editItem (item) {
      this.editedIndex = this.tasks.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      if(confirm('Are you sure you want to delete this item?')) {
        this.deleteTask(item.id)
          .then((response) => {
            this.showSnackbar(`${item.title} has been deleted successfully!`, 'success')
          })
      }
    },

    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save () {
      if (this.editedIndex > -1) {
        this.updateTask(this.editedItem)
          .then((response) => {
            this.showSnackbar("Task updated successfully!", 'success')
            this.close()
          })
          .catch(error => {
            let data = error.response.data
            let message = ""
            if (!isEmpty(data.errors)) {
              for (var key in data.errors) {
                    message = data.errors[key][0]
                    break
                }
            }
            else {
              message = data.message
            }

            this.showSnackbar(message, "error")
            this.close()
          })
      }

    },
    showSnackbar(message, type) {
      this.snack = true
      this.snackText = message
      this.snackColor = type
    },
    ...mapActions({
      fetchMyTasks: 'Task/fetchTasks',
      updateTask: 'Task/updateTask',
      deleteTask: 'Task/deleteTask'
    }),
  },
  watch: {
    dialog (val) {
      val || this.close()
    },
  },
}
</script>