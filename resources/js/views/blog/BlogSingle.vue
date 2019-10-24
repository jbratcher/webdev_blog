<template>

    <section>

        <section class="blog-post">
            <section class="card">
                <div class="card-body">
                    <h2 class="card-title">{{resource[0].title}}</h2>
                    <div class="card-information">
                        <img class="card-profile-thumb" :src="user[0].image_src" :alt="user[0].name" />
                        <div class="card-info-holder">
                            <p class="card-profile-name">{{user[0].name}}</p>
                            <p class="card-publication-date">{{publicationDate}}</p>
                        </div>
                    </div>
                    <img class="blog-post-img" :src="resource[0].image_src" :alt="resource[0].title">
                    <vue-markdown :source="resource[0].body"></vue-markdown>
                </div>
            </section>
        </section>

    </section>

</template>

<script>
    import { getResourceMixin } from "../../mixins/getResourceMixin";

    export default {
        mixins: [ getResourceMixin ],
        created() {
            this.getResource('posts');
            this.getUser();
            console.log("Blog post vue mounted");
        },
    };
</script>
