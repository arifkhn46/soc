
const axios = require('axios');

const httpClient = axios.create({
    headers: {
        baseURL: '/',
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
    }
  });

httpClient.interceptors.response.use((response) => {
    return response;
}, (error) => {
    
    let data = error.response.data

    if (data.errors && data.errors.length) {
        for (var key in data.errors) {
            error.response.data.message = data.errors[key][0]
            break
        }
    }

    if (!error.response.data.message || error.response.data.message === "")  {
        error.response.data.message = "Something went wrong!";
    }

    return Promise.reject(error);
});

window.httpClient = httpClient;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
