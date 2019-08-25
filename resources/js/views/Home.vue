<template>
    <div class="main-container">

        <global-header />

        <main>

            <div class="jumbotron jumbotron-fluid background-image">
                <div class="container">
                    <h1 class="display-4">Full Stack Web Dev</h1>
                    <p class="lead">Creating software, creating change.</p>
                </div>
            </div>

            <section class="container">

                <h1 class="display-">Blog</h1>
                <p>Latest posts</p>

                <ul class="posts-list">

                    <li v-for="post in posts" :key="post.id">
                        <a href="#">
                            <section class="card">
                                <img class="card-img-top" src="https://via.placeholder.com/350x150" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{post.title}}</h5>
                                    <p class="card-text">{{post.body.substring(0,144)+"..."}}</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </section>
                        </a>
                    </li>

                </ul>

            </section>

            <section class="container">
                <h1 class="display-">Projects</h1>
                <p>Some of my best work</p>
                <ul class="posts-list">
                    <li>
                        <a href="#">
                            <section class="card">
                                <img class="card-img-top" src="https://via.placeholder.com/350x150" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </section>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <section class="card">
                                <img class="card-img-top" src="https://via.placeholder.com/350x150" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </section>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <section class="card">
                                <img class="card-img-top" src="https://via.placeholder.com/350x150" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </section>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <section class="card">
                                <img class="card-img-top" src="https://via.placeholder.com/350x150" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </section>
                        </a>
                    </li>
                </ul>
            </section>

            <section class="container">
                <h1 class="display-4">About Me</h1>
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
            console.log("Home vue mounted");
        },
        data() {
            return {
                posts: {},
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
        }
    };
</script>
