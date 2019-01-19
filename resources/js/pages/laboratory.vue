<template>
  <div class="box">
    <div class="box-body">
      <button class="btn btn-primary"><fa icon="plus" fix-width /> Laboratory</button>
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
    return { title: 'Laboratory' }
  },
  data () {
    return {
      fields: ['lab_name', 'lab_price'],
      data: []
    }
  }
}
</script>
