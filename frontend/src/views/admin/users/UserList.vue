<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Users List</span>
      </a>
    </div>
    <h2 class="page-title">Users List</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Users List</h2>
        <p class="content-description">Description users list</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <div class="card table-responsive">
          <table id="DFtable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
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
import { useLoadingStore } from '@/stores'
import UserRepository from '@/repositories/userRepository'
import { responseIsOK } from '@/helpers/helper'
const emit = defineEmits()

var table = null
onMounted(() => {
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
      url: process.env.VUE_APP_API_URL + '/users/datatable-users',
      beforeSend: function (xhr) {
        xhr.setRequestHeader(
          'Authorization',
          localStorage.getItem('auth_token')
        )
      }
    },
    columns: [
      { data: 'id', name: 'id' },
      { data: 'first_name', name: 'first_name' },
      { data: 'last_name', name: 'last_name' },
      { data: 'email', name: 'email' },
      { data: 'role.name', name: 'role.name' },
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
    redirect($(this).data('id'))
  })
}

const deleteModel = async (id) => {
  if (confirm('Are you sure?')) {
    const res = await UserRepository.delete(id)
    if (responseIsOK(res)) {
      table.ajax.reload()
    }
  }
}
const destroyTable = () => {
  table.clear().destroy()
  $('#DFtable tbody').empty()
}

const redirect = (id, view = 'edit') => {
  router.push({ name: 'admin-users-' + view, params: { id: id } })
}

onBeforeUnmount(() => {
  // You must destroy serverside render table on leave
  destroyTable()
})
</script>
