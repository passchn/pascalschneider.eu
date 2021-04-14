<template>
    <div class="container-fluid footer" style="padding: 0px">
      <div class="container-md footer-content">
        <footer class="row justify-content-center text-center">
          <div class="col-lg-4 mb-3">
            <p><a :href="data.langlink"> {{ data.otherlang }} </a></p>
            <p><g-link :to="data.contactlink"> {{ data.contact }} </g-link></p>
            <p><g-link :to="data.imprintlink"> {{ data.imprint }} </g-link></p>
          </div>
          <div class="col-lg-4 mb-3">
            <p><a href="https://twitter.com/passchn" target="_blank"><fa :icon="['fab', 'twitter']" /> Twitter</a></p>
            <p><a href="https://github.com/passchn" target="_blank"><fa :icon="['fab', 'github']" /> Github</a></p>
            <p><a href="https://paydesk.co/journalist/pascal.schneider" target="_blank"><fa :icon="['fas', 'map-marker-alt']" /> Paydesk</a></p>
          </div>
          <div class="col-lg-4 mb-3">
            &copy; {{ year }} {{ $static.metadata.siteName }}
          </div>
        </footer>
      </div>
    </div>
</template>

<static-query>
query {
  metadata {
    siteName
  }
  allEtcData {
    edges {
      node {
        footer {
          contact
          contactlink
          imprint
          imprintlink
          otherlang
          langlink
        }
      }
    }
  }
}
</static-query>

<style scoped>
a  {
    color: #333; 
    transition: color 0.3s;
    padding: 12px; 
}
a:hover {
    color: var(--one);
}
</style>

<script>

export default {
    name: 'Footer',
    data() {
        return {
            year: this.currentYear()
        }
    },
    methods: {
        currentYear() {
            const currentTime = new Date()
            return currentTime.getFullYear()
        }
    },
    created() {
        this.data = this.$static.allEtcData.edges[0].node.footer
    },
    async mounted() {
      try { 
        let response = await fetch('/analytics/analytics.php')
        let data = await response.json()
        //console.log(data) 
      } catch (error) {
        console.log(error)
      }
    }
}
</script>