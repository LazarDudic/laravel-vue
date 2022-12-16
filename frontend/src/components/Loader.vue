<template>
  <div id="df-loader" :class="[isLoading ? 'd-block' : 'd-none']">
    <div class="spinner-grow" role="status"></div>
    <div class="spinner-grow" role="status"></div>
    <div class="spinner-grow" role="status"></div>
  </div>
</template>

<script setup>
import {useLoadingStore} from '@/stores'
import { storeToRefs } from 'pinia'
const { isLoading } = storeToRefs(useLoadingStore())
</script>
