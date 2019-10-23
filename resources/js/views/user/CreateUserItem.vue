<template>

    <section>

        <section class="container">

            <h1 class="post-edit-header">Create a user</h1>

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
                        type="name"
                        ref="name"
                        class="form-control"
                        id="name"
                        placeholder="Enter name"
                        required
                    >
                </div>

                <div class="form-group">
                    <input
                        type="email"
                        ref="email"
                        class="form-control"
                        id="email"
                        placeholder="Enter email"
                        required
                    >
                </div>

                <div class="form-group">
                    <input
                        type="intro"
                        ref="intro"
                        class="form-control"
                        id="intro"
                        placeholder="Enter intro"
                        required
                    >
                </div>

                <div class="form-group">
                    <input
                        type="bio"
                        ref="bio"
                        class="form-control"
                        id="bio"
                        placeholder="Enter bio"
                        required
                    >
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
                formData.append("name", this.$refs.name.value);
                formData.append("email", this.$refs.email.value);
                formData.append("intro", this.$refs.intro.value);
                formData.append("bio", this.$refs.bio.value);
                formData.append("image", this.$refs.image.files[0]);

                axios.post("/api/users", formData)
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

                this.$refs.name.value = "";
                this.$refs.email.value = "";
                this.$refs.intro.value = "";
                this.$refs.bio.value = "";
            }
        },
    };
</script>
