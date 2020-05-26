<template>
  <v-container fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" v-if="errors.length">
        <v-alert
          dismissible
          type="error"
          icon="mdi-cloud-alert"
          prominent
          @input="onClose"
        >{{errors}}</v-alert>
      </v-col>
      <v-col cols="12" sm="8" md="4">
        <v-card>
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Register</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form" v-model="valid" :lazy-validation="true">
              <v-text-field
                v-model="name"
                :rules="nameRules"
                label="Name"
                prepend-icon="mdi-account"
                required
              ></v-text-field>
              <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                prepend-icon="mdi-account"
                required
              ></v-text-field>

              <v-text-field
                id="password"
                label="Password"
                name="password"
                prepend-icon="mdi-lock"
                type="password"
                required
                v-model="password"
                :rules="passwordRules"
              ></v-text-field>
              <v-text-field
                id="password_confirmation"
                label="Confirm password"
                name="password_confirmation"
                prepend-icon="mdi-lock"
                type="password"
                required
                v-model="password_confirmation"
                :rules="passwordConfirmationRules"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" :disabled="!valid" @click="validate">Register</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { isEmpty } from "lodash";

export default {
  data: () => ({
    valid: true,
    name: "",
    nameRules: [
      v => !!v || "Name is required",
      v => v.length > 4 || "Name must be atleast of 4 characters"
    ],
    email: "",
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+\..+/.test(v) || "E-mail must be valid"
    ],
    password: "",
    passwordRules: [v => !!v || "Password is required"],
    password_confirmation: "",
    errors: ""
  }),
  computed: {
    passwordConfirmationRules() {
      return [
         v => !!v || "Please confirm the password.",
         () => (this.password === this.password_confirmation) || 'Password does not match',
      ]
    }
  },
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        let data = {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        };
        this.$store
          .dispatch("User/register", data)
          .then(response => {
            this.resetErrors();
            console.log(response);
            // if (response.status === 201) {
              
            // }
          })
          .catch(error => {
            if (error.response.data) {
              let data = error.response.data

              if (!isEmpty(data.errors)) {
                for (var key in data.errors) {
                      this.errors = data.errors[key][0]
                      break
                  }
              } 
              else {
                this.errors = data.message
              }
            }
          });
      }
    },
    resetErrors() {
      this.errors = "";
    },
    onClose() {
      this.resetErrors();
    }
  }
};
</script>