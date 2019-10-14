<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <section class="container">

            <h1 class="post-edit-header">Create a post</h1>

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
                        placeholder="Enter title"
                        required
                    >
                </div>

                <div class="form-group">
                    <markdown-editor
                        ref="body"
                        id="body"
                        toolbar="clipboard redo undo | bold italic strikethrough heading | image link | numlist bullist code quote | preview fullscreen"
                        v-model="editorValue"
                    ></markdown-editor>
                </div>

                <div class="custom-file mb-3">
                    <input type="file" ref="image" name="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" >Choose file...</label>
                </div>

                <button type="submit" @click.prevent="create" class="btn btn-primary block">
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
            console.log(`Create props:\n Username: ${this.userName}\n User ID: ${this.userId}`);
        },
        data() {
            return {
                editorValue: "",
                error: false,
                errors: [],
                successful: false,
            };
        },
        methods: {
            create() {
                const formData = new FormData();
                formData.append("title", this.$refs.title.value);
                formData.append("body", this.$refs.body.value);
                formData.append("user_id", this.userId);
                formData.append("image", this.$refs.image.files[0]);

                axios.post("/api/posts", formData)
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

                this.$refs.title.value = "";
                this.$refs.body.value = "";
            }
        },
        props: {
            userId: {
                type: Number
            },
            userName: {
                type: String
            },
        },
    };
</script>
