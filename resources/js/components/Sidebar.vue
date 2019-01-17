<template>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img :src="user.photo_url" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ user.name }}</p>
          <a href="#"><fa icon="circle" class="text-success" fixed-width /> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><fa icon="search" fixed-width />
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- employee, patient, laboratory, medicines, history -->
        <li class="header">MAIN NAVIGATION</li>
        <li :class="{'active': $route.name === 'dashboard'}">
          <router-link :to="{ name: user ? 'dashboard' : 'welcome' }">
            <fa icon="th" fixed-width></fa> <span>Dashboard</span>
          </router-link>
        </li>
        <li :class="{'active': $route.name === 'employees'}">
          <router-link :to="{ name: 'employees' }">
            <fa icon="users" fixed-width /> <span>Employees</span>
          </router-link>
        </li>
        <li :class="{'active': $route.name === 'patients'}">
          <router-link :to="{ name: 'patients' }">
            <fa icon="wheelchair" fixed-width /> <span>Patients</span>
          </router-link>
        </li>
        <li :class="{'active': $route.name === 'laboratory'}">
          <router-link :to="{ name: 'laboratory' }">
            <fa icon="flask" fixed-width /> <span>Laboratory</span>
          </router-link>
        </li>
        <li :class="{'active': $route.name === 'medicines'}">
          <router-link :to="{ name: 'medicines' }">
            <fa icon="medkit" fixed-width /> <span>Medicines</span>
          </router-link>
        </li>
        <li :class="{'active': $route.name === 'history'}">
          <router-link :to="{ name: 'history' }">
            <fa icon="history" fixed-width /> <span>History</span>
          </router-link>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  }
}
</script>
