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

                <ul>
                    <li v-for="post in posts" :key="post.id">
                        <h5>{{post.title.substring(0,80)}}</h5>
                        <section class="admin-actions">
                            <router-link
                                class="btn btn-primary"
                                :to="{ name: 'edit-blog-item', params: { post_slug: post.slug, post_id: post.id} }"
                            >
                                Edit
                            </router-link>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#confirmDeletePostModal">Delete</button>

                                <div class="modal" id="confirmDeletePostModal" tabindex="-1" role="dialog">
                                    <DeleteModal :resource="post" @delete-resource="deletePost" />
                                </div>

                        </section>
                    </li>
                </ul>

            </section>

            <!-- Portfolio Items -->

            <section class="container resource-list">

                <h2>Portfolio Items</h2>

                <div class="container admin-menu">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link :to="{ name: 'create-portfolio-item' }">New Portfolio Item</router-link>
                </div>

                <ul>

                    <li v-for="portfolioitem in portfolioitems" :key="portfolioitem.id">
                        <h5>{{portfolioitem.title.substring(0,80)}}</h5>
                        <section class="admin-actions">
                            <router-link
                                class="btn btn-primary"
                                :to="{ name: 'edit-portfolio-item', params: { portfolio_item_slug: portfolioitem.slug, portfolio_item_id: portfolioitem.id} }"
                            >
                                Edit
                            </router-link>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#confirmDeletePortfolioItemModal">Delete</button>

                            <div class="modal" id="confirmDeletePortfolioItemModal" tabindex="-1" role="dialog">
                                <DeleteModal :resource="portfolioitem" @delete-resource="deletePortfolioItem" />
                            </div>

                        </section>
                    </li>

                </ul>

            </section>

            <!-- Tutorials -->

            <section class="container resource-list">

                <h2>Tutorials</h2>

                <div class="container admin-menu">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link :to="{ name: 'create-tutorial-item' }">New Tutorial</router-link>
                </div>

                <ul>

                    <li v-for="tutorial in tutorials" :key="tutorial.id">
                        <h5>{{tutorial.title.substring(0,80)}}</h5>
                        <section class="admin-actions">
                            <router-link
                                class="btn btn-primary"
                                :to="{ name: 'edit-tutorial-item', params: { tutorial_slug: tutorial.slug, tutorial_id: tutorial.id} }"
                            >
                                Edit
                            </router-link>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#confirmDeleteTutorialModal">Delete</button>

                            <div class="modal" id="confirmDeleteTutorialModal" tabindex="-1" role="dialog">
                                <DeleteModal :resource="tutorial" @delete-resource="deleteTutorial" />
                            </div>

                        </section>
                    </li>

                </ul>

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
    import DeleteModal from '../components/admin/DeleteModal.vue';

    export default {
        components: {
            DeleteModal,
        },
        mounted() {
            this.getPosts();
            this.getPortfolioItems();
            this.getTutorials();
            this.getUsers();
            console.log("Admin vue mounted");
        },
        data() {
            return {
                posts: {},
                portfolioitems: {},
                tutorials: {},
                users: {},
            };
        },
        methods: {
            getPosts() {
                axios.get("/api/posts").then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            deletePost(id) {
                axios.delete("/api/posts/" + id)
                    .then(response => this.getPosts())
                    $('.modal-backdrop').remove();
            },
            getPortfolioItems() {
                axios.get("/api/portfolioitems").then(response => {
                    this.portfolioitems = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            deletePortfolioItem(id) {
                axios.delete("/api/portfolioitems/" + id)
                    .then(response => this.getPortfolioItems());
                $('.modal-backdrop').remove();
            },
            getTutorials() {
                axios.get("/api/tutorials").then(response => {
                    this.tutorials = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            deleteTutorial(id) {
                axios.delete("/api/tutorials/" + id)
                    .then(response => this.getTutorials());
                $('.modal-backdrop').remove();
            },
            getUsers() {
                axios.get("/api/users").then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
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
