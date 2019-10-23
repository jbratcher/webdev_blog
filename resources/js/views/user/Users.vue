<template>

    <section>

        <div class="container-fluid global-banner">
            <h1>Users</h1>
            <p class="lead">A list of users</p>
        </div>

        <section class="container content-section">

            <ul v-for="resource in users" :key="resource.id">
                <li class="tutorial-item">
                    <section class="card">
                        <div class="card-body">
                            <h2 class="card-title">{{resource.name}}</h2>
                            <img class="tutorial-item-img" :src="resource.image_src" :alt="resource.name">
                        </div>
                    </section>
                </li>
            </ul>

        </section>

    </section>

</template>

<script>
    import { getResourcesMixin } from '../../mixins/getResourcesMixin.js';

    export default {
        created() {
            this.getResources('users');
        },
        mixins: [ getResourcesMixin ],
        created() {
            this.getResources('users');
            console.log("Users mounted");
        },
    };
</script>
