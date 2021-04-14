<template>
    <Article>
        <h1> {{ data.title }} </h1>
        <p
            v-for="i in data.content"
            :key="i"
        > 
            {{ i }} 
        </p>
        <hr class="mb-5 mt-3">
        <b-form @submit="submit" id="kontakt" v-if="form.show">
            <b-form-group
                id="input-group-1"
                :label="data.form.name"
                label-for="name"
            >
                <b-form-input
                id="name"
                v-model="form.data.name"
                type="text"
                :placeholder="user.name.first+' '+user.name.last"
                required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                id="input-group-2"
                :label="data.form.email"
                label-for="email"
            >
                <b-form-input
                id="email"
                v-model="form.data.email"
                type="email"
                :placeholder="user.email"
                required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                id="input-group-3"
                :label="data.form.phone"
                label-for="tel"
            >
                <b-form-input
                id="tel"
                v-model="form.data.phone"
                type="tel"
                :placeholder="user.phone"
                ></b-form-input>
            </b-form-group>
            <b-form-group
                id="input-group-4"
                :label="data.form.company"
                label-for="company"
            >
                <b-form-input
                id="company"
                v-model="form.data.company"
                type="text"
                :placeholder="data.form.random+' '+user.location.city"
                ></b-form-input>
            </b-form-group>
            <b-form-group
                id="input-group-5"
                :label="data.form.message"
                label-for="text"
            >
            <b-form-textarea
                id="text"
                required
                v-model="form.data.text"
                :placeholder="data.form.placeholder"
                rows="5"
                max-rows="12"
            ></b-form-textarea>
            </b-form-group>
            <b-button
                :disabled="!form.active" 
                type="submit" variant="primary"
            >
                <b-spinner v-if="form.active === false" type="border" small class="mr-2"></b-spinner>
                {{ data.form.submit }}
            </b-button>
        </b-form>
        <div
            v-if="form.success === true"
        >
            <p class="text-success">{{ form.message }}</p>
            <h3 class="mt-5"> {{ data.form_messages.your_data }} </h3>
            <p
                class="mt-3"
                v-for="(data, key, i) in this.form.phpdata"
                :key="i"
            >
                <strong>{{ key }}:</strong> {{ data }}
            </p>
        </div>
        <div
            v-if="form.success === false"
            class="mt-3"
        >
            <p class="text-danger block">
                {{ form.message }}
            </p>
        </div>
    </Article>
</template>

<page-query>
query MyQuery {
  allContactPage {
    edges {
      node {
        content
        title
        form {
          company
          email
          name
          message
          phone
          placeholder
          random
          submit
        }
        form_messages {
          error
          success
          your_data
        }
        settings {
          randomuser_nat
        }
      }
    }
  }
}
</page-query>

<script>
export default {
    data() {
        return {
            form: {
                show: true,
                active: true,
                success: null,
                message: null,
                data: {
                    name: '',
                    email: '',
                    phone: '',
                    company: '',
                    text: ''
                }
            },
            user: {
                name: {
                    first: '...',
                    last: ''
                },
                email: '...',
                phone: '...',
                location: {
                    city: '...',
                    country: '...'
                }
            }
        }
    },
    created() {
        this.data = this.$page.allContactPage.edges[0].node
    },
    async mounted() {
        let response = await fetch('https://randomuser.me/api/?nat='+this.data.settings.randomuser_nat)
        let user = await response.json()
        this.user = user.results[0]
    },
    methods: {
        async submit(e) {
            e.preventDefault()
            this.form.active = false 
            try {
                let response = await fetch('/api/mail.php', {
                    method: 'POST',
                    headers: {
                         "Content-Type": "application/json" 
                    },
                    body: JSON.stringify(this.form.data)
                })
                let result = await response.json()
                if (result.ok) {
                    this.form.show = false
                    this.form.success = true;
                    this.form.message = this.data.form_messages.success
                    this.form.phpdata = result.data
                } else {
                    this.form.show = true
                    this.form.success = false
                    this.form.message = this.data.form_messages.error
                    this.form.active = true 
                }
            } catch (error) {
                console.log(error)
                this.form.show = true
                this.form.success = false
                this.form.message = `${this.data.form_messages.error} \n ${error}`
                this.form.active = true 
            }
        }
    }
}

</script>
