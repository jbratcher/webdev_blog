<template>

    <section class="contact-user-about">
        <router-link class="nav-link" :to="{ name: 'contact'}" v-for="user in users" :key="user.id">
            <section class="card">
                <img class="card-img-top" :src="user.profile_pic_src" :alt="user.name">
                <div class="card-body">
                    <h2 class="card-title"> {{ user.intro }} </h2>
                    <p class="card-text"> {{ user.bio }} </p>
                </div>
            </section>
        </router-link>
    </section>

</template>

<script>
export default {

    name: 'UserAbout',
    props: ['users'],

};
</script>
