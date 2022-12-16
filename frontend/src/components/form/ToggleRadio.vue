<template>
  <div class="form-group" :class="[required ? 'required' : '']">
    <label>{{ label }}</label>
    <div class="w-100 d-flex">
      <div v-for="(lab, index) in labels" :key="index" >
        <input
          class="btn-check"
          type="radio"
          :name="name"
          :value="values[index]"
          :id="lab + index"
          @input="$emit('update:' + name, $event.target.value)"
          :checked="props.value === values[index]"
        />
        <label class="btn btn-toggle-radio" :for="lab + index">
          {{ lab }}
        </label>
      </div>
    </div>
    
  </div>
</template>

<script setup>
const props = defineProps([
  'label',
  'labels',
  'values',
  'name',
  'value',
  'required'
])
const type = props.type ?? 'text'
const label = props.label
const labels = props.labels
const values = props.values
const name = props.name
const required = props.required
</script>
