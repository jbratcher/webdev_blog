<template>
    <div class="main-container" v-if="userId">

        <global-header :userName="userName" :userId="userId" />

        <main>

            <div class="container-fluid global-banner">
                <h1>Dashboard</h1>
            </div>

            <!-- Blog Post Items -->

            <section class="container resource-list">

                <h2>Blog Posts</h2>

                <div class="container admin-menu">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link :to="{ name: 'create-blog-post' }">New Post</router-link>
                </div>

                <AdminResourceList :resources="this.posts" @delete-resource="deleteResource" />

            </section>

            <!-- Portfolio Items -->

            <section class="container resource-list">

                <h2>Portfolio Items</h2>

                <div class="container admin-menu">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link :to="{ name: 'create-portfolio-item' }">New Portfolio Item</router-link>
                </div>

                <AdminResourceList :resources="this.portfolioitems" @delete-resource="deleteResource" />

            </section>

            <!-- Tutorials -->

            <section class="container resource-list">

                <h2>Tutorials</h2>

                <div class="container admin-menu">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link :to="{ name: 'create-tutorial-item' }">New Tutorial</router-link>
                </div>

                <AdminResourceList :resources="this.tutorials" @delete-resource="deleteResource" />

            </section>

            <section class="container resource-list">

                <h2>Users</h2>

                <ul>
                    <li v-for="user in users" :key="user.id">
                        <section class="admin-user-group">
                            <h5>{{user.name}}</h5>
                            <img class="img-fluid" :src="user.profile_pic_src" :alt="user.name">
                        </section>
                        <section class="admin-actions">
                            <button class="btn btn-primary" type="button">Edit</button>
                            <button class="btn btn-primary" type="button">Delete</button>
                        </section>
                    </li>
                </ul>

            </section>

        </main>

        <global-footer />

    </div>
</template>

<script>
    import AdminResourceList from '../components/admin/AdminResourceList';
    import DeleteModal from '../components/admin/DeleteModal.vue';
    import { getResourcesMixin } from '../mixins/getResourcesMixin.js';
    import { deleteResourceMixin } from '../mixins/deleteResourceMixin.js';

    export default {
        components: {
            AdminResourceList,
            DeleteModal,
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
        props: {
            userId: {
                type: Number
            },
            userName: {
                type: String
            }
        }
    };
</script>
