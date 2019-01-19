<template>
  <div class="box">
    <div class="box-body">
      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add-employees">
        <fa icon="plus" fixed-width /> Employees
      </button>
      <vuetable
        :api-mode="false"
        :fields="fields"
        :data="data"
        :css="css.table"
      >
        <div slot="actions" slot-scope="props">
          <button class="btn btn-warning">Reset</button>
          <button v-if="props.rowData.status === 'Active'" class="btn btn-danger" @click="deactivateEmployee(props.rowData)">Deactivate</button>
          <button v-if="props.rowData.status === 'Inactive'" class="btn btn-success" @click="activateEmployee(props.rowData)">Activate</button>
          <button class="btn btn-danger" @click="removeEmployee(props.rowData)">Remove</button>
        </div>
      </vuetable>
    </div>

    <!-- MODALS -->
    <div id="modal-add-employees" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Add Employee</h4>
          </div>
          <form @submit.prevent="registerEmployee" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <!-- Name -->
              <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
                <div class="col-md-7">
                  <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                  <has-error :form="form" field="name"/>
                </div>
              </div>

              <!-- Email -->
              <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
                <div class="col-md-7">
                  <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                  <has-error :form="form" field="email"/>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">User Type</label>
                <div class="col-md-7 ">
                  <select v-model="form.userType" class="form-control select2">
                    <option>Admin</option>
                    <option>Doctor</option>
                    <option>Pharmacist</option>
                    <option>Nurse</option>
                    <option>Lab Technician</option>
                    <option>Clerk</option>
                    <option>Cashier</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
import tableCssConfig from './tableCssConfig'
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',

  metaInfo () {
    return { title: 'Employees' }
  },
  data () {
    return {
      fields: ['user_id', 'name', 'email', 'user_type', 'status', 'actions'],
      data: [],
      css: tableCssConfig,
      form: new Form({
        name: '',
        email: '',
        userType: 'Admin'
      })
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user'
    })
  },
  mounted () {
    this.getAllEmployees()
  },
  methods: {
    getAllEmployees () {
      axios.get('/api/getAllEmployees')
        .then(res => {
          this.data = res.data
        })
    },
    async registerEmployee () {
      await this.form.post('/api/addEmployee')

      axios.post('/api/createHistory', {
        history_type: 'registration',
        action_taken: 'created new account by user',
        created_by: this.user.name
      })

      this.getAllEmployees()
    },
    removeEmployee (data) {
      axios.post('/api/removeEmployee', { id: data.id })
        .then(res => {
          this.getAllEmployees()
        })
    },
    deactivateEmployee (data) {
      axios.post('/api/deactivateEmployee', { id: data.id })
        .then(res => {
          this.getAllEmployees()
        })
    },
    activateEmployee (data) {
      axios.post('/api/activateEmployee', { id: data.id })
        .then(res => {
          this.getAllEmployees()
        })
    }
  }
}
</script>
