<template>
    <div class="main-container" v-if="userId">

        <global-header />

        <main>

            <div class="container-fluid global-banner">
                <h1>Dashboard</h1>
            </div>

            <!-- Blog Post Items -->

            <section class="container resource-list">

                <h2>Blog Posts</h2>

                <div class="container admin-menu">
                    <i class="fas fa-plus-circle fa-2x"></i>
                    <router-link :to="{ name: 'create' }">New Post</router-link>
                </div>

                <ul>
                    <li v-for="post in posts" :key="post.id">
                        <h5>{{post.title.substring(0,80)}}</h5>
                        <section class="admin-actions">
                            <router-link
                                class="btn btn-primary"
                                :to="{ name: 'edit-post', params: { post_slug: post.slug, post_id: post.id} }"
                            >
                                Edit
                            </router-link>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#confirmDeletePostModal">Delete</button>

                            <!-- Confirm Delete Post Modal -->
                            <div class="modal" id="confirmDeletePostModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete blog post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this post?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" @click="deletePost(post.id)">Confirm Deletion</button>
                                    </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </li>
                </ul>

            </section>

            <!-- Portfolio Items -->

            <section class="container resource-list">

                <h2>Portfolio Items</h2>

                <ul>

                    <li v-for="portfolioItem in portfolioItems" :key="portfolioItem.id">
                        <h5>{{portfolioItem.title.substring(0,80)}}</h5>
                        <section class="admin-actions">
                            <router-link
                                class="btn btn-primary"
                                :to="{ name: 'edit-portfolio-item', params: { portfolio_item_slug: portfolioItem.slug, portfolio_item_id: portfolioItem.id} }"
                            >
                                Edit
                            </router-link>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#confirmDeletePortfolioItemModal">Delete</button>

                            <!-- Confirm Delete Portfolio Item Modal -->
                            <div class="modal" id="confirmDeletePortfolioItemModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete portfolio item</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this portfolio item?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" @click="deletePortfolioItem(portfolioItem.id)">Confirm Deletion</button>
                                    </div>
                                    </div>
                                </div>
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
    export default {
        mounted() {
            this.getPosts();
            this.getPortfolioItems();
            this.getUsers();
            console.log("Admin vue mounted");
        },
        data() {
            return {
                posts: {},
                portfolioItems: {},
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
                    this.portfolioItems = response.data;
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
