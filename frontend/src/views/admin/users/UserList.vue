<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
      <div class="chartjs-size-monitor-expand"><div class=""></div></div>
      <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
    </div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">User List</h1>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <table
            id="DFtable"
            class="table table-striped table-bordered"
            style="width: 100%"
          >
            <thead>
              <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>
<script setup>
import { onUnmounted, onMounted, storeToRefs } from 'vue'
import $ from 'jquery'
import DataTable from 'datatables.net-bs5'
import { useLoadingStore } from '@/stores'

var table = null
onMounted(() => {
  const loadingStore = useLoadingStore()
  loadingStore.setLoading(true)

  $.noConflict()
  table = $('#DFtable').DataTable({
    processing: true,
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
      { data: 'id', name: 'id' }
    ],
    columnDefs: [
      {
        targets: [-1],
        render: function (data, type, row, meta) {
          return `<a class="btn-sm btn-warning" href="/admin/users/edit/${data}">Edit</a>`
        }
      }
    ]
  })

  $('#DFtable').on('init.dt', function () {
    loadingStore.setLoading(false)
  })
})

onUnmounted(() => {
  // You must destroy table on leave
  table.clear().destroy()
  $('#DFtable tbody').empty()
})
</script>
