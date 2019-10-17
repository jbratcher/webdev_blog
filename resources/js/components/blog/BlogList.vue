<template>

    <ul class="posts-list" id="posts">
        <li class="post-card" v-for="post in posts" :key="post.id">
            <BlogItem :post="post" />
        </li>
    </ul>

</template>

<script>
import BlogItem from './BlogItem.vue';

export default {
  name: 'BlogList',
  components: {
      BlogItem
  },
  props: ['posts'],
};
</script>
