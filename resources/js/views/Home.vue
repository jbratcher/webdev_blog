<template>
    <div class="main-container">

        <global-header :userName="userName" :userId="userId" />

        <main>

            <div class="container-fluid global-banner">
                <h1>Jeremy Bratcher</h1>
                <p class="lead">Full Stack Web Developer</p>
            </div>

            <section class="container content-section">

                <h2 class="underline">Blog</h2>
                <p class="lead">Latest posts</p>

                <ul class="posts-list">

                    <li v-for="post in posts" :key="post.id">
                        <router-link :to="{ name: 'blog-post', params: { post_slug: post.slug, post_id: post.id} }">
                            <img :src="post.image_src" :alt="post.title">
                            <h5 class="card-title">{{post.title}}</h5>
                            <vue-markdown class="card-body" :source="post.body"></vue-markdown>
                        </router-link>
                    </li>

                </ul>

            </section>

            <section class="container content-section">

                <h2 class="underline">Projects</h2>
                <p class="lead">Some of my best work</p>

                <ul class="posts-list">

                    <li v-for="portfolioItem in portfolioItems" :key="portfolioItem.id">
                        <router-link :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioItem.slug, portfolio_item_id: portfolioItem.id} }">
                            <img :src="portfolioItem.image_src" :alt="portfolioItem.title">
                            <h5 class="card-title">{{portfolioItem.title}}</h5>
                            <div class="card-body">
                                <vue-markdown :source="portfolioItem.body"></vue-markdown>
                                <div class="card-buttons">
                                    <router-link class="btn btn-primary" :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioItem.slug, portfolio_item_id: portfolioItem.id} }">Read More</router-link>
                                    <a :href="portfolioItem.demo_url" class="btn btn-primary">Demo</a>
                                    <a :href="portfolioItem.repo_url" class="btn btn-primary">Github Repo</a>
                                </div>
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
    export default {
        mounted() {
            this.getPosts();
            this.getPortfolioItems();
            this.getUsers();
            console.log("Home vue mounted");
        },
        data() {
            return {
                posts: [],
                portfolioItems: [],
                users: [],
            };
        },
        methods: {
            getPosts() {
                axios.get("/api/posts").then(response => {
                    this.posts = response.data;
                })
                .then(() => this.truncatePosts())
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            truncatePosts() {
                this.posts.map(post => {
                    post.body = post.body.substring(0,144)+"...";
                });
            },
            getPortfolioItems() {
                axios.get("/api/portfolioitems").then(response => {
                    this.portfolioItems = response.data;
                })
                .then(() => this.truncatePortfolioItems())
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            truncatePortfolioItems() {
                this.portfolioItems.map(portfolioItem => {
                    portfolioItem.body = portfolioItem.body.substring(0,144)+"...";
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
