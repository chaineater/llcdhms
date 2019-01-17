<template>
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <fa icon="bars" fixed-width />
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <fa icon="bell" fixed-width />
            <span class="label label-primary">2</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 2 notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="#">
                    <fa icon="exclamation-triangle" class="text-yellow" fixed-width /> Biogesic with ID 001 will be expired after 4 days
                  </a>
                </li>
                <li>
                  <a href="#">
                    <fa icon="skull-crossbones" class="text-red" fixed-width /> Gardan with ID 001145 is now expired
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img :src="user.photo_url" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ user.name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img :src="user.photo_url" class="img-circle" alt="User Image">

              <p>{{ user.user_id }} - {{ user.name }} <small>{{ user.user_type }}</small></p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                  <button class="btn btn-default btn-flat"><fa icon="cog" fixed-width/> {{ $t('settings') }}</button>
                </router-link>
              </div>
              <div class="pull-right">
                <a href="#" class="btn btn-default btn-flat" @click.prevent="logout">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
