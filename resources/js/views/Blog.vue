<template>

    <section>

        <global-header />

        <div class="container-fluid global-banner">
            <h1 class="underline">Web Development Blog</h1>
            <p class="lead">Read about my latest development experiences.</p>
        </div>

        <ul class="container content-section" id="posts">

            <li class="post-card" v-for="post in posts" :key="post.id">
                <router-link :to="{ name: 'blog-post', params: { post_slug: post.slug, post_id: post.id} }">
                    <section class="card">
                        <img class="card-img-top" :src="post.image_src" :alt="post.title">
                        <div class="card-body">
                            <h5 class="card-title">{{post.title}}</h5>
                            <vue-markdown :source="post.body"></vue-markdown>
                            <router-link
                                class="btn btn-primary"
                                :to="{ name: 'blog-post', params: { post_slug: post.slug, post_id: post.id} }"
                            >
                                Read More
                            </router-link>
                        </div>
                    </section>
                </router-link>
            </li>

        </ul>

        <global-footer />

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
                posts: [],
            };
        },
        methods: {
            getPosts() {
                axios.get("/api/posts").then(response => {
                    this.posts = response.data;
                })
                .then(() => console.log("Posts array: " + JSON.stringify(this.posts)))
                .then(() => this.truncatePosts())
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            deletePost(id) {
                axios.delete("/api/posts/" + id).then(response => this.getPosts())
            },
            truncatePosts() {
                this.posts.map(post => {
                    post.body = post.body.substring(0,144)+"...";
                });
            }
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
