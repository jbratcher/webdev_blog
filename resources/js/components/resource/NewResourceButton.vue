<template>

    <div v-if="resources" class="container admin-menu">
        <i class="fas fa-plus-circle fa-2x"></i>
        <router-link :to="{ name: `create-${resources[0].type}-item` }">New {{ resources[0].type }}</router-link>
    </div>

</template>

<script>
export default {
  name: 'NewResourceButton',
  props: ['resources']
};
</script>
