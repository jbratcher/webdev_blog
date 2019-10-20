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

                <AdminResourceList :resources="this.posts" @delete-resource="deletePost" />

            </section>

            <!-- Portfolio Items -->

            <section class="container resource-list">

                <h2>Portfolio Items</h2>

                <div class="container admin-menu">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link :to="{ name: 'create-portfolio-item' }">New Portfolio Item</router-link>
                </div>

                <AdminResourceList :resources="this.portfolioitems" @delete-resource="deletePortfolioItem" />

            </section>

            <!-- Tutorials -->

            <section class="container resource-list">

                <h2>Tutorials</h2>

                <div class="container admin-menu">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link :to="{ name: 'create-tutorial-item' }">New Tutorial</router-link>
                </div>

                <AdminResourceList :resources="this.tutorials" @delete-resource="deleteTutorial" />

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

    export default {
        components: {
            AdminResourceList,
            DeleteModal,
        },
        mixins: [ getResourcesMixin ],
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
            deletePost(id) {
                axios.delete("/api/posts/" + id)
                    .then(response => this.getResources('posts'))
                    $('.modal-backdrop').remove();
            },
            deletePortfolioItem(id) {
                axios.delete("/api/portfolioitems/" + id)
                    .then(response => this.getResources('portfolioitems'));
                $('.modal-backdrop').remove();
            },
            deleteTutorial(id) {
                axios.delete("/api/tutorials/" + id)
                    .then(response => this.getResources('tutorials'));
                $('.modal-backdrop').remove();
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
