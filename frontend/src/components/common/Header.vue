<template>
  <nav
    id="df-navbar"
    class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
      <div>
        <a @click.prevent="cssStore.toggleSidebar()" id="collapse-sidebar" class="navbar-brand" href="#"
          ><i class="fas fa-bars"></i
        ></a>
        <a class="navbar-brand" href="#">{{globalSettings?.sitename}}</a>
      </div>
      <div>
        <ul
          class="navbar-nav ms-auto d-flex flex-row justify-content-between me-lg-5"
        >
            <LangDropdown @rerenderContent="emit('rerenderContent')" />
          <li class="nav-item dropdown">
            <a
              class="nav-link"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="fas fa-bell"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end position-absolute"></ul>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end position-absolute">
              <li><a class="dropdown-item" href="#">
                <span class="icon"><i class="fas fa-cog"></i></span> Settings
                </a></li>
              <li>
                <a class="dropdown-item" href="#" @click="userStore.logout()">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span> Logout
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { useUserStore, useGlobalSettingsStore, useCssStore } from '@/stores'
import { storeToRefs } from 'pinia'
import LangDropdown from '@/components/LangDropdown'
const emit = defineEmits()

const userStore = useUserStore()
const { globalSettings } = storeToRefs(useGlobalSettingsStore())
const cssStore = useCssStore()
</script>
