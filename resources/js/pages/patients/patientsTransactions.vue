<template>
  <div class="box">
    <div class="box-body">
      <router-link :to="{ name: 'patients' }">
        <button class="btn btn-success">
          Back
        </button>
      </router-link>
      <button class="btn btn-warning" data-toggle="modal" data-target="#modal-add-patient-transaction">Make Transaction</button>
      <vuetable
        :api-mode="false"
        :fields="fields"
        :data="data">
        <div slot="admitting_diagnosis" slot-scope="props">
          <button class="btn btn-primary">Add</button>
        </div>
        <div slot="date_discharge" slot-scope="props">
          <button class="btn btn-danger">Discharge</button>
        </div>
        <div slot="final_diagnosis" slot-scope="props">
          <button class="btn btn-primary">Add</button>
        </div>
        <div slot="doctors_prescription" slot-scope="props">
          <button class="btn btn-primary">Add</button>
        </div>
        <div slot="doctors_prescription" slot-scope="props">
          <button class="btn btn-primary">Add</button>
        </div>
        <div slot="total_bills" slot-scope="props">
          <button class="btn btn-primary">Process Payments</button>
        </div>
      </vuetable>
    </div>

    <div id="modal-add-patient-transaction" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Add Patient Transaction</h4>
          </div>
          <form @submit.prevent="addPatientTransaction" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label>Incharge Doctor</label>
                <select v-model="form.incharge_doctor" class="form-control select2">
                  <option v-for="(doctor, idx) in doctors" :key="idx">{{ doctor.name }}</option>
                </select>
              </div>
              <div class="form-group">
                <label>Date Admitted</label>
                <input v-model="form.date_admitted" type="datetime-local" class="form-control">
              </div>
              <div class="form-group">
                <label>Ward</label>
                <select v-model="form.ward" class="form-control select2">
                  <option v-for="(item, idx) in 10" :key="idx">LLCHDHS_WARD_{{ item }}</option>
                </select>
              </div>
              <div class="form-group">
                <label>Bed</label>
                <select v-model="form.bed" class="form-control select2">
                  <option v-for="(item, idx) in 10" :key="idx">LLCHDHS_BED_{{ item }}</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'

export default {
  name: 'PatientsTransactions',
  middleware: 'auth',
  data () {
    return {
      fields: ['transaction_id', 'incharge_doctor', 'date_admitted', 'ward', 'bed', 'admitting_diagnosis', 'date_discharge', 'final_diagnosis', 'doctors_prescription', 'total_bills'],
      data: [],
      form: new Form({
        patients_name: '',
        patients_id: '',
        incharge_doctor: '',
        date_admitted: '',
        ward: '',
        bed: ''
      }),
      patient: null,
      doctors: []
    }
  },
  created () {
    // get patient details
    this.getPatientDetails()
    this.getDoctors()
  },
  mounted () {
    this.getPatientTransactions()
  },
  methods: {
    getPatientTransactions () {
      axios.post('/api/getPatientTransactions', { pid: this.$route.params.pid })
        .then(res => {
          this.data = res.data
        })
    },
    getPatientDetails () {
      axios.post('/api/getPatient', { pid: this.$route.params.pid })
        .then(res => {
          if (res.data.length > 1) {
            console.error('somethings wrong data should be less than 1 @' + this.$route.fullPath)
          } else {
            this.patient = res.data[0]
            this.form.patients_name = res.data[0].name
            this.form.patients_id = res.data[0].pid
          }
        })
    },
    async getDoctors () {
      await axios.get('/api/getDoctors')
        .then(res => {
          this.doctors = res.data
        })
    },
    async addPatientTransaction () {
      await this.form.post('/api/addTransaction')
      this.getPatientTransactions()
    }
  }
}
</script>

<style scoped>

</style>
