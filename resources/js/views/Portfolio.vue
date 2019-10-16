<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Portfolio</h1>
            <p class="lead">Here are my best and latest open-source projects.</p>
        </div>

        <section class="container content-section">

            <ul class="posts-list" id="portfolio-items">

                <li class="portfolio-items-card" v-for="portfolioitem in portfolioitems" :key="portfolioitem.id">
                    <router-link :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioitem.slug, portfolio_item_id: portfolioitem.id} }">
                        <img :src="portfolioitem.image_src" :alt="portfolioitem.title">
                        <h5 class="card-title">{{portfolioitem.title}}</h5>
                        <div class="card-body">
                            <vue-markdown :source="portfolioitem.body"></vue-markdown>
                            <div class="card-buttons">
                                <router-link class="btn btn-primary" :to="{ name: 'portfolio-item', params: { portfolio_item_slug: portfolioitem.slug, portfolio_item_id: portfolioitem.id} }">Read More</router-link>
                                <a :href="portfolioitem.demo_url" class="btn btn-primary">Demo</a>
                                <a :href="portfolioitem.repo_url" class="btn btn-primary">Github Repo</a>
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
    import { getResourcesMixin } from "../mixins/getResourcesMixin.js";
    export default {
        mixins: [ getResourcesMixin ],
        created() {
            this.getResources('portfolioitems');
            console.log("Portfolio mounted");
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
