import { ref } from 'vue'
import { defineStore } from 'pinia'
import Cookies from 'js-cookie'

export const useCssStore = defineStore('css', () => {
  const sidebarCss = ref('')
  sidebarCss.value = Cookies.get('sidebar')
  function toggleSidebar() {
    sidebarCss.value === '' 
      ? sidebarCss.value = 'sidebar-small'
      : sidebarCss.value = '';
    Cookies.set('sidebar', sidebarCss.value, { expires: 7 })
  }

  return { sidebarCss, toggleSidebar }
})
