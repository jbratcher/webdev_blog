<template>

    <section class="parent">

        <global-header :userName="userName" :userId="userId" />

        <transition
            name="fade"
            mode="out-in"
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

<style lang="scss">

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .fadeIn {
        animation-name: fadeIn;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    .fadeOut {
        animation-name: fadeOut;
    }

    .animated {
        animation-duration: 1s;
        animation-fill-mode: both;
    }

</style>
