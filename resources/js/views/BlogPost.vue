<template>

    <section>

        <global-header />

        <section class="blog-post">
            <section class="card">
                <div class="card-body">
                    <h2 class="card-title">{{post[0].title}}</h2>
                    <img class="blog-post-img" :src="post[0].image_src" :alt="post[0].title">
                    <vue-markdown :source="post[0].body"></vue-markdown>
                </div>
            </section>
        </section>

        <global-footer />

    </section>

</template>

<script>
    import { getPostMixin } from "../mixins/getPostMixin";
    export default {
        mixins: [getPostMixin],
        mounted() {
            console.log("Blog post vue mounted");
        },
         props: {
            userId: {
                type: Number
            },
            userName: {
                type: String
            },
        }
    };
</script>
