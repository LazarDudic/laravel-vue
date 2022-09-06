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
            id="DFtableNoDatatable"
            class="table table-striped table-bordered"
            style="width: 100%"
          >
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <tr v-for="permission in permissions.value" :key="permission.id">
              <td>{{ permission.id }}</td>
              <td>{{ permission.name }}</td>
              <td>
                <router-link class="btn-sm btn-warning" :to="{ name: 'admin-permissions-edit', params: {id:permission.id} }"
                        >Edit</router-link>
                </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>
<script setup>
import { onBeforeMount, ref } from 'vue'
import DataTable from 'datatables.net-bs5'
import PermissionRepository from '@/repositories/permissionRepository'
const permissions = ref([])
onBeforeMount(async () => {
    permissions.value = ref(await PermissionRepository.all())
})

</script>
