<template>

    <div class="main-container">

        <main>

            <section class="container content-section contact-intro" id="contact">

                <section class="card about" v-for="user in users" :key="user.id">
                    <img class="card-img-top" :src="user.profile_pic_src" :alt="user.name">
                    <div class="card-body">
                        <h2 class="card-title">About Me</h2>
                        <p class="card-text">Tech enthusiast with a strong eye for visual design and a knack for problem solving. Interested in UI/UX and SPA/PWAs.</p>
                    </div>
                </section>

                <ContactForm />

            </section>

        </main>

    </div>

</template>

<script>
    import ContactForm from '../components/ContactForm.vue';

    export default {
        components: {
            ContactForm,
        },
        created() {
            this.getUsers();
            console.log("Contact page mounted");
        },
        data() {
            return {
                users: {},
            };
        },
        methods: {
            getUsers() {
                axios.get("/api/users").then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    this.error = error.response.data.message || error.message;
                });
            },
        },
    };
</script>
