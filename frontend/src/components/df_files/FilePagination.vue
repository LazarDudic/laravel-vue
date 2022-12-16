<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li
        v-for="(item, i) in paginationPages.data"
        :class="getCss(item.print)"
        @click.prevent="goToPage(item.page)"
      >
        <a class="page-link" href="#">{{ item.print }}</a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { reactive } from 'vue'
const props = defineProps(['pages'])
const emit = defineEmits()

const lastPage = props.pages.lastPage
const currentPage = props.pages.currentPage
const paginationPages = reactive({ data: [] })

const getPaginationPages = () => {
  if (lastPage < 2) {
    return []
  }
  let k = 0
  const paginNumPages = []

  if (currentPage - 1 > 0) {
    paginNumPages[k] = { print: '<', page: currentPage - 1 } // ovo je prev button
  } else {
    paginNumPages[k] = { print: '<', page: null } // ovo je prev button
  }
  k++

  const link_limit = 7 // maximum number of links (a little bit inaccurate, but will be ok for now)
  if (lastPage > 1) {
    for (let index = 1; index <= lastPage; index++) {
      let half_total_links = Math.floor(link_limit / 2)
      let from = currentPage - half_total_links
      let to = currentPage + half_total_links

      if (currentPage < half_total_links) {
        to += half_total_links - currentPage
      }
      if (lastPage - currentPage < half_total_links) {
        from -= half_total_links - (lastPage - currentPage) - 1
      }

      if (lastPage - 1 === currentPage) {
      }

      if (from < index && index < to) {
        paginNumPages[k] = { print: index, page: index }
        k++
      }
    }
  } else {
    paginNumPages[k] = { print: 1, page: 1 }
  }

  if (currentPage + 1 <= lastPage) {
    paginNumPages[k] = { print: '>', page: currentPage + 1 } // ovo je next button
  } else {
    paginNumPages[k] = { print: '>', page: null } // ovo je next button
  }
  k++

  return paginNumPages
}

paginationPages.data = getPaginationPages()

const goToPage = (page) => {
  if (page === null) return
  emit('goToPage', page)
}

const getCss = (page) => {
  if (currentPage === page) {
    return 'page-item active'
  }
  if (1 === currentPage && page === '<') {
    return 'page-item disabled'
  }
  if (currentPage === lastPage && page === '>') {
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
