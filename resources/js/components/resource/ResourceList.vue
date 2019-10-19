<template>

    <ul class="posts-list" :id="resources[0].type">
        <li class="post-card" v-for="resource in resources" :key="resource.id">
            <ResourceItem :resource="resource" />
        </li>
    </ul>

</template>

<script>
import ResourceItem from './ResourceItem.vue';

export default {
  name: 'ResourceList',
  components: {
      ResourceItem,
  },
  props: ['resources'],
};
</script>
