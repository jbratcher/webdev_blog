<template>
    <div class="main-container">

        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Jeremy Bratcher</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ml-auto" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tutorials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <main>

            <div class="jumbotron jumbotron-fluid background-image">
                <div class="container">
                    <h1 class="display-4">Full Stack Web Dev</h1>
                    <p class="lead">Having a hand in all things.</p>
                </div>
            </div>

            <section>
                Blog
            </section>

            <section>
                Bio
            </section>

            <section>
                Projects
            </section>

        </main>

        <footer>
            <section class="container">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <p>2019</p>
            </section>
        </footer>

    </div>
</template>

<script>
    export default {
        mounted() {
            // this.getPosts();
            console.log("Home vue mounted");
        },
        data() {
            return {
                posts: {},
            };
        },
        methods: {
            getPosts() {
                axios.get("/posts").then(response => {
                    this.posts = response.data;
                });
                console.log("Posts object: " + this.posts);
            },
            deletePost(id) {
                axios.delete("/posts/" + id).then(response => this.getPosts())
            },
        }
    };
</script>
