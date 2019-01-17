<template>
  <div class="box">
    <div class="box-body">
      <h3>DASHBOARD</h3>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },
  data () {
    return {
    }
  }
}
</script>
