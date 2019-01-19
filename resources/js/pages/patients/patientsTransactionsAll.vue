<template>
  <div class="box">
    <div class="box-body">
      <router-link :to="{ name: 'patients' }">
        <button class="btn btn-success">
          Back
        </button>
      </router-link>
      <vuetable
        ref="TATable"
        :api-mode="false"
        :fields="fields"
        :data="data"></vuetable>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      fields: ['patients_id', 'patients_name', 'transaction_id', 'incharge_doctor', 'date_admitted', 'ward', 'bed', 'admitting_diagnosis', 'date_discharge', 'final_diagnosis', 'doctors_prescription', 'total_bills'],
      data: []
    }
  },
  mounted () {
    if (this.$route.query.q === 'all') {
      this.init()
    } else {
      this.$router.push('/patients/transactions?q=all')
    }
  },
  methods: {
    init () {
      axios.get('/api/getAllTransactions')
        .then(res => {
          this.data = res.data
        })
    }
  }
}
</script>

<style lang="scss">
.vuetable {
  width: 100%;
  tbody {
    width: 100%;
    overflow: scroll;
  }
}
</style>
