<template>
    <div class="main-container">

        <global-header />

        <main>

            <section id="contact" class="container contact-intro">

                <a href="#" v-for="user in users" :key="user.id">
                    <section class="card">
                        <img class="card-img-top" :src="user.profile_pic_src" :alt="user.name">
                        <div class="card-body">
                            <h5 class="card-title">About Me</h5>
                            <p class="card-text">Tech enthusiast with a strong eye for visual design and a knack for problem solving. Interested in UI/UX and SPA/PWAs.</p>
                        </div>
                    </section>
                </a>

                <form>
                    <div class="form-group">
                        <label for="nameInput">Your Name</label>
                        <input type="text" class="form-control" id="nameInput">
                   </div>
                    <div class="form-group">
                        <label for="emailInput">Your Email</label>
                        <input type="email" class="form-control" id="emailInput">
                    </div>
                    <div class="form-group">
                        <label for="messageInput">Your message</label>
                        <textarea class="form-control" id="messageInput" name="messageInput" rows="5" columns="50"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </section>

        </main>

        <footer>
            <section class="container">
                <p>Louisville, KY 2017 - 2019</p>
            </section>
        </footer>

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
        }
    };
</script>
