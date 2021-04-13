<template>
  <div class="main-content">
    <Nav />
    <div class="container-md">
      <div class="row">
        <main class="col-lg-8">
          <article class="mt-5 mb-5">
            <slot/>
          </article>
        </main>
        <aside class="aside default-sidebar col-lg-4">
          <slot name="sidebar" />
        </aside>
      </div>
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
  }
}
</script>
