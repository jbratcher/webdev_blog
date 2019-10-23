<template>

    <div class="main-container">

        <main>

            <div class="container-fluid global-banner">
                <h1>Dashboard</h1>
            </div>

            <!-- Blog Post Items -->

            <AdminResourceGroup :resources="this.posts" @delete-resource="deleteResource" />

            <!-- Portfolio Items -->

            <AdminResourceGroup :resources="this.portfolioitems" @delete-resource="deleteResource" />

            <!-- Tutorials -->

            <AdminResourceGroup :resources="this.tutorials" @delete-resource="deleteResource" />

            <!-- Users -->

            <AdminResourceGroup :resources="this.users" @delete-resource="deleteResource" />

        </main>

    </div>

</template>

<script>
    import AdminResourceGroup from '../components/admin/AdminResourceGroup.vue';
    import { getResourcesMixin } from '../mixins/getResourcesMixin.js';
    import { deleteResourceMixin } from '../mixins/deleteResourceMixin.js';

    export default {
        components: {
            AdminResourceGroup,
        },
        mixins: [
            getResourcesMixin,
            deleteResourceMixin,
        ],
        created() {
            this.getResources('posts');
            this.getResources('portfolioitems');
            this.getResources('tutorials');
            this.getResources('users');
            console.log("Admin vue mounted");
        },
        methods: {
            deleteModalDataTarget(data) {
                const dataTargetValue = `#confirmDelete${data.type}${data.id}Modal`;
                return dataTargetValue;
            },
        },
    };
</script>
