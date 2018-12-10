
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.events = new Vue();

window.noty = function(notification){
    window.events.$emit('notification', notification);
};

window.handleErrors = function(error) {
    if(error.response.status === 422) {
        window.noty({
            message: 'You have validation errors, please try again',
            type: 'danger'
        });
    }

    window.noty({
        message: 'Something went wrong. Please refresh the page',
        type: 'danger'
    });
};
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('vue-noty', require('./components/Noty.vue'));
Vue.component('vue-player', require('./components/Player.vue'));
Vue.component('vue-stripe', require('./components/Stripe.vue'));
Vue.component('vue-login', require('./components/Login.vue'));
Vue.component('vue-lessons', require('./components/Lessons.vue'));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
