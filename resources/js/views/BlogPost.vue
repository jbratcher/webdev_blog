<template>

    <section>

        <global-header />

        <section class="blog-post">
            <section class="card">
                <img class="card-img-top" :src="post.image_src" :alt="post.title">
                <div class="card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text" v-html="post.body"></p>
                </div>
            </section>
        </section>

        <global-footer />

    </section>

</template>

<script>
    export default {
        mounted() {
            this.getPost();
            console.log("Blog post vue mounted");
            console.log("Blog param id value: " + this.$route.params.post_id);
        },
        data() {
            return {
                post: {},
                posts: [],
            };
        },
        methods: {
            getPost() {
                axios.get("/api/posts").then(response => {
                    this.posts = response.data;
                    this.post = this.posts[this.$route.params.post_id-1];
                })
                .then(() => console.log("Post: " + JSON.stringify(this.post)))
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
            },
        }
    };
</script>
