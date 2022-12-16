<template>
  <li class="nav-item dropdown">
    <a
      class="nav-link dropdown-toggle"
      id="navbarDropdown"
      role="button"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    >
    <span v-if="!selectedLanguage" class="d-flex align-items-center">
        <i class="fas fa-globe me-3"></i> 
        <span>All</span>
    </span>
    <span v-if="selectedLanguage?.html_lang ">
        <span class="icon me-2" v-html="selectedLanguage.html_lang "></span>{{ selectedLanguage.title }}
    </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end position-absolute">
      <li @click="selectLanguage()">
        <a class="dropdown-item" href="#"
          ><span class="icon"><i class="fas fa-globe"></i></span> All</a
        >
      </li>
      <li v-for="language in languages" @click="selectLanguage(language)">
        <a class="dropdown-item" href="#"><span class="icon">{{ language.html_lang }}</span>{{ language.title }}</a>
      </li>
    </ul>
  </li>
</template>

<script setup>
import { useLanguageStore } from '@/stores'
import { storeToRefs } from 'pinia'
const emit = defineEmits()

const langStore = useLanguageStore()
const { languages, selectedLanguage } = storeToRefs(langStore)

const selectLanguage = (language = null) => {
    langStore.selectLanguage(language)
    emit('rerenderContent')
}
</script>

