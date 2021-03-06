export const getResourcesMixin = {
    beforeCreate() {
        console.log("get resources mixin created");
    },
    data() {
        return {
            posts: [
                {
                    category: 'blog',
                    user_id: null,
                    title: "",
                    image_src: null,
                    body: "",
                    intro: "",
                }
            ],
            portfolioitems: [
                {
                    category: 'portfolio',
                    user_id: null,
                    title: "",
                    image_src: null,
                    body: "",
                    intro: "",
                    demo_url: "",
                    repo_url: "",
                }
            ],
            tutorials: [
                {
                    category: 'tutorial',
                    user_id: null,
                    title: "",
                    image_src: null,
                    body: "",
                    intro: "",
                }
            ],
            users: [
                {
                    category: 'user',
                    id: null,
                    name: "",
                    email: "",
                    image_src: "",
                    intro: "",
                    bio: "",
                }
            ],
        };
    },
    methods: {
        getResources(resourceType) {
            console.log(`Getting ${resourceType}`);
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
                if(resourceType !== "users") {
                    resource.intro = resource.body.substring(0,144)+"...";
                }
            });
        },
    },
}

