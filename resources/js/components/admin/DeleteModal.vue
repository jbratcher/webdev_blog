<template>

    <div class="modal" :id="deleteModalId(resource)" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete resource</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{`Are you sure you want to delete ${resource.title} - ${resource.id}?`}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="$emit('delete-resource', resource.id)">Confirm Deletion</button>
            </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'DeleteModal',
    props: ['resource'],
    methods: {
        deleteModalId(data) {
            const dataTargetValue = `confirmDelete${data.category}${data.id}Modal`;
            return dataTargetValue;
        },
    },
};
</script>
