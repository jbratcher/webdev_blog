<template>


    <form>

        <div :class="['form-group m-1 p-3', (successful ? 'alert-success' : '')]">
            <span v-if="successful" class="label label-sucess">Published!</span>
        </div>
        <div :class="['form-group m-1 p-3', error ? 'alert-danger' : '']">
            <span v-if="errors.title" class="label label-danger">
            {{ errors.title[0] }}
            </span>
                <span v-if="errors.body" class="label label-danger">
            {{ errors.body[0] }}
            </span>
                <span v-if="errors.image" class="label label-danger">
            {{ errors.image[0] }}
            </span>
        </div>

        <div class="form-group">
            <input
                type="title"
                ref="title"
                class="form-control"
                id="title"
                required
                v-model="resource[0].title"
            >
        </div>

        <div class="form-group">
            <markdown-editor
                ref="body"
                id="body"
                toolbar="clipboard redo undo | bold italic strikethrough heading | image link | numlist bullist code quote | preview fullscreen"
                v-model="resource[0].body"
            ></markdown-editor>
        </div>

        <div class="custom-file mb-3">
            <input type="file" ref="image" name="image" class="custom-file-input" id="image">
            <label class="custom-file-label" >Select image</label>
        </div>

        <button type="submit" @click.prevent="editResource(resource.category, resource.id)" class="btn btn-primary block">
            Submit
        </button>

    </form>

</template>

<script>
    import { editResourceMixin } from "../../mixins/editResourceMixin";

    export default {
        created() {
            console.log("Edit post vue created");
        },
        updated() {
            this.updateEditorValue();
        },
        name: 'ResourceForm',
        mixins: [
            editResourceMixin,
        ],
        props: ['resource', 'user'],
    }
</script>
