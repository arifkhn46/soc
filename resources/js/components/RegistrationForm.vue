<template>
  <div class="w-full max-w-screen-xl mx-auto px-6 pt-16">
    <div class="w-full max-w-sm mx-auto">
      <form  method="POST" id="registeration-form" @submit="register" novalidate class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input v-model="name"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="John Doe" value="" id="name" name="name">
            <p class="text-red-500 text-xs italic" v-if="errors.name" v-text="errors.name[0]"></p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input v-model="email"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" placeholder="user@example.com" value="" id="email" name="email">
            <p class="text-red-500 text-xs italic" v-if="errors.email" v-text="errors.email[0]"></p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input v-model="password"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" placeholder="*******" id="password" name="password">
            <p class="text-red-500 text-xs italic" v-if="errors.password" v-text="errors.password[0]"></p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Confirm Password
            </label>
            <input v-model="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" placeholder="*******" id="password_confirmation" name="password_confirmation">
            <p class="text-red-500 text-xs italic" v-if="errors.password_confirmation" v-text="errors.password_confirmation[0]"></p>
        </div>

        <div class="flex items-center justify-between">
            <button :disabled="submitted" v-bind:class="{'opacity-50 cursor-not-allowed': submitted}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Register
            </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {

  data() {
    return {
      errors: {
        name: [],
        email: [],
        password: [],
        password_confirmation: [],
      },
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      submitted: false,
    }
  },

  methods: {
    register(e) {
      e.preventDefault();

      if (this.validate()) {

        this.submitted = true;

        let data = {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        };

        axios.post("/register", data)
          .then(response => {
              location.reload();
              // console.log(response);
          })
          .catch(error => {
              if (error.response.data.errors) {
                  this.errors = error.response.data.errors;
              }
              this.submitted = false;
              this.password = this.password_confirmation = '';
          });
      }
    },

    validate() {

      this.resetErrors();

      if (!this.name) {
        this.errors.name.push('Name is required.');
      }

      if (!this.email) {
        this.errors.email.push('Email is required.');
      }

      if (!this.validEmail(this.email)) {
        this.errors.email.push('Valid email required.');
      }

      if (!this.password) {
        this.errors.password.push('Password required.');
      }

      if (!this.password_confirmation) {
        this.errors.password_confirmation.push('Please confirm your password.');
      }

      if (this.password_confirmation !== this.password) {
        this.errors.password_confirmation.push('Passowrd dosen\'t match!');
      }

      if (this.hasErrors()) return false;
      return true;
    },
    resetErrors() {
      for (const key in this.errors) {
        if (this.errors.hasOwnProperty(key)) {
          this.errors[key] = [];
        }
      }
    },
    hasErrors() {
      for (const key in this.errors) {
        if (this.errors.hasOwnProperty(key)) {
          if (this.errors[key].length) return true;
        }
      }
    }

  }

}
</script>