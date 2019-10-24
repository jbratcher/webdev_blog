<template>
    <div class="main-container">

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

            <UserAbout :users="this.users" />

        </section>

    </div>
</template>

<script>
    import ResourceList from '../components/resource/ResourceList.vue';
    import UserAbout from '../components/UserAbout.vue';
    import { getResourcesMixin } from '../mixins/getResourcesMixin.js';

    export default {
        components: {
            ResourceList,
            UserAbout,
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
