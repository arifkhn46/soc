<template>
  <v-container
    fluid
    >
    <v-row
        justify="center"
    >
      <v-col cols="6">
        <v-data-table
          :headers="headers"
          :items="roles"
          class="elevation-1"
        >
        <template v-slot:top>
          <v-toolbar flat color="white">
            <v-toolbar-title>User Roles</v-toolbar-title>
            <v-divider
              class="mx-4"
              inset
              vertical
            ></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on }">
                <v-btn color="primary" dark class="mb-2" v-on="on">Create role</v-btn>
              </template>
               <v-card>
                <v-card-title>
                  <span class="headline">{{ formTitle }}</span>
                </v-card-title>
                 <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12" md="6">
                        <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
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
        </template>
        <template v-slot:item.actions="{ item }">
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
  </v-container>
</template>

<script>
export default {
  props:["userRoles"],
  data(){
    return {
      editedIndex:-1,
      dialog: false,
      roles: this.userRoles || [],
      editedItem: {
        name: '',
      },
      headers: [
        { text: 'Name', value: 'name' },
        { text: 'Actions', value: 'actions', sortable: false },
      ]
    }
  },
  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Create New Role' : 'Edit Role'
    },
  },
  methods: {
    save() {
      httpClient.post('/roles', { name: this.editedItem.name })
        .then((response) => {
          this.$toast.success('Role Created Successfully!' ,{
            dismissable: true,
            queueable: true,
            timeout: 5000,
          })
          this.roles.push(response.data.role);
          this.dialog = false;
        })
        .catch((errors) => {
          this.$toast.error(errors.response.data.message ,{
            dismissable: true,
            queueable: true,
            timeout: 5000,
          })
        })
    },
    close() {
      this.dialog = false
    },
    deleteItem(item) {
      this.$toast.warning('This feature is pending!' ,{
        dismissable: true,
        timeout: 5000,
      })
    },
    editItem(item) {
      this.$toast.warning('This feature is pending!' ,{
        dismissable: true,
        timeout: 5000,
      })
    }
  },
}
</script>