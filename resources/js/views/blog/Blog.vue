<template>

    <section>

        <div class="container-fluid global-banner">
            <h1>Web Development Blog</h1>
            <p class="lead">Read about my latest development experiences.</p>
        </div>

        <section class="container content-section">

            <ResourceList :resources="this.posts" />

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
            this.getResources('posts');
            console.log("Blog vue mounted");
        },
    };
</script>
