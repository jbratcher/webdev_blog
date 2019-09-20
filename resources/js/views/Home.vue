<template>
    <div class="main-container">

        <global-header />

        <main>

            <div class="container-fluid global-banner">
                <h1>Jeremy Bratcher</h1>
                <h2 class="lead">Full Stack Web Developer</h2>
            </div>

            <section class="container blog-intro">

                <h2>Blog</h2>
                <p class="lead">Latest posts</p>

                <ul class="posts-list">

                    <li v-for="post in posts" :key="post.id">
                        <a href="#">
                            <section class="card">
                                <img class="card-img-top" :src="post.image_src" :alt="post.title">
                                <div class="card-body">
                                    <h5 class="card-title">{{post.title}}</h5>
                                    <p class="card-text" v-html="post.body"></p>
                                    <a href="#" class="btn btn-primary">Read More</a>
                                </div>
                            </section>
                        </a>
                    </li>

                </ul>

            </section>

            <section class="container project-intro">

                <h2>Projects</h2>
                <p class="lead">Some of my best work</p>

                <ul class="posts-list">

                    <li class="portfolio-items-card" v-for="portfolioitem in portfolioitems" :key="portfolioitem.id">
                        <a href="#">
                            <section class="card">
                                <img class="card-img-top" :src="portfolioitem.image_src" :alt="portfolioitem.title">
                                <div class="card-body">
                                    <h5 class="card-title">{{portfolioitem.title}}</h5>
                                    <p class="card-text">{{portfolioitem.body.substring(0,144)+"..."}}</p>
                                    <a :href="portfolioitem.demo_url" class="btn btn-primary">Demo</a>
                                    <a :href="portfolioitem.repo_url" class="btn btn-primary">Github Repo</a>
                                </div>
                            </section>
                        </a>
                    </li>

                </ul>
            </section>

            <section class="container-fluid about-intro">

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
    export default {
        mounted() {
            this.getPosts();
            this.getPortfolioItems();
            this.getUsers();
            console.log("Home vue mounted");
        },
        data() {
            return {
                posts: {},
                portfolioitems: {},
                users: {},
            };
        },
        methods: {
            getPosts() {
                axios.get("/api/posts").then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            getPortfolioItems() {
                axios.get("/api/portfolioitems").then(response => {
                    this.portfolioitems = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            getUsers() {
                axios.get("/api/users").then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
        }
    };
</script>
