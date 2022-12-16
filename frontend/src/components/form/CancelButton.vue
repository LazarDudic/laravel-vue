<template>
  <div class="form-group">
    <button type="button" @click="redirect" class="btn cancel-button">
      Cancel
    </button>
  </div>
</template>

<script setup>
import router from '@/router/index.js'
const props = defineProps(['redirect', 'back'])
const routeName = props.redirect

const redirect = () => {
  if (props.back) {
    return router.go(-1)
  }
  return router.push({ name: routeName })
}
</script>
