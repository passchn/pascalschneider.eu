<template>
    <Full>
        <h1 class="bigletters"> {{ data.title }} </h1>
        <strong> {{ data.subtitle }} </strong>
    </Full>
</template>

<page-query>
query MyQuery {
  allEtcData {
    edges {
      node {
        err404 {
          meta
          subtitle
          title
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
            title: this.data.meta,
            meta: [
                { name: 'description', content: this.data.subtitle }
            ]
        } 
    },
    created() {
        this.data = this.$page.allEtcData.edges[0].node.err404
    }
}
</script>