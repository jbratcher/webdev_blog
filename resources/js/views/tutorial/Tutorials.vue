<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <div class="container-fluid global-banner">
            <h1>Tutorials</h1>
            <p class="lead">Learn something new</p>
        </div>

        <section class="container content-section">

            <TutorialList :tutorials="this.tutorials" />

        </section>

        <global-footer />

    </section>

</template>

<script>
    import TutorialList from '../../components/tutorial/TutorialList.vue';
    import { getResourcesMixin } from '../../mixins/getResourcesMixin.js';
    export default {
        components: {
            TutorialList,
        },
        mixins: [ getResourcesMixin ],
        created() {
            this.getResources('tutorials');
            console.log("Tutorials mounted");
        },
        props: {
            userId: {
                type: Number
            },
            userName: {
                type: String
            },
        }
    };
</script>
