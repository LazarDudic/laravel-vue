<template>
  <div v-if="props.errors" class="input-error">
    <div v-for="(error, id) in props.errors" :key="id">
      <span class="text-danger">{{ error }} </span>
    </div>
  </div>
</template>

<script setup>
const props = defineProps(['errors'])
</script>
