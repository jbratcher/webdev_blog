<template>
    <div class="main-container">

        <global-header :userName="userName" :userId="userId" />

        <main>

            <div class="container-fluid global-banner">
                <h1>Jeremy Bratcher</h1>
                <p class="lead">Full Stack Web Developer</p>
            </div>

            <!-- Blog  -->

            <section class="container content-section">

                <h2 class="underline">Blog</h2>

                <p class="lead">Latest posts</p>

                <ResourceList :resources="this.posts" />

            </section>

            <!-- Portfolio  -->

            <section class="container content-section">

                <h2 class="underline">Portfolio</h2>

                <p class="lead">Some of my best work</p>

                <ResourceList :resources="this.portfolioitems" />

            </section>

            <!-- Tutorials  -->

            <section class="container content-section">

                <h2 class="underline">Tutorials</h2>

                <p class="lead">Learn something new</p>

                <ResourceList :resources="this.tutorials" />

            </section>

            <section class="container-fluid content-section about-intro">

                <router-link class="nav-link" :to="{ name: 'contact'}" v-for="user in users" :key="user.id">
                    <section class="card">
                        <img class="card-img-top" :src="user.profile_pic_src" :alt="user.name">
                        <div class="card-body">
                            <h2 class="card-title">About Me</h2>
                            <p class="card-text">Tech enthusiast with a strong eye for visual design and a knack for problem solving. Interested in UI/UX and SPA/PWAs.</p>
                        </div>
                    </section>
                </router-link>

            </section>

        </main>

        <global-footer />

    </div>
</template>

<script>
    import ResourceList from '../components/resource/ResourceList.vue';
    import { getResourcesMixin } from '../mixins/getResourcesMixin.js';

    export default {
        components: {
            ResourceList,
        },
        mixins: [ getResourcesMixin ],
        created() {
            this.getResources('posts');
            this.getResources('portfolioitems');
            this.getResources('tutorials');
            this.getUsers();
            console.log("Home vue mounted");
        },
        data() {
            return {
                users: [],
            };
        },
        methods: {
            getUsers() {
                axios.get("/api/users").then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    this.error = error.response.data.message || error.message;
                    console.log(`Error in getUsers: ${this.error}`);
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
