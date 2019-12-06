<template>

    <div class="main-container">

        <main>

            <div class="container-fluid global-banner">
                <h1>Dashboard</h1>
            </div>

            <!-- Blog Post Items -->

            <AdminResourceGroup :resources="this.posts" />

            <!-- Portfolio Items -->

            <AdminResourceGroup :resources="this.portfolioitems" />

            <!-- Tutorials -->

            <AdminResourceGroup :resources="this.tutorials" />

            <!-- Users -->

            <AdminResourceGroup :resources="this.users" />

        </main>

    </div>

</template>

<script>
    import AdminResourceGroup from '../components/admin/AdminResourceGroup.vue';
    import { getResourcesMixin } from '../mixins/getResourcesMixin.js';

    export default {
        components: {
            AdminResourceGroup,
        },
        mixins: [
            getResourcesMixin,
        ],
        created() {
            this.getResources('posts');
            this.getResources('portfolioitems');
            this.getResources('tutorials');
            this.getResources('users');
            console.log("Admin vue mounted");
        },
    };
</script>
