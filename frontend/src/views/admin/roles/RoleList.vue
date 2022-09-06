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
            <tr v-for="role in roles.value" :key="role.id">
              <td>{{ role.id }}</td>
              <td>{{ role.name }}</td>
              <td>
                <router-link class="btn-sm btn-warning" :to="{ name: 'admin-roles-edit', params: {id:role.id} }"
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
import RoleRepository from '@/repositories/roleRepository'

const roles = ref([])

onBeforeMount(async () => {
    roles.value = ref(await RoleRepository.all())
})

</script>
