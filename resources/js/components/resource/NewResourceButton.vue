<template>

    <div v-if="resources.title" class="container admin-menu">
        <i class="fas fa-plus-circle fa-2x"></i>
        <router-link :to="{ name: `create-${resources[0].category}-item` }">New {{ resources[0].category }}</router-link>
    </div>

</template>

<script>
export default {
  name: 'NewResourceButton',
  props: ['resources']
};
</script>
