<template>
  <div style="height: 100vh">
    <div class="wrapper">
      <header class="main-header">
        <a href="/home" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><fa icon="h-square" fixed-width /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><fa icon="h-square" fixed-width /><b>LLCDHMS</b></span>
        </a>
        <navbar />
      </header>
      <sidebar />

      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            <fa v-if="$route.meta.icon" :icon="$route.meta.icon" fixed-width /> {{ _.capitalize([string=$route.name]) }}
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li v-for="(breadcrumb, idx) in breadcrumbList"
                :key="idx"
                :class="{'linked': !!breadcrumb.link, 'active': true }"
                @click="routeTo(idx)"
            >
              <fa v-if="breadcrumb.name === 'Dashboard'" icon="th" fixed-width /> {{ breadcrumb.name }}
            </li>
          </ol>
        </section>
        <section class="content">
          <child />
        </section>
      </div>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.1.0
        </div>
        <strong>Copyright &copy; LLCDHMS-Devs 2019.</strong> All rights
        reserved.
      </footer>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import Sidebar from '~/components/Sidebar'

import { mapGetters } from 'vuex'
import Child from "../components/Child";

export default {
  name: 'MainLayout',
  components: {
    Child,
    Navbar,
    Sidebar
  },
  data () {
    return {
      breadcrumbList: null
    }
  },
  computed: {
    ...mapGetters({
      users: 'auth/users'
    })
  },
  watch: {
    '$route' () {
      console.log(this.$route.meta.breadcrumb)
      this.breadcrumbList = this.$route.meta.breadcrumb
    }
  },
  methods: {
    routeTo (pRouteTo) {
      if (this.breadcrumbList[pRouteTo].link) {
        this.$router.push(this.breadcrumbList[pRouteTo].link)
      }
    }
  }
}
</script>
