<template>

    <section>

        <global-header />

        <div class="jumbotron jumbotron-fluid global-banner">
            <h1 class="display-4">Portfolio</h1>
            <p class="lead">Here are my best and latest open-source projects.</p>
        </div>

        <ul class="container" id="portfolio-items">

            <li class="portfolio-items-card" v-for="portfolioitem in portfolioitems" :key="portfolioitem.id">
                <a href="#">
                    <section class="card">
                        <img class="card-img-top" :src="portfolioitem.image_src" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{portfolioitem.title}}</h5>
                            <p class="card-text">{{portfolioitem.body.substring(0,144)+"..."}}</p>
                            <a :href="portfolioitem.demo_url" class="btn btn-primary">Demo</a>
                            <a :href="portfolioitem.repo_url" class="btn btn-primary">Github Repo</a>
                        </div>
                    </section>
                </a>
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
                portfolioitems: {},
            };
        },
        methods: {
            getPortfolioItems() {
                axios.get("/api/portfolioitems").then(response => {
                    console.log(`Response: ${response.data}`);
                    this.portfolioitems = response.data;
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
