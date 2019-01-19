<template>
  <div class="box">
    <div class="box-body">
      <button class="btn btn-primary"><fa icon="plus" fixed-width /> Medicine</button>
      <vuetable
        :api-mode="false"
        :fields="fields"
        :data="data"></vuetable>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',
  metaInfo () {
    return { title: 'Medicines' }
  },
  data () {
    return {
      fields: ['brand_name', 'generic_name', 'price', 'quantity', 'expiration_date'],
      data: []
    }
  }
}
</script>
