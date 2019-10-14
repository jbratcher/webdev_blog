<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Web Development Blog</h1>
            <p class="lead">Read about my latest development experiences.</p>
        </div>

        <section class="container content-section">

            <ul class="posts-list" id="posts">

                <li class="post-card" v-for="post in posts" :key="post.id">
                    <router-link :to="{ name: 'blog-post', params: { post_slug: post.slug, post_id: post.id} }">
                        <img :src="post.image_src" :alt="post.title">
                        <h5 class="card-title">{{post.title}}</h5>
                        <div class="card-body">
                            <vue-markdown :source="post.body"></vue-markdown>
                            <div class="card-buttons">
                                <router-link
                                    class="btn btn-primary read-more"
                                    :to="{ name: 'blog-post', params: { post_slug: post.slug, post_id: post.id} }"
                                >
                                    Read More
                                </router-link>
                            </div>

                        </div>
                    </router-link>
                </li>

            </ul>

        </section>

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
