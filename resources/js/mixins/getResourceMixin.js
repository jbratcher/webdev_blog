export const getResourceMixin = {
    created() {
        console.log("get resource mixin created");
    },
    computed: {
        publicationDate: function() {
            let date = new Date(this.resource[0].created_at);
            let month = date.toLocaleString('default', { month: 'long' });
            let string = `${month}, ${date.getDay()} ${date.getFullYear()}`;
            return string;
        }
    },
    data() {
        return {
            resource: [
                {
                    user_id: null,
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
            resources: [
                {
                    user_id: null,
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
            user: [
                {
                    img_src: null,
                    name: ""
                }
            ],
            users: [
                {
                    img_src: null,
                    name: ""
                }
            ]
        };
    },
    methods: {
        getResource(type) {
            axios.get(`/api/${type}`).then(response => {
                this.resources = response.data;
                this.resource = this.resources.filter(item => {
                    return item.id === Number(this.$route.params.id)
                })
            })
            .then(() => console.log("Item title: " + JSON.stringify(this.resource[0].title)))
            .catch(error => {
                this.error = error.response.data.message || error.message;
                console.log(`Error in getResource: ${this.error}`);
            });
        },
        getUser() {
            axios.get("/api/users").then(response => {
                this.users = response.data;
                this.user = this.users.filter(user => user.id === this.resource[0].user_id)
            })
            .then(() => console.log("Username: " + JSON.stringify(this.user[0].name)))
            .catch(error => {
                this.error = error.response.data.message || error.message;
                console.log(`Error in getUser: ${this.error}`);
            });
        },
    },
}

