<template>
  <div>history</div>
</template>

<script>
export default {
  middleware: 'auth',
  metaInfo () {
    return { title: 'History' }
  }
}
</script>
