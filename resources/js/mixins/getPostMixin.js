export const getPostMixin = {
    created() {
        this.getPost();
        console.log("Route param id value: " + this.$route.params.post_id);
    },
    data() {
        return {
            post: [
                {
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
            posts: [
                {
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
        };
    },
    methods: {
        getPost() {
            axios.get("/api/posts").then(response => {
                this.posts = response.data;
                this.post = this.posts.filter(post => post.id = this.$route.params.post_id);
            })
            .then(() => console.log(JSON.stringify(this.post[0].title)))
            .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            });
        },
    },
}

