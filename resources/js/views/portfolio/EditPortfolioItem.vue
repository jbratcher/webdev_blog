<template>

    <section>

        <section class="container">

            <h1 class="post-edit-header">Edit Portfolio Item</h1>

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
            this.getResource('portfolioitems');
            this.getUser();
            console.log("Edit portfolio item vue mounted");
        },
    };
</script>
