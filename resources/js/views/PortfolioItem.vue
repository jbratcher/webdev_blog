<template>

    <section>

        <global-header />

        <section class="portfolio-item">
            <section class="card">
                <img class="card-img-top" :src="portfolioItem.image_src" :alt="portfolioItem.title">
                <div class="card-body">
                    <h5 class="card-title">{{portfolioItem.title}}</h5>
                    <p class="card-text">
                        <vue-markdown :source="portfolioItem.body"></vue-markdown>
                    </p>
                </div>
            </section>
        </section>

        <global-footer />

    </section>

</template>

<script>
    export default {
        mounted() {
            this.getPortfolioItems();
            console.log("Portfolio item vue mounted");
            console.log("Portfolio item param id value: " + this.$route.params.portfolio_item_id);
        },
        data() {
            return {
                portfolioItem: {},
                portfolioItems: [],
            };
        },
        methods: {
            getPortfolioItems() {
                axios.get("/api/portfolioitems").then(response => {
                    this.portfolioItems = response.data;
                    this.portfolioItem = this.portfolioItems[this.$route.params.portfolio_item_id-1];
                })
                .then(() => console.log("Portfolio Item: " + JSON.stringify(this.portfolioItem)))
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
