<template>

    <div class="main-container">

        <global-header />

        <main>

            <div class="container-fluid global-banner">
                <h1>Dashboard</h1>
            </div>

            <section class="container resource-list">

                <h2>Blog Posts</h2>

                <ul>
                    <li v-for="post in posts" :key="post.id">
                        <h5>{{post.title.substring(0,80)}}</h5>
                        <section class="admin-actions">
                            <button class="btn btn-primary" type="button">Edit</button>
                            <button class="btn btn-primary" type="button" @click="deletePost(post.id)">Delete</button>
                        </section>
                    </li>
                </ul>

            </section>

            <section class="container resource-list">

                <h2>Portfolio Items</h2>

                <ul>

                    <li v-for="portfolioItem in portfolioItems" :key="portfolioItem.id">
                        <h5>{{portfolioItem.title.substring(0,80)}}</h5>
                        <section class="admin-actions">
                            <button class="btn btn-primary" type="button">Edit</button>
                            <button class="btn btn-primary" type="button" @click="deletePortfolioItems(portfolioItem.id)">Delete</button>
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
                axios.delete("/api/posts/" + id).then(response => this.getPosts())
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
            deletePortfolioItems(id) {
                axios.delete("/api/portfolioitems/" + id).then(response => this.getPortfolioItems())
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
        }
    };
</script>
