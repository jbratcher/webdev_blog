<template>

    <section>

        <div class="container-fluid global-banner">
            <h1>Portfolio</h1>
            <p class="lead">Here are my best and latest open-source projects.</p>
        </div>

        <section class="container content-section">

            <ResourceList :resources="this.portfolioitems" />

        </section>

    </section>

</template>

<script>
    import ResourceList from '../../components/resource/ResourceList.vue';
    import { getResourcesMixin } from '../../mixins/getResourcesMixin.js';

    export default {
        components: {
            ResourceList,
        },
        mixins: [ getResourcesMixin ],
        created() {
            this.getResources('portfolioitems');
            console.log("Portfolio mounted");
        },
    };
</script>
