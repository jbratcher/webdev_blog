<template>

    <ul>
        <li v-for="resource in resources" :key="resource.id">
            <AdminResourceItem :resource="resource" @delete-resource="$emit('delete-resource', resource.id)" />
        </li>
    </ul>

</template>

<script>
import AdminResourceItem from './AdminResourceItem.vue';

export default {
  name: 'AdminResourceList',
  components: {
      AdminResourceItem,
  },
  props: ['resources'],
};
</script>
