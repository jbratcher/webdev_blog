<template>

    <section>

        <section class="container">

            <h1 class="post-edit-header">Edit Post</h1>

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
            this.getResource('posts');
            this.getUser();
            console.log("Edit post vue created");
        },
    };
</script>
