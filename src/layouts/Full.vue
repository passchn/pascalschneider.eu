<template>
  <div class="main-content">
    <Nav />
    <div class="container-md">
      <main class="row justify-content-center mt-5">
        <article class="col-lg-12 mb-5">
          <slot/>
        </article>
      </main>
    </div>
    <Footer />
  </div>
</template>

<static-query>
query {
  metadata {
    siteName
  }
}
</static-query>

<script>
import Nav from '~/components/Navigation.vue'
import Footer from '~/components/Footer.vue'

export default {
  components: {
    Nav,
    Footer
  },
  props: [
    'sidebar'
  ]
}
</script>