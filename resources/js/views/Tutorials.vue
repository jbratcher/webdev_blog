<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Tutorials</h1>
            <p class="lead">Coming soon...</p>
        </div>

        <section class="container content-section">

            <ul class="posts-list" id="tutorial-items">

                <li class="tutorial-items-card" v-for="tutorial in tutorials" :key="tutorial.id">
                    <router-link :to="{ name: 'tutorial', params: { tutorial_slug: tutorial.slug, tutorial_id: tutorial.id} }">
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
    export default {
        mounted() {
            this.getTutorials();
            console.log("Tutorials mounted");
        },
        data() {
            return {
                tutorials: {},
            };
        },
        methods: {
            getTutorials() {
                axios.get("/api/tutorials").then(response => {
                    this.tutorials = response.data;
                })
                .then(() => this.truncateTutorials())
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            truncateTutorials() {
                this.tutorials.map(tutorial => {
                    tutorial.body = tutorial.body.substring(0,144)+"...";
                });
            }
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
