<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <section class="portfolio-item">
            <section class="card">
                <div class="card-body">
                    <h2 class="card-title">{{resource[0].title}}</h2>
                    <img class="portfolio-item-img" :src="resource[0].image_src" :alt="resource[0].title">
                    <vue-markdown :source="resource[0].body"></vue-markdown>
                </div>
            </section>
        </section>

        <global-footer />

    </section>

</template>

<script>
    import { getResourceMixin } from "../mixins/getResourceMixin";
    export default {
        mixins: [ getResourceMixin ],
        created() {
            this.getResource('portfolioitems');
            this.getUser();
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
