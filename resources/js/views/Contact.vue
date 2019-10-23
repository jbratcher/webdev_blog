<template>

    <div class="main-container">
        <main>

            <section class="container content-section contact-intro" id="contact">

                <UserAbout :users="this.users" />

                <ContactForm />

            </section>

        </main>
    </div>

</template>

<script>
    import ContactForm from '../components/ContactForm.vue';
    import UserAbout from '../components/UserAbout.vue';

    export default {
        components: {
            ContactForm,
            UserAbout,
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
