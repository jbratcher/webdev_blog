<template>

    <section>

        <global-header />

        <div class="container-fluid global-banner">
            <h1 class="underline">Portfolio</h1>
            <p class="lead">Here are my best and latest open-source projects.</p>
        </div>

        <ul class="container content-section" id="portfolio-items">

            <li class="portfolio-items-card" v-for="portfolioItem in portfolioItems" :key="portfolioItem.id">
                <router-link :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioItem.slug, portfolio_item_id: portfolioItem.id} }">
                    <section class="card">
                        <img class="card-img-top" :src="portfolioItem.image_src" :alt="portfolioItem.title">
                        <div class="card-body">
                            <h5 class="card-title">{{portfolioItem.title}}</h5>
                            <p class="card-text">{{portfolioItem.body.substring(0,144)+"..."}}</p>
                            <router-link class="btn btn-primary" :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioItem.slug, portfolio_item_id: portfolioItem.id} }">Read More</router-link>
                            <a :href="portfolioItem.demo_url" class="btn btn-primary">Demo</a>
                            <a :href="portfolioItem.repo_url" class="btn btn-primary">Github Repo</a>
                        </div>
                    </section>
                </router-link>
            </li>

        </ul>

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
                    console.log(`Response: ${response.data}`);
                    this.portfolioItems = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
                console.log("Portfolio object: " + this.portfolioitems);
            },
            deletePost(id) {
                axios.delete("/api/portfolioitems/" + id).then(response => this.getPortfolioItems())
            },
        },
    };
</script>
