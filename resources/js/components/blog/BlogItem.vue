<template>

    <router-link :to="{ name: 'blog-single', params: { post_slug: post.slug, post_id: post.id} }">
        <img :src="post.image_src" :alt="post.title">
        <h5 class="card-title">{{post.title}}</h5>
        <div class="card-body">
            <vue-markdown :source="post.body"></vue-markdown>
            <div class="card-buttons">
                <router-link
                    class="btn btn-primary read-more"
                    :to="{ name: 'blog-single', params: { post_slug: post.slug, post_id: post.id} }"
                >
                    Read More
                </router-link>
            </div>
        </div>
    </router-link>

</template>

<script>
export default {
  name: 'BlogItem',
  props: ['post'],
};
</script>
