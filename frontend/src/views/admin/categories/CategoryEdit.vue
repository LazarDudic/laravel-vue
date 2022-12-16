<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-categories-list' }"
        >Categories</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Edit</span>
      </a>
    </div>
    <h2 class="page-title">Category Edit</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Category Edit</h2>
        <p class="content-description">description category edit</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form id="df-form" v-if="Object.entries(input).length">
          <Select
            v-if="languages.data.length"
            label="Language"
            name="lang_id"
            :value="input.lang_id"
            :selectValues="languages.data"
            :disabled="true"
          />
          <InputError :errors="errors?.lang_id" />

          <Radio
            label="Type"
            :labels="['Blog', 'News']"
            :values="['blog', 'news']"
            name="type"
            :value="input.type"
            :disabled="true"
          />
          <InputError :errors="errors?.type" />

          <Select
            v-if="categories.data.length"
            label="Parent Category"
            name="parent_id"
            :value="input.parent_id"
            :selectValues="categories.data"
            @update:parent_id="(newValue) => (input.parent_id = newValue)"
          />
          <InputError :errors="errors?.parent_id" />

          <Input
            label="Title"
            name="title"
            :value="input.title"
            @update:title="(newValue) => (input.title = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.title" />

          <div class="form-group">
            <label>Image</label>
            <FileUpload
              fieldName="image_id"
              :fileId="input.image_id"
              @fileSelected="fileSelected"
              @fileUnselected="fileUnselected"
            />
          </div>
          <InputError :errors="errors?.image_id" />

          <div class="d-flex">
            <CancelButton redirect="admin-categories-list" />
            <SubmitButton @formSubmited="formSubmited" name="Update" />
          </div>
        </form>
      </div>
    </div>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Children Category List</h2>
        <p class="content-description">Description category list</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />

      <div class="content-body" >
        <div class="card table-responsive" v-if="children.data.length">
          <table id="DFtable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="childCat in children.data" :key="childCat.id">
                <td>{{ childCat.id }}</td>
                <td>{{ childCat.title }}</td>
                <td>{{ childCat.type }}</td>
                <td>
                  <img
                    v-if="childCat.image"
                    :src="childCat.image.path"
                    :alt="childCat.image.alt"
                    height="70"
                  />
                </td>
                <td>{{ childCat.created_at }}</td>
                <td>{{ childCat.updated_at }}</td>
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
                        params: { id: childCat.id }
                      }"
                      ><i class="fas fa-edit"></i
                    ></router-link>
                    <a
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      title="Delete"
                      class="text-danger"
                      @click.prevent="deleteChild(childCat.id)"
                      ><i class="fas fa-trash-alt"></i
                    ></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <button class="btn btn-primary" @click="addChildren = !addChildren">
          {{ addChildren ? 'Hide' : 'Add Child' }}
        </button>
        <div class="content-body">
          <form id="df-form" v-if="addChildren">
            <Input
              label="Title"
              name="title"
              :value="childInput.title"
              @update:title="(newValue) => (childInput.title = newValue)"
              :required="true"
            />
            <InputError :errors="errors?.title" />

            <div class="form-group">
              <label>Image</label>
              <FileUpload
                fieldName="image_id"
                :fileId="childInput.image_id"
                @fileSelected="childFileSelected"
                @fileUnselected="childFileUnselected"
              />
            </div>
            <InputError :errors="errors?.image_id" />

            <div class="d-flex">
              <CancelButton redirect="admin-categories-list" />
              <SubmitButton @formSubmited="createChild" name="Create" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, onBeforeMount } from 'vue'
import { useAlertsStore } from '@/stores'
import { useRoute } from 'vue-router'
import { storeToRefs } from 'pinia'
import CategoryRepository from '@/repositories/categoryRepository'
import LanguageRepository from '@/repositories/languageRepository'
import router from '@/router/index.js'
import FileUpload from '@/components/df_files/FileUpload'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
import {Input,Select,InputError,SubmitButton,Radio,CancelButton} from '@/components/form'
const emit = defineEmits()
const route = useRoute()
const input = reactive({})
const childInput = reactive({})
const categoryId = route.params.id
const languages = reactive({ data: [] })
const children = reactive({ data: [] })
const categories = reactive({ data: [] })
const addChildren = ref(false)

onBeforeMount(async () => {
  Object.assign(input, await CategoryRepository.findById(categoryId))
  children.data = await CategoryRepository.getChildren(categoryId)
  languages.data = await LanguageRepository.all()
  getParentCategories()
  setChildInput()
})

const getParentCategories = async () => {
  if (input.type && input.lang_id) {
    categories.data = await CategoryRepository.allByLanguageIdAndType(
      input.lang_id,
      input.type,
      input.id
    )
  }
}

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  const formData = getFormData(input)
  const res = await CategoryRepository.update(formData, categoryId)
}

const fileSelected = (data) => {
  input[data.fieldName] = data.fileId
}

const fileUnselected = (fieldName) => {
  input[fieldName] = null
}

const createChild = async () => {
  const formData = getFormData(childInput)
  const res = await CategoryRepository.store(formData)
  if (responseIsOK(res)) {
    setChildInput()
    addChildren.value = false
    children.data = await CategoryRepository.getChildren(categoryId)
  }
}

const setChildInput = () => {
  const setChild = {
    lang_id: input.lang_id,
    type: input.type,
    parent_id: input.id,
    lang_group_id: null,
    title: null,
    image_id: null
  }
  Object.assign(childInput, setChild)
}

const childFileSelected = (data) => {
  childInput[data.fieldName] = data.fileId
}

const childFileUnselected = (fieldName) => {
  childInput[fieldName] = null
}

const deleteChild = async (childId) => {
  if (confirm('Are you sure?')) {
    const res = await CategoryRepository.delete(childId)

    if (responseIsOK(res)) {
      children.data = await CategoryRepository.getChildren(categoryId)
    }
  }
}
</script>
