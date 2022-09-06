<template>
  <div v-if="success" class="alert-success alerts-postion">
    {{ success }}
    <button class="btn-sm btn-close float-end" @click="closeAlert"></button>
  </div>
  <div v-if="errors?.global" class="alert alert-danger alerts-postion w-100">
    {{ errors.global }}
    <button class="btn-sm btn-close float-end" @click="closeAlert"></button>
  </div>
</template>

<script setup>
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'

const alertStore = useAlertsStore()
const { errors, success } = storeToRefs(alertStore)
const closeAlert = () => { alertStore.resetState() }
</script>


<style scoped>
.alerts-postion {
    position: fixed; 
    bottom: 0;
    width: 100%;
    text-align: center;
    z-index: 9999;
    margin-bottom: 0;
    padding: 10px;
    font-weight: bolder;
}

</style>