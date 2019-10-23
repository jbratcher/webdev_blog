<template>

    <section>

        <section class="container">

            <h1 class="post-edit-header">Edit User</h1>

            <EditResourceForm :resource="this.resource" />

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
            this.getResource('user');
            console.log("Edit tutorial vue mounted");
        },
    };
</script>
