<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Dashboard</span>
      </a>
    </div>
    <h2 class="page-title">Dashboard</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Dashboard</h2>
        <p class="content-description">Glyphicons</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body"></div>
    </div>
  </div>
</template>

<script setup>
const emit = defineEmits()

</script>
