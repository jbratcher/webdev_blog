<template>

    <section class="container resource-list">

        <h2>{{ capitalizedResourceName }}</h2>

        <NewResourceButton :resources="this.resources" />

        <AdminResourceList
            :resources="this.resources"
            @delete-resource="$emit('delete-resource', resource.api_route, resource.id)"
        />

    </section>

</template>

<script>
import AdminResourceList from './AdminResourceList'
import NewResourceButton from '../resource/NewResourceButton.vue';

export default {
    name: 'AdminResourceGroup',
    components: {
        AdminResourceList,
        NewResourceButton,
    },
    props: ['resources'],
    computed: {
        capitalizedResourceName: function() {
            if(this.resources[0].type) {
                let string = this.resources[0].type;
                return string.charAt(0).toUpperCase() + string.slice(1) + " Items";
            }
        }
    },
};
</script>
