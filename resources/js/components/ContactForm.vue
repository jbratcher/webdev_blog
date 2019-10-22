<template>

    <section class="contact-form">

        <h2>Let me help with your next project.</h2>

        <p>I am currently <span class="open">open to new prospects</span>.</p>

        <form @submit.prevent="submit">

            <!-- Name field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" v-model="fields.name">
                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>

            <!-- Email field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" v-model="fields.email">
                <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
            </div>

            <!-- Subject field -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" v-model="fields.subject">
                <div v-if="errors && errors.subject" class="text-danger">{{ errors.subject[0] }}</div>
            </div>

            <!-- Message field -->
            <div class="form-group">
                <label for="message"> Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" v-model="fields.message"></textarea>
                <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <div v-if="success" class="alert alert-success mt-3">Message sent!</div>

        </form>

    </section>

</template>

<script>
export default {
  name: 'ContactForm',
  data() {
        return {
            errors: {},
            fields: {},
            loaded: true,
            success: false,
        };
    },
    methods: {
        submit() {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                axios.post('/submit', this.fields)
                    .then(response => {
                        this.fields = {};
                        this.loaded = true;
                        this.success = true;
                    })
                    .catch(error => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                            console.log("Most likely a field is missing from the form.")
                        }
                    });
            }
        },
    }
};
</script>
