<template>
  <Header @rerenderContent="emit('rerenderContent')" />
  <div :class="[sidebarCss]">
    <Sidebar />
  </div>
  <div id="df-page-wrapper" :class="[sidebarCss]">
    <router-view
      :key="$route.path"
      @rerenderContent="emit('rerenderContent')"
      @toggleBody="toggleBody"
      name="admin"
    />
  </div>
  <Footer />
</template>

<script setup>
import { onMounted } from 'vue'
import { storeToRefs } from 'pinia'
import Header from '@/components/common/Header'
import Sidebar from '@/components/common/Sidebar'
import Footer from '@/components/common/Footer'
import { useCssStore } from '@/stores'
import { Tooltip } from 'bootstrap'
import $ from 'jquery'

const emit = defineEmits()

onMounted(() => {
  const tooltip = new Tooltip(document.body, {
    selector: "[data-bs-toggle='tooltip']"
  })
})

const toggleBody = () => {
  $('.content-body').slideToggle('fast')
  $(".fa-chevron-down").toggleClass('flip')
}



const { sidebarCss } = storeToRefs(useCssStore())
</script>


