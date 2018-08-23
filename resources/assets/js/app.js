
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('exemple', require('./components/ExampleComponent.vue'));
Vue.component('heure', require('./components/HeureComponent.vue'));
Vue.component('date', require('./components/DateComponent.vue'));
Vue.component('calendrier', require('./components/CalendrierComponent.vue'));
Vue.component('meteo', require('./components/MeteoComponent.vue'));
Vue.component('music', require('./components/MusicComponent.vue'));
Vue.component('twitch', require('./components/TwitchComponent.vue'));

Vue.component('spotify', require('./components/profile/spotify/SpotifyComponent.vue'));
const app = new Vue({
    el: '#dashboard'
});
