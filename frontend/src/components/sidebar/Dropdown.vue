<template>
  <button
    class="btn btn-toggle align-items-center collapsed"
    data-bs-toggle="collapse"
    data-bs-target="#settings-collapse"
    aria-expanded="false"
  >
    <i class="fas fa-cog"></i><span class="sidebar-row-title">Settings</span>
  </button>
  <div class="collapse" id="settings-collapse">
    <ul class="btn-toggle-list list-unstyled fw-normal pb-1">
      <li>
        <router-link :to="{ name: 'admin-global-settings-list' }"
          >Global Settings List</router-link
        >
      </li>
      <li>
        <router-link :to="{ name: 'admin-app-settings' }"
          >App Settings</router-link
        >
      </li>
    </ul>
  </div>
</template>

<script setup>
const props = defineProps(['name', 'links'])


</script>
