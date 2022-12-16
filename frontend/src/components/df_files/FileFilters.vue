<template>
  <div class="d-flex justify-content-between mb-4">
    <form @submit.prevent="filterFiles" class="d-flex align-items-center ml-3">
      <input
        v-model="filter.search"
        class="form-control mr-2"
        placeholder="Search..."
      />
      <button class="btn btn-secondary btn-sm mb-0">Search</button>
    </form>
    <select
      @change="filterFiles"
      v-model="filter.order"
      class="form-control"
      style="width: 200px"
    >
      <option value="new">Newest</option>
      <option value="old">Oldest</option>
      <option value="name">Name</option>
    </select>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import FileRepository from '@/repositories/fileRepository'
import { responseIsOK } from '@/helpers/helper.js'
import FilePagination from '@/components/df_files/FilePagination'
const emit = defineEmits()
const props = defineProps(['filter'])

const filter = reactive({
  search: props.filter.search,
  order: props.filter.order
})

const filterFiles = () => {
  emit('filtersUpdated', filter)
}
</script>
