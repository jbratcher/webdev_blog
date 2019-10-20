<template>

    <router-link :to="{ name: `${resource.type}-single`, params: { slug: resource.slug, id: resource.id} }">
        <img :src="resource.image_src" :alt="resource.title">
        <h5 class="card-title">{{resource.title}}</h5>
        <div class="card-body">
            <vue-markdown :source="resource.intro"></vue-markdown>
            <div class="card-buttons">
                <router-link
                    class="btn btn-primary read-more"
                    :to="{ name: `${resource.type}-single`, params: { slug: resource.slug, id: resource.id} }"
                >
                    Read More
                </router-link>
            </div>
        </div>
    </router-link>

</template>

<script>
export default {
    name: 'ResourceItem',
    props: ['resource'],
};
</script>
