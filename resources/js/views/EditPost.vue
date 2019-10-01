<template>

    <section>

        <global-header />

        <section class="container">

            <h1 class="post-edit-header">Edit Post</h1>

            <form>

                <div :class="['form-group m-1 p-3', (successful ? 'alert-success' : '')]">
                    <span v-if="successful" class="label label-sucess">Published!</span>
                </div>
                <div :class="['form-group m-1 p-3', error ? 'alert-danger' : '']">
                    <span v-if="errors.title" class="label label-danger">
                    {{ errors.title[0] }}
                    </span>
                        <span v-if="errors.body" class="label label-danger">
                    {{ errors.body[0] }}
                    </span>
                        <span v-if="errors.image" class="label label-danger">
                    {{ errors.image[0] }}
                    </span>
                </div>

                <div class="form-group">
                    <input
                        type="title"
                        ref="title"
                        class="form-control"
                        id="title"
                        required
                        v-model="post.title"
                    >
                </div>

                <div class="form-group">
                    <markdown-editor
                        ref="body"
                        id="body"
                        :source="post.body"
                        toolbar="clipboard redo undo | bold italic strikethrough heading | image link | numlist bullist code quote | preview fullscreen"
                        v-model="editorValue"
                    ></markdown-editor>
                </div>

                <div class="custom-file mb-3">
                    <input type="file" ref="image" name="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" >Select image</label>
                </div>

                <button type="submit" @click.prevent="editPost" class="btn btn-primary block">
                    Submit
                </button>

            </form>

        </section>

        <global-footer />

    </section>

</template>

<script>

    export default {
        created() {
            console.log("Edit post vue mounted");
            this.getPost();
        },
        data() {
            return {
                editorValue: "",
                error: false,
                errors: [],
                post: {},
                posts: [],
                successful: false,
            };
        },
        methods: {
            editPost() {
                const formData = new FormData();
                formData.append("title", this.$refs.title.value);
                formData.append("body", this.$refs.body.value);
                formData.append("image", this.$refs.image.files[0]);
                formData.append("_method", "patch");  // need for method spoofing in Vue for PUT/PATCH

                console.log(this.$refs.title.value);
                console.log(this.$refs.body.value);

                console.log("Form data: " + formData);


                axios
                    .post(`/api/posts/${this.post.id}`, formData)
                    .then(response => {
                        this.successful = true;
                        this.error = false;
                        this.errors = [];
                    })
                    .catch(error => {
                        if (!_.isEmpty(error.response)) {
                            if ((error.response.status = 422)) {
                                this.errors = error.response.data.errors;
                                this.successful = false;
                                this.error = true;
                            }
                        }
                    });
            },
            getPost() {
                axios.get("/api/posts").then(response => {
                    this.posts = response.data;
                    this.post = this.posts[this.$route.params.post_id-1];
                })
                .then(() => console.log("Post: " + JSON.stringify(this.post)))
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
        },
        props: {
            userId: {
                type: Number
            },
            userName: {
                type: String
            },
            options: {
                lineNumbers: true,
                styleActiveLine: true,
                styleSelectedText: true,
                lineWrapping: true,
                indentWithTabs: true,
                tabSize: 2,
                indentUnit: 2
            },
        },
    };
</script>
