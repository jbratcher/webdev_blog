<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Web Development Blog</h1>
            <p class="lead">Read about my latest development experiences.</p>
        </div>

        <section class="container content-section">

            <BlogList :posts="this.posts" />

        </section>

        <global-footer />

    </section>

</template>

<script>
    import BlogList from './BlogList.vue';
    import { getResourcesMixin } from '../../mixins/getResourcesMixin.js';

    export default {
        components: {
            BlogList,
        },
        mixins: [ getResourcesMixin ],
        created() {
            this.getResources('posts');
            console.log("Blog vue mounted");
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
