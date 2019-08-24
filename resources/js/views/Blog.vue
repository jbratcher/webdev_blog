<template>

    <section>

        <global-header />

        <section id="posts">

            <section class="card" v-for="post in posts" :key="post.id">

                <section class="card-body">
                    <h3 class="card-title">{{post.title}}</h3>
                    <p class="card-text">{{post.body}}</p>
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
        }
    };
</script>
