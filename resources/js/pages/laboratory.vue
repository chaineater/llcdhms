<template>
  <div class="box">
    <div class="box-body">
      <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add_laboratory"><fa icon="plus" fix-width /> Laboratory</button>
      <vuetable
        :api-mode="false"
        :fields="fields"
        :data="data"></vuetable>
    </div>

    <div id="modal_add_laboratory" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Add Laboratory</h4>
          </div>
          <form @submit.prevent="addLaboratory" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label>Laboratory Name</label>
                <input v-model="form.lab_name" type="text" class="form-control">
              </div>

              <div class="form-group">
                <label>Laboratory Price</label>
                <input v-model="form.lab_price" type="text" class="form-control">
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
  middleware: 'auth',
  metaInfo () {
    return { title: 'Laboratory' }
  },
  data () {
    return {
      fields: ['lab_name', 'lab_price'],
      data: [],
      form: new Form({
        lab_name: '',
        lab_price: ''
      })
    }
  },
  mounted () {
    this.init()
  },
  methods: {
    init () {
      axios.get('/api/getAllLabs')
        .then(res => {
          this.data = res.data
        })
    },
    addLaboratory () {
      this.form.post('/api/addLab')
      this.init()
    }
  }
}
</script>
