<template>
  <div class="box">
    <div class="box-body">
      <router-link :to="{ name: 'patients' }">
        <button class="btn btn-success">
          Back
        </button>
      </router-link>
      <h3>transaction page</h3>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PatientsTransactions',
  middleware: 'auth',
  props: {
    test: String
  },
  mounted () {
    console.log('im only in transactions', this.test)
  }
}
</script>

<style scoped>

</style>
