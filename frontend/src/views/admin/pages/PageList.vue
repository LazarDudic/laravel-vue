<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Pages List</span>
      </a>
    </div>
    <h2 class="page-title">Pages List</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Pages List</h2>
        <p class="content-description">Description Pages list</p>
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
                <th>Route</th>
                <th>Language</th>
                <th>Lang Group</th>
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
import PageRepository from '@/repositories/pageRepository'
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
      url: process.env.VUE_APP_API_URL + '/pages/datatable-pages/' + langID,
      beforeSend: function (xhr) {
        xhr.setRequestHeader(
          'Authorization',
          localStorage.getItem('auth_token')
        )
      }
    },
    columns: [
      { data: 'id', name: 'id' },
      { data: 'title', orderable: false},
      { data: 'route', name: 'route' },
      { data: 'language', name: 'language' },
      { data: 'lang_groups', name: 'lang_groups' },
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
    router.push({ name: 'admin-pages-edit', params: { id: $(this).data('id') } })
  })
  $(document).on('click', '.page-language', function (e) {
    e.stopPropagation()
    router.push({ name: 'admin-pages-create-or-edit', params: {
      groupId: $(this).data('lang_group_id'),
      langId: $(this).data('lang_id'),
    }})
  })
}

const deleteModel = async (id) => {
  if (confirm('Are you sure?')) {
    const res = await PageRepository.delete(id)
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
