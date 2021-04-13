<template>
  <Full>

    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center">
        <h1 class="bigletters">
          {{ data.title }}
        </h1>
        <p class="text-muted"> {{ data.subtitle }} </p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-8">
        <p
          v-for="p in data.content"
          :key="p"
        >
          {{ p }} 
        </p>
      </div>
      <div class="col-sm-4">
        <g-image alt="Pascal Schneider" class="img-fluid" src="~/assets/img/pascal.jpeg" width="370" quality="80" />
      </div>
    </div>
  </Full>
</template>

<page-query>
query MyQuery {
  allIndexPage {
    edges {
      node {
        content
        subtitle
        title
      }
    }
  }
}
</page-query>

<script>
export default {
  metaInfo: {
    title: 'Über mich'
  },
  created() {
    this.data = this.$page.allIndexPage.edges[0].node
  }
}
</script>

<style>
.home-links a {
  margin-right: 1rem;
}
</style>
