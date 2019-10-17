<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Tutorials</h1>
            <p class="lead">Learn something new</p>
        </div>

        <section class="container content-section">

            <ul class="posts-list" id="tutorial-items">

                <li class="tutorial-items-card" v-for="tutorial in tutorials" :key="tutorial.id">
                    <router-link :to="{ name: 'tutorial-single', params: { tutorial_slug: tutorial.slug, tutorial_id: tutorial.id} }">
                        <img :src="tutorial.image_src" :alt="tutorial.title">
                        <h5 class="card-title">{{tutorial.title}}</h5>
                        <div class="card-body">
                            <vue-markdown :source="tutorial.body"></vue-markdown>
                        </div>
                    </router-link>
                </li>

            </ul>

        </section>

        <global-footer />

    </section>

</template>

<script>
    import { getResourcesMixin } from "../../mixins/getResourcesMixin.js";
    export default {
        mixins: [ getResourcesMixin ],
        created() {
            this.getResources('tutorials');
            console.log("Tutorials mounted");
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
