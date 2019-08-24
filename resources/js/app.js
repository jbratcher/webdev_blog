/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import CKEditor from '@ckeditor/ckeditor5-vue';

Vue.use( VueRouter );
Vue.use( CKEditor );

import App from './views/App';
import Home from './views/Home';
import Blog from "./views/Blog";
import Create from "./views/Create";

Vue.component('global-header', require('./views/GloblaHeader').default);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/blog",
            name: "blog",
            component: Blog
        },
        {
            path: "/blog/create",
            name: "create",
            component: Create
        },

    ]
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
        App,
    },
    router,
});
