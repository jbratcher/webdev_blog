<template>

    <section>

        <section class="tutorial-item">
            <section class="card">
                <div class="card-body">
                    <h2 class="card-title">{{resource[0].title}}</h2>
                    <img class="tutorial-item-img" :src="resource[0].image_src" :alt="resource[0].title">
                    <vue-markdown :source="resource[0].body"></vue-markdown>
                </div>
            </section>
        </section>

    </section>

</template>

<script>
    import { getResourceMixin } from "../../mixins/getResourceMixin";

    export default {
        mixins: [ getResourceMixin ],
        created() {
            this.getResource('tutorials');
            this.getUser();
            console.log("Tutorial vue mounted");
        },
    };
</script>
