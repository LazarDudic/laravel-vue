<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>News List</span>
      </a>
    </div>
    <h2 class="page-title">News List</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">News List</h2>
        <p class="content-description">Description news list</p>
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
                <th>Language</th>
                <th>Lang Group</th>
                <th>Status</th>
                <th>Image</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'
import router from '@/router/index.js'
import $ from 'jquery'
import 'datatables.net-bs5'
import { useLoadingStore, useLanguageStore } from '@/stores'
import NewsRepository from '@/repositories/newsRepository'
import { responseIsOK } from '@/helpers/helper'
import { storeToRefs } from 'pinia'
const emit = defineEmits()

var table = null
const { selectedLanguage } = storeToRefs(useLanguageStore())
const langID = selectedLanguage.value ? selectedLanguage.value.id : '';

onMounted(() => {
  var tables = $.fn.dataTable.fnTables(true);

$('#DFtable').DataTable().clear().destroy();
  $(tables).each(function () {
    alert(1)
      $(this).dataTable().fnDestroy();
  });
  createTable()
  $(document).on('click', "[data-bs-toggle='tooltip']", function () {
    $('.tooltip').remove()
  })
})

const createTable = () => {
  const loadingStore = useLoadingStore()
  loadingStore.setLoading(true)

  table = $('#DFtable').DataTable({
    // processing: true,
    serverSide: true,
    stateSave: true,
    order: [[0, 'desc']],
    ajax: {
      url: process.env.VUE_APP_API_URL + '/news/datatable-news/' + langID,
      beforeSend: function (xhr) {
        xhr.setRequestHeader(
          'Authorization',
          localStorage.getItem('auth_token')
        )
      }
    },
    columns: [
      { data: 'id', name: 'id' },
      { data: 'title', name: 'title' },
      { data: 'language', name: 'language' },
      { data: 'lang_groups', name: 'lang_groups' },
      { data: 'status', name: 'status' },
      { data: 'image_path', name: 'image_id' },
      { data: 'category_title', name: 'category_title' },
      { data: 'created_at', name: 'created_at' },
      { data: 'updated_at', name: 'updated_at' },
      { data: 'id', name: 'id' }
    ],
    columnDefs: [
      {
        targets: [-1],
        render: function (data, type, row, meta) {
          return `<div class="table-action">
          <a data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="text-primary" href=""><i class="far fa-eye"></i></a>
          <a data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="route-edit text-warning" data-id="${data}"><i class="fas fa-edit"></i></a>
          <a data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="delete-model text-danger" data-id="${data}"  href="#"><i class="fas fa-trash-alt"></i></a>
          </div>`
        }
      }
    ]
  })

  $('#DFtable').on('init.dt', function () {
    loadingStore.setLoading(false)
  })


  $(document).off('click')
  $(document).on('click')

  $(document).on('click', '.delete-model', function (e) {
    e.stopPropagation()
    deleteModel($(this).data('id'))
  })
  $(document).on('click', '.route-edit', function (e) {
    e.stopPropagation()
    router.push({ name: 'admin-news-edit', params: { id: $(this).data('id') } })
  })
  $(document).on('click', '.news-language', function (e) {
    e.stopPropagation()
    router.push({ name: 'admin-news-create-or-edit', params: {
      groupId: $(this).data('lang_group_id'),
      langId: $(this).data('lang_id'),
    }})
  })
}

const deleteModel = async (id) => {
  if (confirm('Are you sure?')) {
    const res = await NewsRepository.delete(id)
    if (responseIsOK(res)) {
      table.ajax.reload()
    }
  }
}
const destroyTable = () => {
  table.clear().destroy()
  $('#DFtable tbody').empty()
}

const redirect = (view, params) => {
}

onBeforeUnmount(() => {
  // You must destroy serverside render table on leave
  destroyTable()
})
</script>
