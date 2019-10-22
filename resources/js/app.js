// Load project dependencies (Laravel bootstrap)

require('./bootstrap');

// Modules

import Vue from 'vue';
import router from './router.js';
import Editor from 'v-markdown-editor';
import VueMarkdown from 'vue-markdown';

Vue.use( Editor );
Vue.use( VueMarkdown );

// Styles

import 'v-markdown-editor/dist/index.css';

// Views

import App from './views/App';
import Admin from "./views/Admin";

// Global components

Vue.component('global-header', require('./views/layouts/GlobalHeader').default);
Vue.component('global-footer', require('./views/layouts/GlobalFooter').default);
Vue.component('vue-markdown', require('vue-markdown').default);


// Create Vue App

const app = new Vue({
    el: '#app',
    components: {
        App,
        Admin
    },
    router,
});
