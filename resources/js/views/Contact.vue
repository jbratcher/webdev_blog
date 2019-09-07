<template>
    <div class="main-container">

        <global-header />

        <main>

            <section id="contact" class="container contact-intro">

                <section class="card about" v-for="user in users" :key="user.id">
                    <img class="card-img-top" :src="user.profile_pic_src" :alt="user.name">
                    <div class="card-body">
                        <h5 class="card-title">About Me</h5>
                        <p class="card-text">Tech enthusiast with a strong eye for visual design and a knack for problem solving. Interested in UI/UX and SPA/PWAs.</p>
                    </div>
                </section>

                <section class="contact-form">
                    <h2>Let me help you with your next project.</h2>
                    <p>I am currently <span class="open">open to new prospects</span>.</p>
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" v-model="fields.name">
                            <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" v-model="fields.email">
                            <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                        </div>
                        <div class="form-group">
                            <label for="message">Your message</label>
                            <textarea class="form-control" id="message" name="message" rows="5"  v-model="fields.message"></textarea>
                            <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <div v-if="success" class="alert alert-success mt-3">
                            Message sent!
                        </div>
                    </form>
                </section>

            </section>

        </main>

        <global-footer />

    </div>
</template>

<script>
    export default {
        mounted() {
            this.getUsers();
            console.log("About page mounted");
        },
        data() {
            return {
                users: {},
                errors: {},
                fields: {},
                success: false,
                loaded: true,
            };
        },
        methods: {
            getUsers() {
                axios.get("/api/users").then(response => {
                    console.log(`Response: ${response.data}`);
                    this.users = response.data;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
                console.log("Users object: " + this.users);
            },
            submit() {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};  // Clear errors
                axios.post('/submit', this.fields).then(response => {
                    this.fields = {};  //Clear input fields.
                    this.loaded = true;
                    this.success = true;
                })
                .catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
    },
        }
    };
</script>
