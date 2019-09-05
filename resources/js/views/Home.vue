<template>
    <div class="main-container">

        <global-header />

        <main>

            <div class="container-fluid background-image">
                <h1>Full Stack Web Dev</h1>
                <p class="lead">Creating software, creating change.</p>
            </div>

            <section class="container blog-intro">

                <h1>Blog</h1>
                <p>Latest posts</p>

                <ul class="posts-list">

                    <li v-for="post in posts" :key="post.id">
                        <a href="#">
                            <section class="card">
                                <img class="card-img-top" :src="post.image_src" :alt="post.title">
                                <div class="card-body">
                                    <h5 class="card-title">{{post.title}}</h5>
                                    <p class="card-text">{{post.body.substring(0,144)+"..."}}</p>
                                    <a href="#" class="btn btn-primary">Read More</a>
                                </div>
                            </section>
                        </a>
                    </li>

                </ul>

            </section>

            <section class="container project-intro">

                <h1>Projects</h1>
                <p>Some of my best work</p>

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

            <section class="container about-intro">

                <router-link class="nav-link" :to="{ name: 'contact'}" v-for="user in users" :key="user.id">
                    <section class="card">
                        <img class="card-img-top" :src="user.profile_pic_src" :alt="user.name">
                        <div class="card-body">
                            <h5 class="card-title">About Me</h5>
                            <p class="card-text">Tech enthusiast with a strong eye for visual design and a knack for problem solving. Interested in UI/UX and SPA/PWAs.</p>
                        </div>
                    </section>
                </router-link>

            </section>

        </main>

        <footer>
            <section class="container">
                <p>Louisville, KY 2017 - 2019</p>
            </section>
        </footer>

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
