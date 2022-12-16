<template>
  <div
    id="df-sidebar"
    class="flex-shrink-0 bg-white"
    @mouseleave="collapseHoverExit"
  >
    <img src="/assets/images/logo.svg" alt="" class="admin-logo">
    <ul class="list-unstyled ps-0">
      <li>
        <router-link
          class="btn btn-sidebar align-items-center"
          :to="{ name: 'admin-dashboard' }"
        >
          <i class="fas fa-home"></i>
          <span class="sidebar-row-title"> Dashboard </span>
        </router-link>
      </li>
      <li>
        <button
          class="btn btn-toggle align-items-center"
          @click="collapseClick"
          @mouseenter="collapseHoverEnter"
          @mouseleave="collapseHoverExit"
        >
          <i class="fas fa-file"></i
          ><span class="sidebar-row-title">Pages</span>
        </button>
        <ul class="btn-toggle-list list-unstyled fw-normal pb-1">
          <li>
            <router-link :to="{ name: 'admin-pages-list' }">List</router-link>
          </li>
          <li>
            <router-link :to="{ name: 'admin-pages-create' }"
              >Create</router-link
            >
          </li>
        </ul>
      </li>
      <li>
        <button
          class="btn btn-toggle align-items-center"
          @click="collapseClick"
          @mouseenter="collapseHoverEnter"
          @mouseleave="collapseHoverExit"
        >
          <i class="fas fa-users"></i
          ><span class="sidebar-row-title">Users</span>
        </button>
        <ul class="btn-toggle-list list-unstyled fw-normal pb-1">
          <li>
            <router-link :to="{ name: 'admin-users-list' }">List</router-link>
          </li>
          <li>
            <router-link :to="{ name: 'admin-users-create' }"
              >Create</router-link
            >
          </li>
        </ul>
      </li>
      <li>
        <button
          class="btn btn-toggle align-items-center"
          @click="collapseClick"
          @mouseenter="collapseHoverEnter"
          @mouseleave="collapseHoverExit"
        >
          <i class="fas fa-copyright"></i
          ><span class="sidebar-row-title">Categories</span>
        </button>
        <ul class="btn-toggle-list list-unstyled fw-normal pb-1">
          <li>
            <router-link :to="{ name: 'admin-categories-list' }"
              >List</router-link
            >
          </li>
          <li>
            <router-link :to="{ name: 'admin-categories-create' }"
              >Create</router-link
            >
          </li>
        </ul>
      </li>
      <li>
        <button
          class="btn btn-toggle align-items-center"
          @click="collapseClick"
          @mouseenter="collapseHoverEnter"
          @mouseleave="collapseHoverExit"
        >
        <i class="fas fa-newspaper"></i><span class="sidebar-row-title">News</span>
        </button>
        <ul class="btn-toggle-list list-unstyled fw-normal pb-1">
          <li>
            <router-link :to="{ name: 'admin-news-list' }"
              >List</router-link>
          </li>
          <li>
            <router-link :to="{ name: 'admin-news-create' }"
              >Create</router-link>
          </li>
        </ul>
      </li>
      <li>
        <button
          class="btn btn-toggle align-items-center"
          @click="collapseClick"
          @mouseenter="collapseHoverEnter"
          @mouseleave="collapseHoverExit"
        >
          <i class="fas fa-globe"></i
          ><span class="sidebar-row-title">Languages</span>
        </button>

        <ul class="btn-toggle-list list-unstyled fw-normal pb-1">
          <li>
            <router-link :to="{ name: 'admin-languages-list' }"
              >List</router-link
            >
          </li>
          <li>
            <router-link :to="{ name: 'admin-languages-create' }"
              >Create</router-link
            >
          </li>
        </ul>
      </li>
      <li>
        <button
          class="btn btn-toggle align-items-center"
          @click="collapseClick"
          @mouseenter="collapseHoverEnter"
          @mouseleave="collapseHoverExit"
        >
          <i class="fas fa-cog"></i
          ><span class="sidebar-row-title">Settings</span>
        </button>
        <ul class="btn-toggle-list list-unstyled fw-normal pb-1">
          <li>
            <router-link :to="{ name: 'admin-global-settings-list' }"
              >Global Settings List</router-link
            >
          </li>
          <li>
            <router-link :to="{ name: 'admin-app-settings' }"
              >App Settings</router-link
            >
          </li>
        </ul>
      </li>
    </ul>

    <div class="sidebar-footer">
      <a href="#">
        <i class="fas fa-cog"></i>
      </a>
      <a href="#">
        <i class="fas fa-compress"></i>
      </a>
      <a href="#">
        <i class="fas fa-info-circle"></i>
      </a>
      <a href="#" @click.prevent="userStore.logout()">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </div>
  </div>
</template>

<script setup>
import $ from 'jquery'
import { onMounted } from 'vue'
import { useUserStore } from '@/stores'

const userStore = useUserStore()

onMounted(() => {
  $(document).ready(function () {
    $('body').click(function (e) {
      if ($('.sidebar-small').length) {
        collapse(e)
      }
    })

    setTimeout(() => {
      $('.router-link-active')
        .closest('.btn-toggle-list')
        .siblings('.btn-toggle')
        .addClass('collapsed')

      $('.router-link-active').closest('.btn-toggle-list').slideToggle()
    }, 500)
  })
})

function collapse(e) {
  close(e)
  $(e.currentTarget).toggleClass('collapsed')
  $(e.currentTarget.nextElementSibling).slideToggle()
}



function close(e) {
  $('.btn-toggle-list').each(function (index) {
    const that = $(this)
    if (this !== e.currentTarget.nextElementSibling) {
      that.siblings().removeClass('collapsed')
      that.slideUp({duration: 200,})
    }
  })
}

function collapseClick(e) {
  e.stopPropagation()
  if (!$('.sidebar-small').length) {
    collapse(e)
  }
}

function collapseHoverEnter(e) {
  e.stopPropagation()
  if ($('.sidebar-small').length) {
    if (! $(e.currentTarget).hasClass('collapsed')) {
        collapse(e)
    }
  }
}

function collapseHoverExit(e) {
  e.stopPropagation()
  if ($('.sidebar-small').length) {
    close(e)
  }
}
</script>

<style scoped>
.sidebar-small .admin-logo {
    display: none;
}
</style>