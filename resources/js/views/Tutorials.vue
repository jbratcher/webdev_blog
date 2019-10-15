<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Tutorials</h1>
            <p class="lead">Coming soon...</p>
        </div>

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
