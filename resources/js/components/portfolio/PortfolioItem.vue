<template>

    <router-link :to="{ name: 'portfolio-single', params: { portfolio_item_slug: portfolioitem.slug, portfolio_item_id: portfolioitem.id} }">
        <img :src="portfolioitem.image_src" :alt="portfolioitem.title">
        <h5 class="card-title">{{portfolioitem.title}}</h5>
        <div class="card-body">
            <vue-markdown :source="portfolioitem.body"></vue-markdown>
            <div class="card-buttons">
                <router-link class="btn btn-primary" :to="{ name: 'portfolio-single', params: { portfolio_item_slug: portfolioitem.slug, portfolio_item_id: portfolioitem.id} }">Read More</router-link>
                <a :href="portfolioitem.demo_url" class="btn btn-primary">Demo</a>
                <a :href="portfolioitem.repo_url" class="btn btn-primary">Github Repo</a>
            </div>
        </div>
    </router-link>

</template>

<script>
export default {
  name: 'PortfolioItem',
  props: ['portfolioitem'],
};
</script>
