window._ = require('lodash');

window.moment = require('moment');


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set up an axios interceptor to add the auth token to every request
window.axios.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    // Make sure to set the Authorization header for every request
    config.headers['Authorization'] = `Bearer ${token}`;
    // For debugging only
    // console.log('Request with token:', config.url);
  } else {
    // For debugging only
    // console.log('Request without token:', config.url);
  }
  return config;
}, error => {
  return Promise.reject(error);
});

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
