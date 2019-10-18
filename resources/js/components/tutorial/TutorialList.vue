<template>

    <ul class="posts-list" id="tutorial-items">
        <li class="tutorial-items-card" v-for="tutorial in tutorials" :key="tutorial.id">
            <TutorialItem :tutorial="tutorial" />
        </li>
    </ul>

</template>

<script>
import TutorialItem from '../../components/tutorial/TutorialItem.vue';

export default {
    components: {
        TutorialItem,
    },
    name: 'TutorialList',
    props: ['tutorials']
};
</script>
