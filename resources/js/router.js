// Setup

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use( VueRouter );

// Views

import Admin from "./views/Admin";
import Home from './views/Home';
import Contact from "./views/Contact";

// Blog

import Blog from "./views/blog/Blog.vue";
import BlogSingle from "./views/blog/BlogSingle.vue";
import CreateBlogItem from "./views//blog/CreateBlogItem.vue";
import EditBlogItem from "./views/blog/EditBlogItem";

// Portfolio

import Portfolio from "./views/portfolio/Portfolio.vue";
import PortfolioSingle from "./views/portfolio/PortfolioSingle.vue";
import CreatePortfolioItem from "./views/portfolio/CreatePortfolioItem.vue";
import EditPortfolioItem from "./views/portfolio/EditPortfolioItem";

// Tutorial

import Tutorials from "./views/tutorial/Tutorials.vue";
import TutorialSingle from "./views/tutorial/TutorialSingle.vue";
import CreateTutorialItem from "./views/tutorial/CreateTutorialItem.vue";
import EditTutorialItem from "./views/tutorial/EditTutorialItem.vue";

import Users from "./views/user/Users.vue"
import UserSingle from "./views/user/UserSingle.vue";
import CreateUserItem from "./views/user/CreateUserItem.vue";
import EditUserItem from "./views/user/EditUserItem.vue";

// Router

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
            props: true,
        },
        {
            path: "/blog",
            name: "blog",
            component: Blog,
            props: true,
        },
        {
            path: "/blog/view/:slug?/:id?",
            name: "blog-single",
            component: BlogSingle,
            props: true,
        },
        {
            path: "/blog/create",
            name: "create-blog-item",
            component: CreateBlogItem,
            props: true,
        },
        {
            path: '/blog/edit/view/:slug?/:id?',
            name: "edit-blog-item",
            component: EditBlogItem,
            props: true,
        },
        {
            path: "/portfolio",
            name: "portfolio",
            component: Portfolio,
            props: true,
        },
        {
            path: '/portfolio/view/:slug?/:id?',
            name: "portfolio-single",
            component: PortfolioSingle,
            props: true,
        },
        {
            path: "/portfolio/create",
            name: "create-portfolio-item",
            component: CreatePortfolioItem,
            props: true,
        },
        {
            path: '/portfolio/edit/view/:slug?/:id?',
            name: "edit-portfolio-item",
            component: EditPortfolioItem,
            props: true,
        },
        {
            path: "/tutorials",
            name: "tutorials",
            component: Tutorials,
            props: true,
        },
        {
            path: '/tutorials/view/:slug?/:id?',
            name: "tutorial-single",
            component: TutorialSingle,
            props: true,
        },
        {
            path: "/tutorial/create",
            name: "create-tutorial-item",
            component: CreateTutorialItem,
            props: true,
        },
        {
            path: '/tutorials/edit/view/:slug?/:id?',
            name: "edit-tutorial-item",
            component: EditTutorialItem,
            props: true,
        },
        {
            path: "/users",
            name: "users",
            component: Users,
            props: true,
        },
        {
            path: '/users/view/:name?/:id?',
            name: "user-single",
            component: UserSingle,
            props: true,
        },
        {
            path: "/user/create",
            name: "create-user-item",
            component: CreateUserItem,
            props: true,
        },
        {
            path: '/users/edit/view/:slug?/:id?',
            name: "edit-user-item",
            component: EditUserItem,
            props: true,
        },
        {
            path: "/contact",
            name: "contact",
            component: Contact,
            props: true,
        },
        {
            path: "/admin",
            name: "admin",
            component: Admin,
            props: true,
        },
    ]
});

export default router;
