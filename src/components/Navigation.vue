<template>
    <b-navbar toggleable="sm" type="dark" variant="dark" sticky>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav class="m-auto">
                <b-nav-item to="/"> {{ data.start }} </b-nav-item>
                <b-nav-item :to="data.cvlink"> {{ data.cv }} </b-nav-item>
                <b-nav-item :to="data.contactlink"> {{ data.contact }} </b-nav-item>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<static-query>
query {
  allEtcData {
    edges {
      node {
        nav {
            start
            cv
            cvlink
            contact
            contactlink
        }
      }
    }
  }
}
</static-query>

<script>
export default {
    name: 'Nav',
    created() {
        this.data = this.$static.allEtcData.edges[0].node.nav
    }
}
</script>
