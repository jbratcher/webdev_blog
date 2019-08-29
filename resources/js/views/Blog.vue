<template>

    <section>

        <global-header />

        <div class="jumbotron jumbotron-fluid background-image">
            <div class="container">
                <h1 class="display-4">Web Development Blog</h1>
                <p class="lead">Read about my latest development experiences.</p>
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

        <section id="posts">

            <section class="card post-card" v-for="post in posts" :key="post.id">

                <section class="card-header">
                    <h3 class="card-title">{{ post.title }}</h3>
                </section>

                <section class="card-body">
                    <p class="card-text">{{ post.body }}</p>
                </section>

            </section>

        </section>

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
