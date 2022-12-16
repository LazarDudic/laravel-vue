<template>
  <div v-if="success" class="alert alert-success alert-message-postion">
    <span>{{ success }}</span>
    <button class="btn-sm btn-close float-end" @click="closeAlert"></button>
  </div>
  <div v-if="errors?.global" class="alert alert-danger alert-message-postion">
    <span>{{ errors.global }}</span>
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
.alert-message-postion {
    position: fixed; 
    display: flex;
    justify-content: space-between;
    align-items: center;
    bottom: 50px;
    right: 17px;
    max-width: 800px;
    width: 100%;
    text-align: center;
    z-index: 9999;
    margin-bottom: 0;
    padding: 10px;
    font-weight: bolder;
    font-size: 1.8rem;
}

</style>