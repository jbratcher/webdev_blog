<template>

    <ul class="posts-list">
        <li v-for="portfolioitem in portfolioitems" :key="portfolioitem.id">
            <PortfolioItem :portfolioitem="portfolioitem" />
        </li>
    </ul>

</template>

<script>
import PortfolioItem from './PortfolioItem.vue';

export default {
  name: 'PortfolioList',
  components: {
      PortfolioItem
  },
  props: ['portfolioitems'],
};
</script>
