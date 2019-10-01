/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import 'v-markdown-editor/dist/index.css';
import Editor from 'v-markdown-editor';
import VueMarkdown from 'vue-markdown';

Vue.use( VueRouter );
Vue.use( Editor );
Vue.use( VueMarkdown );

// Views

import App from './views/App';
import Home from './views/Home';
import Blog from "./views/Blog";
import BlogPost from "./views/BlogPost";
import Create from "./views/Create";
import Portfolio from "./views/Portfolio";
import PortfolioItem from "./views/PortfolioItem";
import Tutorials from "./views/Tutorials";
import Contact from "./views/Contact";
import Admin from "./views/Admin";
import EditPost from "./views/EditPost";

// Global components

Vue.component('global-header', require('./views/GlobalHeader').default);
Vue.component('global-footer', require('./views/GlobalFooter').default);
Vue.component('vue-markdown', require('vue-markdown').default);

// Router

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
            path: '/blog/view/:post_slug/:post_id',
            name: "blog-post",
            component: BlogPost,
            props: true,
        },
        {
            path: "/blog/create",
            name: "create",
            component: Create
        },
        {
            path: "/portfolio",
            name: "portfolio",
            component: Portfolio
        },
        {
            path: '/portfolio/view/:portfolio_item_slug/:portfolio_item_id',
            name: "portfolio-item",
            component: PortfolioItem,
            props: true,
        },
        {
            path: "/tutorials",
            name: "tutorials",
            component: Tutorials
        },
        {
            path: "/contact",
            name: "contact",
            component: Contact
        },
        {
            path: "/admin",
            name: "admin",
            component: Admin
        },
        {
            path: '/edit/view/:post_slug/:post_id',
            name: "edit-post",
            component: EditPost,
            props: true,
        },
    ]
})

// Mixins

Vue.mixin({
    methods: {
        capitalizeFirstLetter: str => str.charAt(0).toUpperCase() + str.slice(1),
        truncateResourceBody: function(resourceList) {
            resourceList.map(resource => {
                resource.body = resource.body.substring(0,144)+"...",
                console.log(resource.body)
            })
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
        App,
        Admin
    },
    router,
});
