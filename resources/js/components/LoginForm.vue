<template>
    <div class="w-full max-w-screen-xl mx-auto px-6 pt-16">
        <div class="w-full max-w-sm mx-auto">
            <form method="POST" id="login-form" novalidate="true" @submit="attempLogin" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input v-model="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" placeholder="user@example.com" value="" id="email" name="email">
                    <p class="text-red-500 text-xs italic" v-if="errors.email" v-text="errors.email[0]"></p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input v-model="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" placeholder="*******" id="password" name="password">
                    <p class="text-red-500 text-xs italic" v-if="errors.password" v-text="errors.password[0]"></p>
                </div>
                <div class="pb-4">
                    <input type="checkbox" name="remember" > Remember Me
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                        Forgot Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    let errorsBag = {
        email: [],
        password:[]
    };

    export default {
        data() {
            return {
                errors: errorsBag,
                email: '',
                password: '',
            };
        },
        methods: {
            attempLogin(e) {
                e.preventDefault();
                if (this.validate()) {
                    axios.get('/sanctum/csrf-cookie').then(response => {
                        axios.post("/login", {email:this.email, password:this.password})
                            .then(response => {
                                location.reload();
                            })
                            .catch(error => {
                                if (error.response.data.errors) {
                                    this.errors = error.response.data.errors;
                                }
                            });
                    });
                }
            },
            validate() {

                this.errors.email = [];
                this.errors.password = [];

                if (!this.email) {
                    this.errors.email.push('Email required.');
                }

                if (!this.validEmail(this.email)) {
                    this.errors.email.push('Valid email required.');
                }

                if (!this.password) {
                    this.errors.password.push('Password required.');
                }

                if (this.errors.email.length || this.errors.password.length) return false;
                return true;
            },

        },

    }
</script>
