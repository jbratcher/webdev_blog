<template>
    <div class="main-container">

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

            <!-- About -->

            <section class="container-fluid content-section about-intro">

                <router-link class="nav-link" :to="{ name: 'contact'}" v-for="user in users" :key="user.id">
                    <section class="card">
                        <img class="card-img-top" :src="user.profile_pic_src" :alt="user.name">
                        <div class="card-body">
                            <h2 class="card-title"> {{ user.intro }} </h2>
                            <p class="card-text"> {{ user.bio }} </p>
                        </div>
                    </section>
                </router-link>

            </section>

        </main>

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
            this.getResources('users');
            console.log("Home vue mounted");
        },
    };
</script>
