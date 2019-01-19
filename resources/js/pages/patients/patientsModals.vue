<template>
  <div>
    <div id="modal-add-patient" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Add Patient</h4>
          </div>
          <form @submit.prevent="addPatient" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <!-- Name -->
              <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
                <div class="col-md-7">
                  <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                  <has-error :form="form" field="name"/>
                </div>
              </div>

              <!-- Address -->
              <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Address</label>
                <div class="col-md-7">
                  <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" type="text" name="address">
                  <has-error :form="form" field="address"/>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-4 text-md-right">
                  <label>Date of birth</label>
                  <input v-model="form.dob" :class="{ 'is-invalid': form.errors.has('dob') }" type="date" class="form-control">
                  <has-error :form="form" field="dob"/>
                </div>
                <div class="col-md-4 text-md-right">
                  <label>Age</label>
                  <input v-model="form.age" type="text" class="form-control">
                  <has-error :form="form" field="age"/>
                </div>
                <div class="col-md-4 text-md-right">
                  <label>Status</label>
                  <select v-model="form.status" class="form-control select2">
                    <option>Married</option>
                    <option>Single</option>
                    <option>Divorced</option>
                    <option>Separated</option>
                  </select>
                  <has-error :form="form" field="status"/>
                </div>
              </div>

              <!-- Gender -->
              <div class="form-group row">
                <div class="col-md-6">
                  <label>Gender</label>
                  <div>
                    <select v-model="form.gender" class="form-control select2">
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                    <has-error :form="form" field="gender"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Religion</label>
                  <div>
                    <select v-model="form.religion" class="form-control select2">
                      <option>Roman Catholic</option>
                      <option>Protestant</option>
                      <option>INC</option>
                    </select>
                    <has-error :form="form" field="religion"/>
                  </div>
                </div>
              </div>

              <!-- Guardian -->
              <div class="form-group row">
                <div class="col-md-6">
                  <label>Guardian</label>
                  <div>
                    <input v-model="form.guardian" :class="{ 'is-invalid': form.errors.has('guardian') }" class="form-control" type="text" name="guardian">
                    <has-error :form="form" field="guardian"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Contact Number</label>
                  <div>
                    <input v-model="form.contact_number" :class="{ 'is-invalid': form.errors.has('contact_number') }" class="form-control" type="text" name="contact_number">
                    <has-error :form="form" field="contact_number"/>
                  </div>
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
    <!--END MODAL-->
  </div>
</template>

<script>
import Form from 'vform'

export default {
  data () {
    return {
      form: new Form({
        name: '',
        address: '',
        dob: '',
        age: '',
        status: '',
        religion: '',
        gender: '',
        guardian: '',
        contact_number: ''
      })
    }
  },
  methods: {
    async addPatient () {
      await this.form.post('/api/addPatient')
      this.$parent.getAllPatients()
      this.form.reset()
    }
  }
}
</script>
