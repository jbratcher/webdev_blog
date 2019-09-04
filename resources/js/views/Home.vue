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

                <h1>About Me</h1>
                <p>Tech enthusiast with a strong eye for visual design and a knack for problem solving. Interested in UI/UX and SPA/PWAs.</p>

            </section>

        </main>

        <footer>
            <section class="container">
                <ul class="nav flex-row">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
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
            console.log("Home vue mounted");
        },
        data() {
            return {
                posts: {},
                portfolioitems: {},
            };
        },
        methods: {
            getPosts() {
                axios.get("/api/posts").then(response => {
                    console.log(`Response: ${response.data}`);
                    this.posts = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
                console.log("Posts object: " + this.posts);
            },
            deletePost(id) {
                axios.delete("/posts/" + id).then(response => this.getPosts())
            },
            getPortfolioItems() {
                axios.get("/api/portfolioitems").then(response => {
                    console.log(`Response: ${response.data}`);
                    this.portfolioitems = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
                console.log("Portfolio object: " + this.portfolioitems);
            },
            deletePost(id) {
                axios.delete("/api/portfolioitems/" + id).then(response => this.getPortfolioItems())
            },
        }
    };
</script>
