<template>
    <div class="container-auth">
        <main class="content-auth" role="main">
            <header class="auth-header">
                <h1>Login</h1>
            </header>
            <form method="POST" class="login" v-on:submit.prevent="submitLogin">
                <div class="form-row">
                    <label>E-Mail</label>
                    <input type="email" required autofocus autocomplete="email" v-model="email">
                </div>
                <div class="form-row">
                    <label>Password</label>
                    <input id="password" type="password" required v-model="password">
                </div>
                <div class="form-row is-last">
                    <div class="form-buttons">
                        <input type="submit" class="btn" value="Login">
                    </div>
                </div>
                <div v-if="loginError" class="form-row error-message">
                    <p>Login failed. Please check your credentials.</p>
                </div>
                <div v-if="debugInfo" class="form-row debug-info">
                    <p>Debug info: {{ debugInfo }}</p>
                </div>
            </form>
        </main>
    </div>
</template>

<script>
    import store from '../../store'
    export default {
        data() {
            return {
                email: '',
                password: '',
                loginError: false,
                debugInfo: ''
            }
        },
        created() {
            // Clear any existing tokens on login page load
            localStorage.removeItem('token');
            store.commit('logoutUser');
            console.log('Login component created, token cleared');
        },
        methods: {
            submitLogin() {
                this.loginError = false;
                this.debugInfo = '';
                console.log('Login attempt with:', this.email);
                
                axios.post('/api/auth/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    console.log('Login response:', response.data);
                    this.debugInfo = 'Login successful, token received';
                    
                    // Store the token first
                    localStorage.setItem('token', response.data.access_token);
                    console.log('Token stored in localStorage');
                    
                    // Then login user through store
                    store.commit('loginUser');
                    console.log('Store updated, isLoggedIn:', store.state.isLoggedIn);
                    
                    // Navigate to dashboard using router
                    this.$router.push({ name: 'dashboard' });
                }).catch(error => {
                    console.error('Login error:', error);
                    this.loginError = true;
                    this.debugInfo = 'Login failed: ' + (error.response ? error.response.status : 'No response');
                });
            }
        }
    }
</script>

<style scoped>
.error-message {
    color: red;
    margin-top: 10px;
}
.debug-info {
    color: blue;
    margin-top: 10px;
    font-family: monospace;
}
</style>