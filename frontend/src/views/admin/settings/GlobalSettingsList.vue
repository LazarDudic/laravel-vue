<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Global Settings List</span>
      </a>
    </div>
    <h2 class="page-title">Global Settings List</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Global Settings List</h2>
        <p class="content-description">Description Global Settings list</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <div class="card table-responsive">
          <table id="DFtable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Language</th>
                <th>Lang Group</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody v-if="globalSettings.data.length">
              <tr v-for="settings in globalSettings.data" :key="settings.id">
                <td>{{ settings.id }}</td>
                <td>{{ settings.sitename }}</td>
                <td>{{ settings.language.title }}</td>
                <td>
                  <span v-for="language in languages"> 
                    <a  v-if="language.id !== settings.lang_id" href="" class="me-2">{{ language.html_lang }}</a>
                  </span>
                </td>
                <td>
                  <div class="table-action">
                    <router-link
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Edit"
                      class="text-warning"
                      :to="{
                        name: 'admin-global-settings-edit',
                        params: { id: settings.id }
                      }"
                      ><i class="fas fa-edit"></i>
                    </router-link>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { onBeforeMount, onMounted, reactive } from 'vue'
import GlobalSettingsRepository from '@/repositories/globalSettingsRepository'
import $ from 'jquery'
import 'datatables.net-bs5'
import { Tooltip } from 'bootstrap'
import { useLanguageStore } from '@/stores'
import { storeToRefs } from 'pinia'
const emit = defineEmits()
const { languages } = storeToRefs(useLanguageStore())

const globalSettings = reactive({ data: [] })

onMounted(async () => {
  $(document).on('click', "[data-bs-toggle='tooltip']", function () {
    $('.tooltip').remove()
  })
})

onBeforeMount(async () => {
  globalSettings.data = await GlobalSettingsRepository.all()

  $(document).ready(function () {
    $('#DFtable').DataTable({
      processing: true,
      stateSave: true,
      
    })
  })
})
</script>
