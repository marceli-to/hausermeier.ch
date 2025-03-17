<template>
    <router-view></router-view>
</template>
<script>
import store from '../store';
export default {
  created() {
    // Only validate the token if we're not on the login page
    if (this.$router.currentRoute.name !== 'login' && localStorage.getItem('token')) {
      // Ensure the Authorization header is set correctly for this request
      const token = localStorage.getItem('token');
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      
      // Use the correct endpoint for JWT auth with explicit headers
      axios.post('/api/auth/me', {}, {
        headers: {
          'Authorization': 'Bearer ' + token
        }
      }).then(response => {
        store.commit('loginUser');
      }).catch(error => {
        // Don't try to refresh here - let the axios interceptor handle it
        // This prevents double refresh attempts that can cause blacklisting
        if (error.response && error.response.status === 401) {
          // The axios interceptor will handle the refresh
        }
      });
    } else if (this.$router.currentRoute.name !== 'login') {
      store.commit('logoutUser');
      if (this.$router.currentRoute.meta && 
          this.$router.currentRoute.meta.requiresAuth) {
        this.$router.push({name: 'login'});
      }
    }
  }
}
</script>