<template>
  <div>patients</div>
</template>

<script>
export default {
  middleware: 'auth',
  metaInfo () {
    return { title: 'Patients' }
  }
}
</script>
