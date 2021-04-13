<template>
    <Article>
        <h1> {{ data.title }} </h1>
        <p> {{ data.subtitle }} </p>
        <p class="block"> {{ data.address }} </p>
        <p> {{ data.disclaimer }} </p>
    </Article>
</template>

<page-query>
query MyQuery {
  allEtcData {
    edges {
      node {
        imprint {
          title
          subtitle
          address
          disclaimer
        }
      }
    }
  }
}
</page-query>

<script>
export default {
    metaInfo() {
        return {
            title: this.data.title,
            meta: [
                { name: 'description', content: this.data.title }
            ]
        } 
    },
    created() {
        this.data = this.$page.allEtcData.edges[0].node.imprint
    }
}
</script>