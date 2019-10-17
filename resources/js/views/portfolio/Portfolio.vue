<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Portfolio</h1>
            <p class="lead">Here are my best and latest open-source projects.</p>
        </div>

        <section class="container content-section">

            <PortfolioList :portfolioitems="this.portfolioitems" />

        </section>

        <global-footer />

    </section>

</template>

<script>
    import PortfolioList from '../../components/portfolio/PortfolioList.vue';
    import { getResourcesMixin } from '../../mixins/getResourcesMixin.js';

    export default {
        components: {
            PortfolioList,
        },
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
