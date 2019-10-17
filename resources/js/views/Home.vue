<template>
    <div class="main-container">

        <global-header :userName="userName" :userId="userId" />

        <main>

            <div class="container-fluid global-banner">
                <h1>Jeremy Bratcher</h1>
                <p class="lead">Full Stack Web Developer</p>
            </div>

            <!-- Blog  -->

            <section class="container content-section">

                <h2 class="underline">Blog</h2>

                <p class="lead">Latest posts</p>

                <BlogList :posts="this.posts" />

            </section>

            <!-- Portfolio  -->

            <section class="container content-section">

                <h2 class="underline">Portfolio</h2>

                <p class="lead">Some of my best work</p>

                <ul class="posts-list">
                    <li v-for="portfolioitem in portfolioitems" :key="portfolioitem.id">
                        <router-link :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioitem.slug, portfolio_item_id: portfolioitem.id} }">
                            <img :src="portfolioitem.image_src" :alt="portfolioitem.title">
                            <h5 class="card-title">{{portfolioitem.title}}</h5>
                            <div class="card-body">
                                <vue-markdown :source="portfolioitem.body"></vue-markdown>
                                <div class="card-buttons">
                                    <router-link class="btn btn-primary" :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioitem.slug, portfolio_item_id: portfolioitem.id} }">Read More</router-link>
                                    <a :href="portfolioitem.demo_url" class="btn btn-primary">Demo</a>
                                    <a :href="portfolioitem.repo_url" class="btn btn-primary">Github Repo</a>
                                </div>
                            </div>
                        </router-link>
                    </li>
                </ul>

            </section>

            <!-- Tutorials  -->

            <section class="container content-section">

                <h2 class="underline">Tutorials</h2>

                <p class="lead">Learn something new</p>

                <ul class="posts-list">
                    <li v-for="tutorial in tutorials" :key="tutorial.id">
                        <router-link :to="{ name: 'tutorial', params: { tutorial_slug: tutorial.slug, tutorial_id: tutorial.id} }">
                            <img :src="tutorial.image_src" :alt="tutorial.title">
                            <h5 class="card-title">{{tutorial.title}}</h5>
                            <div class="card-body">
                                <vue-markdown :source="tutorial.body"></vue-markdown>
                            </div>
                        </router-link>
                    </li>
                </ul>

            </section>

            <section class="container-fluid content-section about-intro">

                <router-link class="nav-link" :to="{ name: 'contact'}" v-for="user in users" :key="user.id">
                    <section class="card">
                        <img class="card-img-top" :src="user.profile_pic_src" :alt="user.name">
                        <div class="card-body">
                            <h2 class="card-title">About Me</h2>
                            <p class="card-text">Tech enthusiast with a strong eye for visual design and a knack for problem solving. Interested in UI/UX and SPA/PWAs.</p>
                        </div>
                    </section>
                </router-link>

            </section>

        </main>

        <global-footer />

    </div>
</template>

<script>
    import BlogList from './blog/BlogList.vue';
    import { getResourcesMixin } from '../mixins/getResourcesMixin.js';

    export default {
        components: {
            BlogList,
        },
        mixins: [ getResourcesMixin ],
        created() {
            this.getResources('posts');
            this.getResources('portfolioitems');
            this.getResources('tutorials');
            this.getUsers();
            console.log("Home vue mounted");
        },
        data() {
            return {
                users: [],
            };
        },
        methods: {
            getUsers() {
                axios.get("/api/users").then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    this.error = error.response.data.message || error.message;
                    console.log(`Error in getUsers: ${this.error}`);
                });
            },
        },
        props: {
            userId: {
                type: Number
            },
            userName: {
                type: String
            }
        }
    };
</script>
