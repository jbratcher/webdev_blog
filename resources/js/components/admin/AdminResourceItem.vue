<template>

    <div v-if="resource">

        <h5>{{resource.title.substring(0,80)}}</h5>

        <section class="admin-actions">
            <router-link
                class="btn btn-primary"
                :to="{ name: `edit-${resource.category}-item`, params: { slug: resource.slug, id: resource.id} }"
            >
                Edit
            </router-link>

            <button
                class="btn btn-primary" type="button" data-toggle="modal"
                :data-target="deleteModalDataTarget(resource)"
            >
                Delete
            </button>

            <DeleteModal
                :resource="resource"
                @delete-resource="$emit('delete-resource', resource.api_route, resource.id)" />

        </section>
    </div>

</template>

<script>
import DeleteModal from './DeleteModal.vue';
export default {
    name: 'AdminResourceItem',
    components: {
        DeleteModal,
    },
    props: ['resource'],
    methods: {
        deleteModalDataTarget(data) {
            const dataTargetValue = `#confirmDelete${data.type}${data.id}Modal`;
            return dataTargetValue;
        },
    },
};
</script>
