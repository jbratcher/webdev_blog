<template>

    <section>

        <global-header />

        <section class="portfolio-item">
            <section class="card">
                <div class="card-body">
                    <h2 class="card-title">{{portfolioItem.title}}</h2>
                    <img class="portfolio-item-img" :src="portfolioItem.image_src" :alt="portfolioItem.title">
                    <vue-markdown :source="portfolioItem.body"></vue-markdown>
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
                .then(() => console.log(JSON.stringify(this.portfolioItem[0].title)))
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
