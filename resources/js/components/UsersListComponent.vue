<template>
   <v-container
    fluid
    >
    <v-row
        justify="center"
    >
      <v-col cols="8">
        <v-data-table
          :headers="headers"
          :items="users"
          class="elevation-1"
        >
          <template v-slot:top>
            <v-toolbar flat color="white">
              <v-toolbar-title>Users</v-toolbar-title>
              <v-divider
                class="mx-4"
                inset
                vertical
              ></v-divider>
              <v-spacer></v-spacer>
              <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on }">
                  <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                  </v-card-title>

                  <v-card-text>
                    <v-form
                          ref="form"
                          v-model="valid"
                          :lazy-validation="true"
                        >
                        <v-container>
                          <v-row>
                            <v-col cols="12" md="12">
                              <v-text-field 
                                v-model="editedUser.name" 
                                label="Full Name" 
                                required
                                :rules="nameRules"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="12">
                              <v-text-field
                                v-model="editedUser.email"
                                :rules="emailRules"
                                label="E-mail"
                                required
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                              <v-text-field 
                                v-model="editedUser.password" 
                                :label="editedIndex > -1 ? 'New Password' : 'Password'" 
                                type="password"
                              >
                              </v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                              <strong>Roles</strong>
                              <v-checkbox
                                v-for="(role, key) in roles"
                                :key="key"    
                                v-model="editedUser.roles"
                                :label="role.name"
                                :value="role.id"
                              ></v-checkbox>
                            </v-col>
                          </v-row>
                        </v-container>
                    </v-form>
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
          <template v-slot:item.roles="{ item }" >
            {{ getUserRoles(item) }}
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon
              small
              class="mr-2"
              @click="editItem(item)"
            >
              mdi-pencil
            </v-icon>
            <!-- <v-icon
              small
              @click="deleteItem(item)"
            >
              mdi-delete
            </v-icon> -->
          </template>
        </v-data-table>        
      </v-col>
    </v-row>
  </v-container>
</template>

<script>

export default {
  props: ['usersList', 'userRoles'],
  data() {
    return {
      dialog: false,
      users: this.usersList || [],
      roles: this.userRoles || [],
      valid: true,
      editedIndex: -1,
      editedUser: {
        name: '',
        email: '',
        password: '',
        roles: []
      },
      defaultUser: {
        name: '',
        email: '',
        password: '',
        roles: []
      },
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Email', value: 'email' },
        { text: 'Roles', value: 'roles' },
        { text: 'Created', value: 'created_at' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      nameRules: [
        v => !!v || "Name is required",
        v => v.length > 4 || "Name must be atleast of 4 characters"
      ],
      passwordRules: [v => !!v || "Password is required"],
      roleRules: [v => !!v || "Role is required"],
    }
  },
  computed: {
    formTitle () {
        return this.editedIndex === -1 ? 'Create User' : 'Edit User'
      },
  },
  methods : {
    getUserRoles(item) {
      let roles = '';
      if (item.roles.length) {
        item.roles.map(function(role) {
          if (roles.length) roles += ','
          roles += role.name;
        });
        return roles;
      }
    },
    editItem (item) {
      this.editedIndex = this.users.indexOf(item)
      this.editedUser = Object.assign({}, item)
      if (this.editedUser.roles.length) {
        let roles = [];
        this.editedUser.roles.map(function (role) {
          roles.push(role.id);
        });
        this.editedUser.roles = roles;
      }
      this.dialog = true
    },
    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedUser = Object.assign({}, this.defaultUser)
        this.editedIndex = -1
        this.$refs.form.resetValidation()
      })
    },

    save () {
      if (!this.$refs.form.validate())  return
      
      if (this.editedIndex > -1) {
        httpClient.patch(`users/${this.editedUser.id}/update`, { ...this.editedUser, _method:'POST'})
          .then((response) => {
            this.$toast.success('User updated!' ,{
              dismissable: true,
              queueable: true,
              timeout: 5000,
            })
            this.close()            
            Object.assign(this.users[this.editedIndex], response.data.user)
          })
          .catch(error => {
            this.$toast.error(error.response.data.message ,{
              dismissable: true,
              queueable: true,
              timeout: 5000,
            })
          });
      } else {
        
      }      
    },
  }
}
</script>