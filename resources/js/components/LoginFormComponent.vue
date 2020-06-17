<template>
    <v-container
    fluid
    >
    <v-row
        align="center"
        justify="center"
    >
        <v-col
        cols="12"
        sm="8"
        md="4"
        >
        <v-card>
            <v-toolbar
              color="primary"
              dark
              flat
            >
              <v-toolbar-title>Login</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <v-form
                ref="form"
                v-model="valid"
                :lazy-validation="true"
              >
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
            </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                  color="primary"
                  :disabled="!valid"
                  @click="validate"
              >
              Login
              </v-btn>
            </v-card-actions>
        </v-card>
        </v-col>
    </v-row>
    </v-container>
</template>

<script>
import { isEmpty } from 'lodash'
export default {
  data:  () => ({
    valid: true,
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
    password:'',
    passwordRules: [
      v => !!v || 'Password is required',
    ],
    errors: '',
  }),
  methods: {
    validate () {
      if (this.$refs.form.validate()) {
        httpClient.get('/sanctum/csrf-cookie').then(response => {
            httpClient.post("/login", {email:this.email, password:this.password})
                .then(response => {
                  this.$toast.success('Success!' ,{
                    dismissable: true,
                    timeout: 5000,
                  })
                  location.reload()
                })
                .catch(error => {
                  this.$toast.error(error.response.data.message ,{
                    dismissable: true,
                    timeout: 5000,
                  })
                });
        });
      }
    },
  }
}
</script>
