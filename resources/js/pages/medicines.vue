<template>
  <div>medicines</div>
</template>

<script>
export default {
  middleware: 'auth',
  metaInfo () {
    return { title: 'Medicines' }
  }
}
</script>
