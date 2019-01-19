<template>
  <div class="box">
    <div class="box-body">
      <vuetable
        :api-mode="false"
        :fields="fields"
        :data="data"></vuetable>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  middleware: 'auth',
  metaInfo () {
    return { title: 'History' }
  },
  data () {
    return {
      fields: ['history_type', 'action_taken', 'created_by'],
      data: []
    }
  },
  mounted () {
    this.init()
  },
  methods: {
    init () {
      axios.get('/api/getAllHistory')
        .then(res => {
          this.data = res.data
        })
    }
  }
}
</script>
