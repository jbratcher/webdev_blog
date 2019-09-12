<template>

    <section>

        <global-header />

        <div class="container-fluid global-banner">
            <h1 class="display-4">Tutorials</h1>
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
                    console.log(`Response: ${response.data}`);
                    this.tutorials = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
                console.log("Tutorials object: " + this.tutorials);
            },
        },
    };
</script>
