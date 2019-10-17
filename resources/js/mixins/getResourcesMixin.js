export const getResourcesMixin = {
    created() {
        console.log("get resources mixin created");
    },
    data() {
        return {
            posts: [
                {
                    user_id: null,
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
            portfolioitems: [
                {
                    user_id: null,
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
            tutorials: [
                {
                    user_id: null,
                    title: null,
                    image_src: null,
                    body: ""
                }
            ],
        };
    },
    methods: {
        getResources(resourceType) {
            axios.get(`/api/${resourceType}`).then(response => {
                this[resourceType] = response.data;
            })
            .then(() => this.truncateResources(resourceType))
            .catch(error => {
                this.error = error.response.data.message || error.message;
                console.log(`Error in getResources: ${this.error}`);
            });
        },
        truncateResources(resourceType) {
            this[resourceType].map(resource => {
                resource.body = resource.body.substring(0,144)+"...";
            });
        },
    },
}

