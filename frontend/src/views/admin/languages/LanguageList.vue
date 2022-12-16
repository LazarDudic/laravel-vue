<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Language List</span>
      </a>
    </div>
    <h2 class="page-title">Language List</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Language List</h2>
        <p class="content-description">Description Language list</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <div class="card table-responsive">
          <table id="DFtable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Lang Code</th>
                <th>Url Prefix</th>
                <th>Html Lang</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody v-if="languages.data.length">
              <tr v-for="language in languages.data" :key="language.id">
                <td>{{ language.id }}</td>
                <td>{{ language.title }}</td>
                <td>{{ language.status }}</td>
                <td>{{ language.lang_code }}</td>
                <td>{{ language.url_prefix }}</td>
                <td>{{ language.html_lang }}</td>
                <td>
                  <div class="table-action">
                    <a
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="View"
                      class="text-primary"
                      ><i class="far fa-eye"></i
                    ></a>
                    <router-link
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Edit"
                      data-trigger="hover"
                      class="text-warning"
                      :to="{
                        name: 'admin-languages-edit',
                        params: { id: language.id }
                      }"
                      ><i class="fas fa-edit"></i
                    ></router-link>
                    <a
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Delete"
                      @click.prevent="deleteModel(language.id)"
                      class="text-danger"
                      ><i class="fas fa-trash-alt"></i
                    ></a>
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
import { onMounted, reactive, ref } from 'vue'
import LanguageRepository from '@/repositories/languageRepository'
import 'datatables.net-bs5'
import $ from 'jquery'
import { responseIsOK } from '@/helpers/helper'
import { Tooltip } from 'bootstrap'
const emit = defineEmits()
const languages = reactive({ data: [] })
var table = null

onMounted(async () => {
  await getLanguages()
  createTable()
  $(document).on('click', "[data-bs-toggle='tooltip']", function () {
    $('.tooltip').remove()
  })
})

const getLanguages = async (id) => {
  languages.data = await LanguageRepository.all()
}

const createTable = async (id) => {
  $(document).ready(function () {
    table = $('#DFtable').DataTable({
      processing: true,
      stateSave: true
    })
  })
}

const deleteModel = async (id) => {
  if (confirm('Are you sure?')) {
    const res = await LanguageRepository.delete(id)
    if (responseIsOK(res)) {
      emit('rerenderContent')
    }
  }
}
</script>
