<template>
  <div class="box">
    <div class="box-body">
      <div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add-patient">
          <fa icon="plus" fixed-width /> Patient
        </button>
        <router-link :to="{ name: 'patients.transactions', params: { test } }">
          <button class="btn btn-warning">
            View All Patients Transactions
          </button>
        </router-link>
      </div>
      <vuetable :api-mode="false"
                :fields="fields"
                :data="data"
                :css="css.table"
      >
        <div slot="actions" slot-scope="props">
          <button class="btn btn-success">Edit</button>
          <button class="btn btn-primary">View</button>
          <button class="btn btn-danger">Transactions</button>
        </div>
      </vuetable>
      <router-view/>

      <!-- MODALS -->
      <patients-modal />
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import tableCssConfig from '../tableCssConfig'

import PatientsModal from './patientsModals'

export default {
  middleware: 'auth',
  metaInfo () {
    return { title: 'Patients' }
  },
  components: {
    PatientsModal
  },
  data () {
    return {
      fields: ['pid', 'name', 'address', 'gender', 'guardian', 'actions'],
      data: [],
      css: tableCssConfig,
      test: 'data'
    }
  },
  mounted () {
    this.getAllPatients()
  },
  methods: {
    getAllPatients () {
      axios.get('/api/getAllPatients')
        .then(res => {
          this.data = res.data
        })
    }
  }
}
</script>
