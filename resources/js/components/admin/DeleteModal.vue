<template>

        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete blog post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" @click="$emit('delete-resource', resource.id)">Confirm Deletion</button>
            </div>
            </div>
        </div>

</template>

<script>
export default {
    name: 'DeleteModal',
    props: ['resource'],
};
</script>
