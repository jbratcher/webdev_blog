<template>

    <router-link :to="{ name: 'tutorial-single', params: { tutorial_slug: tutorial.slug, tutorial_id: tutorial.id} }">
        <img :src="tutorial.image_src" :alt="tutorial.title">
        <h5 class="card-title">{{tutorial.title}}</h5>
        <div class="card-body">
            <vue-markdown :source="tutorial.body"></vue-markdown>
        </div>
    </router-link>

</template>

<script>
export default {
    name: 'TutorialItem',
    props: ['tutorial'],
};
</script>
