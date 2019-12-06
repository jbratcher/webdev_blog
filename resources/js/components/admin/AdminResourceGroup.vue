<template>

    <section class="container resource-list">

        <h2>{{ capitalizedResourceName }}</h2>

        <NewResourceButton :resources="this.resources" />

        <AdminResourceList
            :resources="this.resources"
            @delete-resource="deleteResource"
        />

    </section>

</template>

<script>
import AdminResourceList from './AdminResourceList'
import NewResourceButton from '../resource/NewResourceButton.vue';
import { deleteResourceMixin } from '../../mixins/deleteResourceMixin.js';
import { getResourcesMixin } from '../../mixins/getResourcesMixin.js';

export default {
    name: 'AdminResourceGroup',
    components: {
        AdminResourceList,
        NewResourceButton,
    },
    mixins: [
        deleteResourceMixin,
        getResourcesMixin
    ],
    props: ['resources'],
    computed: {
        capitalizedResourceName: function() {
            if(this.resources[0].category) {
                let string = this.resources[0].category;
                return string.charAt(0).toUpperCase() + string.slice(1) + " Items";
            }
        }
    },
};
</script>
