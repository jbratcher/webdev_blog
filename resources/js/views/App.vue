<template>

    <section>
        <router-view
            :userId=userId
            :userName=userName
        ></router-view>
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
