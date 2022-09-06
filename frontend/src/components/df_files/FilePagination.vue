<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li
        v-for="(item, i) in paginationPages.data"
        :class="getCss(item.print)"
        @click="goToPage(item.page)"
      >
        <a class="page-link" href="#">{{ item.print }}</a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import { responseIsOK } from '@/helpers/helper.js'
import { useFilesStore } from '@/stores'
import FileRepository from '@/repositories/fileRepository'

const filesStore = await useFilesStore()
const { lastPage, currentPage } = storeToRefs(filesStore)

const paginationPages = reactive({ data: [] })

const getPaginationPages = () => {
  let k = 0
  const paginNumPages = []
  if (currentPage.value - 1 > 0) {
    paginNumPages[k] = { print: '<', page: currentPage.value - 1 } // ovo je prev button
  } else {
    paginNumPages[k] = { print: '<', page: null } // ovo je prev button
  }
  k++

  const link_limit = 7 // maximum number of links (a little bit inaccurate, but will be ok for now)
  if (lastPage.value > 1) {
    for (let index = 1; index <= lastPage.value; index++) {
      let half_total_links = Math.floor(link_limit / 2)
      let from = currentPage.value - half_total_links
      let to = currentPage.value + half_total_links

      if (currentPage.value < half_total_links) {
        to += half_total_links - currentPage.value
      }
      if (lastPage.value - currentPage.value < half_total_links) {
        from -= half_total_links - (lastPage.value - currentPage.value) - 1
      }

      if (lastPage.value - 1 === currentPage.value) {
      }

      if (from < index && index < to) {
        paginNumPages[k] = { print: index, page: index }
        k++
      }
    }
  } else {
    paginNumPages[k] = { print: 1, page: 1 }
  }

  if (currentPage.value + 1 <= lastPage.value) {
    paginNumPages[k] = { print: '>', page: currentPage.value + 1 } // ovo je next button
  } else {
    paginNumPages[k] = { print: '>', page: null } // ovo je next button
  }
  k++

  return paginNumPages;
}

paginationPages.data = getPaginationPages()

const goToPage = (page) => {
  if (page === null) return
  filesStore.goToPage(page)
  getPaginNumPages()
}

const getCss = (page) => {
  if (currentPage.value === page) {
    return 'page-item active'
  }
  if (1 === currentPage.value && page === '<') {
    return 'page-item disabled'
  }
  if (currentPage.value === lastPage.value && page === '>') {
    return 'page-item disabled'
  }
  return 'page-item'
}
</script>

<style>
.page-link:focus {
  color: #0a58ca;
  background-color: transparent;
  box-shadow: none;
}
</style>
