<template>
  <div class="form-group">
    <button
      type="button"
      @click="$emit('formSubmited')"
      class="btn btn-primary submit-button"
    >
      {{ name }}
    </button>
  </div>
</template>

<script setup>
const props = defineProps(['name'])
const name = props.name ?? 'Submit'

</script>
