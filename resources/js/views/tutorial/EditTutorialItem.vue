<template>

    <section>

        <section class="container">

            <h1 class="post-edit-header">Edit Tutorial</h1>

            <ResourceForm :resource="this.resource" :user="this.user" />

        </section>

    </section>

</template>

<script>
    import ResourceForm from "../../components/resource/ResourceForm.vue";
    import { getResourceMixin } from "../../mixins/getResourceMixin";

    export default {
        components: {
            ResourceForm,
        },
        mixins: [
            getResourceMixin,
        ],
        created() {
            this.getResource('tutorials');
            this.getUser();
            console.log("Edit tutorial vue mounted");
        },
    };
</script>
