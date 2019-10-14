export const getPostMixin = {
    created() {
        this.getPost();
        this.getUser();
        console.log("Route param id value: " + this.$route.params.post_id);
    },
    computed: {
        publicationDate: function() {
            var date = new Date(this.post[0].created_at);
            var month = date.toLocaleString('default', { month: 'long' });
            var string = `${month}, ${date.getDay()} ${date.getFullYear()}`;
            return string;
        }
    },
    data() {
        return {
            post: [
                {
                    user_id: null,
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
            posts: [
                {
                    user_id: null,
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
            user: [
                {

                }
            ],
            users: [
                {

                }
            ]
        };
    },
    methods: {
        getPost() {
            axios.get("/api/posts").then(response => {
                this.posts = response.data;
                this.post = this.posts.filter(post => post.id = this.$route.params.post_id);
            })
            .then(() => console.log(JSON.stringify(this.post[0].user_id)))
            .catch(error => {
                this.error = error.response.data.message || error.message;
            });
        },
        getUser() {
            axios.get("/api/users").then(response => {
                this.users = response.data;
                this.user = this.users.filter(user => user.user_id = this.post[0].user_id)
            })
            .then(() => console.log(JSON.stringify(this.user[0].name)))
            .catch(error => {
                this.error = error.response.data.message || error.message;
            });
        },
    },
}

