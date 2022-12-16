<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Category List</span>
      </a>
    </div>
    <h2 class="page-title">Category List</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Category List</h2>
        <p class="content-description">Description category list</p>
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
                <th>Type</th>
                <th>Parent</th>
                <th>Language</th>
                <th>Lang Group</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody v-if="categories.data.length">
              <tr v-for="category in categories.data" :key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.title }}</td>
                <td>{{ category.type }}</td>
                <td>
                    <router-link
                        v-if="category.parent"
                      class="text-primary"
                      :to="{
                        name: 'admin-categories-edit',
                        params: { id: category.parent.id }
                      }"
                      >{{ category.parent.title }}</router-link></td>
                <td>{{ category.language.title }}</td>
                <td>
                  <span v-for="language in languages">
                    <router-link
                        v-if="language.id !== category.lang_id"
                      class="text-primary"
                      :to="{
                        name: 'admin-categories-create-or-edit',
                        params: { groupId: category.lang_group_id, langId: language.id, type: category.type }
                      }"
                      >{{ language.html_lang }}
                    </router-link>
                  </span>
                </td>
                <td>
                  <img
                    v-if="category.image"
                    :src="category.image.path"
                    :alt="category.image.alt"
                    height="70"
                  />
                </td>
                <td>{{ category.created_at }}</td>
                <td>{{ category.updated_at }}</td>
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
                      class="text-warning"
                      :to="{
                        name: 'admin-categories-edit',
                        params: { id: category.id }
                      }"
                      ><i class="fas fa-edit"></i
                    ></router-link>
                    <a
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Delete"
                      class="text-danger"
                      @click.prevent="deleteModel(category.id)"
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
import { onMounted, reactive } from 'vue'
import CategoryRepository from '@/repositories/categoryRepository'
import $ from 'jquery'
import 'datatables.net-bs5'
import { responseIsOK } from '@/helpers/helper'
import { useLanguageStore } from '@/stores'
import { storeToRefs } from 'pinia'
const emit = defineEmits()

const { languages } = storeToRefs(useLanguageStore())
const categories = reactive({ data: [] })

onMounted(async () => {
  await getCategories()
  createTable()
  $(document).on('click', "[data-bs-toggle='tooltip']", function () {
    $('.tooltip').remove()
  })
})

const getCategories = async () => {
  categories.data = await CategoryRepository.all()
}

const createTable = () => {
  $(document).ready(function () {
    $('#DFtable').DataTable({
      processing: true,
      stateSave: true
    })
  })
}

const deleteModel = async (id) => {
  if (confirm('Are you sure?')) {
    const res = await CategoryRepository.delete(id)
    if (responseIsOK(res)) {
        getCategories()
    }
  }
}
</script>
