<template>
    <form @submit.prevent="login" class="p-2">
        <b-alert variant="danger" :show="error !== null" dismissible @dismissed="error = null">
            {{ error }}
        </b-alert>

        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <b-form-group label="Email">
            <b-form-input v-model.trim="email" />
        </b-form-group>
        <b-form-group label="Password">
            <b-form-input v-model.trim="password" type="password" />
        </b-form-group>

        <b-form-group>
            <b-button variant="primary" type="submit" :disabled="loading">Sing in</b-button>
        </b-form-group>
    </form>
</template>

<script>
    export default {
        name: "LoginForm",
        data() {
            return {
                email: "",
                password: "",
                error: null
            }
        },
        methods: {
            login() {
                const payload = {
                    Username: this.email,
                    Password: this.password
                };

                if (this.$route.query.redirect) {
                    this.$router.push(this.$route.query.redirect);
                }

            }
        }
    };
</script>