<template>

    <section>

        <global-header />

        <div class="jumbotron jumbotron-fluid background-image">
            <div class="container">
                <h1 class="display-4">Portfolio</h1>
                <p class="lead">Here are my best and latest open-source projects.</p>
            </div>
        </div>

        <div class="container" v-if="userId">
            <ul class="navbar-nav">
                <li class="nav-item menu-item">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link class="nav-link menu-link" :to="{ name: 'create' }">New Post</router-link>
                </li>
            </ul>
        </div>

        <ul class="container" id="posts">

            <li class="post-card">
                <a href="#">
                    <section class="card">
                        <img class="card-img-top" src="../../images/VoteInfoScreenshot.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">VoteInfo</h5>
                            <p class="card-text">https://github.com/jbratcher/VoteInfo</p>
                            <a href="https://jbratcher.github.io/VoteInfo/" class="btn btn-primary">Demo</a>
                            <a href="https://github.com/jbratcher/VoteInfo" class="btn btn-primary">Github Repo</a>
                        </div>
                    </section>
                </a>
            </li>

        </ul>

    </section>

</template>

<script>
    export default {
        mounted() {
            this.getPosts();
            console.log("Blog vue mounted");
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
                axios.delete("/api/posts/" + id).then(response => this.getPosts())
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
