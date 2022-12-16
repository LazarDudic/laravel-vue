<template>
  <button
    :id="buttonId"
    type="button"
    class="open-files-popup-btn"
    data-bs-toggle="modal"
    :data-bs-target="modalId"
  >
  <i class="fas fa-images"></i> Choose Image
  </button>
</template>

<script setup>
const props = defineProps(['modalId'])
const modalId = '#'+props.modalId
const buttonId = props.modalId+'-button'


</script>
