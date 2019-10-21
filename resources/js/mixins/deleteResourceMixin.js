export const deleteResourceMixin = {
    created() {
        console.log("delete resource mixin created");
    },
    methods: {
        deleteResource(type, id) {
            axios.delete(`/api/${type}/${id}`)
                .then(response => this.getResources(type))
                $('.modal-backdrop').remove();
        },
    },
}

