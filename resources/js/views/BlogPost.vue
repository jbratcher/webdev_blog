<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <section class="blog-post">
            <section class="card">
                <div class="card-body">
                    <h2 class="card-title">{{post[0].title}}</h2>
                    <div class="card-information">
                        <img class="card-profile-thumb" :src="user[0].profile_pic_src" :alt="user[0].name" />
                        <div class="card-info-holder">
                            <p class="card-profile-name">{{user[0].name}}</p>
                            <p class="card-publication-date">{{publicationDate}}</p>
                        </div>
                    </div>
                    <img class="blog-post-img" :src="post[0].image_src" :alt="post[0].title">
                    <vue-markdown :source="post[0].body"></vue-markdown>
                </div>
            </section>
        </section>

        <global-footer />

    </section>

</template>

<script>
    import { getPostMixin } from "../mixins/getPostMixin";
    export default {
        mixins: [ getPostMixin ],
        mounted() {
            console.log("Blog post vue mounted");
        },
         props: {
            userId: {
                type: Number
            },
            userName: {
                type: String
            },
        }
    };
</script>
