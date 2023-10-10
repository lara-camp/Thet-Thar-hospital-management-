/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Pusher from 'pusher-js';
import Echo from 'laravel-echo'

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '45465ed7bfec0f979e65',
    cluster: 'ap1',
    forceTLS: true
});

setTimeout(()=>{
    window.Echo.private('notification')
        .listen('.private_msg',(e)=>{
            console.log(e);
        })
},200)
