export const editResourceMixin = {
    created() {
        console.log("edit resource mixin created");
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
        editResource(type, id) {
            const formData = new FormData();

            formData.append("title", this.$refs.title.value);
            formData.append("body", this.$refs.body.value);
            formData.append("image", this.$refs.image.files[0]);
            if(this.$refs.demo_url) {
                formData.append("demo_url", this.$refs.demo_url);
            }
            if(this.$refs.repo_url) {
                formData.append("repo_url", this.$refs.repo_url);
            }
            formData.append("_method", "patch");  // need for method spoofing in Vue for PUT/PATCH

            axios.post(`/api/${this.resource[0].api_route}/${this.resource[0].id}`, formData)
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
            this.editorValue = this.resource[0].body;
        }
    },
}

