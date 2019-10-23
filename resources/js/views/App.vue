<template>

    <section>

        <global-header :userName="userName" :userId="userId" />

        <transition
            name="animate-route"
            enter-active-class="animated fadeIn"
            leave-active-class="animated fadeOut"
        >
            <router-view class="page"></router-view>
        </transition>

        <global-footer />


    </section>

</template>

<script>
    export default {
        props: {
            userId: {
                type: Number
            },
            userName: {
                type: String
            }
        }
    }
</script>

<style>
    @import "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css";

    .page {
        position: absolute;
        width: 100%;
    }

</style>
