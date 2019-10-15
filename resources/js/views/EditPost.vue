<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

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
                        v-model="post[0].title"
                    >
                </div>

                <div class="form-group">
                    <markdown-editor
                        ref="body"
                        id="body"
                        toolbar="clipboard redo undo | bold italic strikethrough heading | image link | numlist bullist code quote | preview fullscreen"
                        v-model="post[0].body"
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
    import { getPostMixin } from "../mixins/getPostMixin";
    export default {
        mixins: [getPostMixin],
        created() {
            console.log("Edit post vue created");
        },
        updated() {
            this.updateEditorValue();
        },
        data() {
            return {
                editorValue: "",
                error: false,
                errors: [],
                options: {
                    lineNumbers: true,
                    styleActiveLine: true,
                    styleSelectedText: true,
                    lineWrapping: true,
                    indentWithTabs: true,
                    tabSize: 2,
                    indentUnit: 2
                },
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

                axios.post(`/api/posts/${this.post[0].id}`, formData)
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
            updateEditorValue() {
                this.editorValue = this.post.body;
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
