<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Tutorials</h1>
            <p class="lead">Learn something new</p>
        </div>

        <section class="container content-section">

            <ResourceList :resources="this.tutorials" />

        </section>

        <global-footer />

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
            this.getResources('tutorials');
            console.log("Tutorials mounted");
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
