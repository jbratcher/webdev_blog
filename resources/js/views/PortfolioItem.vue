<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <section class="portfolio-item">
            <section class="card">
                <div class="card-body">
                    <h2 class="card-title">{{portfolioItem[0].title}}</h2>
                    <img class="portfolio-item-img" :src="portfolioItem[0].image_src" :alt="portfolioItem[0].title">
                    <vue-markdown :source="portfolioItem[0].body"></vue-markdown>
                </div>
            </section>
        </section>

        <global-footer />

    </section>

</template>

<script>
    import { getPortfolioItemMixin } from "../mixins/getPortfolioItemMixin";
    export default {
        mixins: [ getPortfolioItemMixin ],
        mounted() {
            console.log("Portfolio item vue mounted");
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
