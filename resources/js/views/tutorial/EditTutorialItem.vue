<template>

    <section>

        <section class="container">

            <h1 class="post-edit-header">Edit Tutorial</h1>

            <EditResourceForm :resource="this.resource" :user="this.user" />

        </section>

    </section>

</template>

<script>
    import EditResourceForm from "../../components/resource/EditResourceForm.vue";
    import { getResourceMixin } from "../../mixins/getResourceMixin";

    export default {
        components: {
            EditResourceForm,
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
