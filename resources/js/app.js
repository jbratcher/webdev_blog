/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Modules

import Vue from 'vue';
import VueRouter from 'vue-router';
import Editor from 'v-markdown-editor';
import VueMarkdown from 'vue-markdown';

Vue.use( VueRouter );
Vue.use( Editor );
Vue.use( VueMarkdown );

// Styles

import 'v-markdown-editor/dist/index.css';

// Views

import App from './views/App';
import Home from './views/Home';
import Contact from "./views/Contact";
import Admin from "./views/Admin";

// Blog

import Blog from "./views/blog/Blog.vue";
import BlogSingle from "./views/blog/BlogSingle.vue";
import CreateBlogPost from "./views//blog/CreateBlogPost.vue";
import EditBlogItem from "./views/blog/EditBlogItem";

// Portfolio

import Portfolio from "./views/portfolio/Portfolio.vue";
import PortfolioSingle from "./views/portfolio/PortfolioSingle.vue";
import EditPortfolioItem from "./views/portfolio/EditPortfolioItem";

// Tutorial

import Tutorials from "./views/tutorial/Tutorials.vue";
import TutorialSingle from "./views/tutorial/TutorialSingle.vue";
import EditTutorialItem from "./views/tutorial/EditTutorialItem";

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
            path: "/blog/view/:post_slug?/:post_id?",
            name: "blog-single",
            component: BlogSingle,
            props: true,
        },
        {
            path: "/blog/create",
            name: "create-blog-post",
            component: CreateBlogPost
        },
        {
            path: '/blog/edit/view/:post_slug/:post_id',
            name: "edit-blog-item",
            component: EditBlogItem,
            props: true,
        },
        {
            path: "/portfolio",
            name: "portfolio",
            component: Portfolio
        },
        {
            path: '/portfolio/view/:portfolio_item_slug?/:portfolio_item_id?',
            name: "portfolio-single",
            component: PortfolioSingle,
            props: true,
        },
        {
            path: '/portfolio/edit/view/:portfolio_item_slug/:portfolio_item_id',
            name: "edit-portfolio-item",
            component: EditPortfolioItem,
            props: true,
        },
        {
            path: "/tutorials",
            name: "tutorials",
            component: Tutorials
        },
        {
            path: '/tutorials/view/:tutorial_slug?/:tutorial_id?',
            name: "tutorial-single",
            component: TutorialSingle,
            props: true,
        },
        {
            path: '/tutorials/edit/view/:tutorial_slug/:tutorial_id',
            name: "edit-tutorial-item",
            component: EditTutorialItem,
            props: true,
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
    ]
})

// Global Mixins

Vue.mixin({
    /**
     * Caution: Global mixins affect ever Vue instance and can have unexpected consequences.
     * Only use in for certain use cases like custom option handling.
    */
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
