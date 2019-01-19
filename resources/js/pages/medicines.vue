<template>
  <div class="box">
    <div class="box-body">
      <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add_medicines"><fa icon="plus" fixed-width /> Medicines</button>
      <vuetable
        :api-mode="false"
        :fields="fields"
        :data="data"></vuetable>
    </div>
    <div id="modal_add_medicines" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Add Medicines</h4>
          </div>
          <form @submit.prevent="addMedicines" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <div class="form-group">
                <label>Brand Name</label>
                <input v-model="form.brand_name" type="text" class="form-control">
              </div>

              <div class="form-group">
                <label>Generic Name</label>
                <input v-model="form.generic_name" type="text" class="form-control">
              </div>

              <div class="form-group">
                <label>Price</label>
                <input v-model="form.price" type="number" class="form-control" @input="calcTotalPrice">
              </div>

              <div class="form-group">
                <label>Quantity</label>
                <input v-model="form.quantity" type="number" class="form-control" @input="calcTotalPrice">
              </div>

              <div class="form-group">
                <label>Total Price</label>
                <input v-model="form.total_price" type="text" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label>Expiration Date</label>
                <input v-model="form.expiration_date" type="date" class="form-control">
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
    return { title: 'Medicines' }
  },
  data () {
    return {
      fields: ['brand_name', 'generic_name', 'price', 'quantity', 'total_price', 'expiration_date'],
      data: [],
      form: new Form({
        brand_name: '',
        generic_name: '',
        price: '',
        quantity: '',
        total_price: '',
        expiration_date: ''
      })
    }
  },
  mounted () {
    this.init()
  },
  methods: {
    init () {
      axios.get('/api/getAllMedicines')
        .then(res => {
          this.data = res.data
        })
    },
    addMedicines () {
      let dup = false
      this.data.forEach(o => {
        if (o.brand_name === this.form.brand_name && o.generic_name === this.form.generic_name && o.price === this.form.price && o.expiration_date === this.form.expiration_date) {
          dup = true
          this.updateMedicines(o.id, {
            oldPrice: o.price,
            newPrice: this.form.price,
            oldQuantity: o.quantity,
            newQuantity: this.form.quantity
          })
        }
      })
      if (!dup) {
        console.log('dup false')
        this.form.post('/api/addMedicines')
      }
      this.init()
    },
    updateMedicines (id, params) {

    },
    calcTotalPrice () {
      if ((this.form.price !== '' && this.form.quantity === '') || (this.form.price === '' && this.form.quantity !== '')) {
        console.log(this.form.price)
        console.log(this.form.quantity)
      }
      console.log('out')
    }
  }
}
</script>
