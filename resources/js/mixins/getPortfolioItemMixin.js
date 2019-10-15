export const getPortfolioItemMixin = {
    created() {
        this.getPortfolioItem();
        this.getUser();
    },
    computed: {
        publicationDate: function() {
            let date = new Date(this.portfolioItem[0].created_at);
            let month = date.toLocaleString('default', { month: 'long' });
            let string = `${month}, ${date.getDay()} ${date.getFullYear()}`;
            return string;
        }
    },
    data() {
        return {
            portfolioItem: [
                {
                    user_id: null,
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
            portfolioItems: [
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
        getPortfolioItem() {
            axios.get("/api/portfolioitems").then(response => {
                this.portfolioItems = response.data;
                this.portfolioItem = this.portfolioItems.filter(item => item.id === Number(this.$route.params.portfolio_item_id));
            })
            .then(() => console.log("Item title: " + JSON.stringify(this.portfolioItem[0].title)))
            .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            });
        },
        getUser() {
            axios.get("/api/users").then(response => {
                this.users = response.data;
                this.user = this.users.filter(user => user.user_id = this.portfolioItem[0].user_id)
            })
            .then(() => console.log("Username: " + JSON.stringify(this.user[0].name)))
            .catch(error => {
                this.error = error.response.data.message || error.message;
            });
        },
    },
}

