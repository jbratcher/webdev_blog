<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Portfolio</h1>
            <p class="lead">Here are my best and latest open-source projects.</p>
        </div>

        <section class="container content-section">

            <ul class="posts-list" id="portfolio-items">

                <li class="portfolio-items-card" v-for="portfolioItem in portfolioItems" :key="portfolioItem.id">
                    <router-link :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioItem.slug, portfolio_item_id: portfolioItem.id} }">
                        <img :src="portfolioItem.image_src" :alt="portfolioItem.title">
                        <h5 class="card-title">{{portfolioItem.title}}</h5>
                        <div class="card-body">
                            <vue-markdown :source="portfolioItem.body"></vue-markdown>
                            <div class="card-buttons">
                                <router-link class="btn btn-primary" :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioItem.slug, portfolio_item_id: portfolioItem.id} }">Read More</router-link>
                                <a :href="portfolioItem.demo_url" class="btn btn-primary">Demo</a>
                                <a :href="portfolioItem.repo_url" class="btn btn-primary">Github Repo</a>
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
            this.getPortfolioItems();
            console.log("Portfolio mounted");
        },
        data() {
            return {
                portfolioItems: {},
            };
        },
        methods: {
            getPortfolioItems() {
                axios.get("/api/portfolioitems").then(response => {
                    this.portfolioItems = response.data;
                })
                .then(() => this.truncatePortfolioItem())
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            truncatePortfolioItem() {
                this.portfolioItems.map(portfolioItem => {
                    portfolioItem.body = portfolioItem.body.substring(0,144)+"...";
                });
            }
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
