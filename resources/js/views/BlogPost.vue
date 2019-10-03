<template>

    <section>

        <global-header />

        <section class="blog-post">
            <section class="card">
                <img class="blog-post-img" :src="post[0].image_src" :alt="post[0].title">
                <div class="card-body">
                    <h5 class="card-title">{{post[0].title}}</h5>
                    <vue-markdown :source="post[0].body"></vue-markdown>
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
                post: [],
                posts: [],
            };
        },
        methods: {
            getPost() {
                axios.get("/api/posts").then(response => {
                    this.posts = response.data;
                    this.post = this.posts.filter(post => post.id === this.$route.params.post_id);
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
