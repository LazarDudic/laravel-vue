<template>
  <div class="form-group" :class="[required ? 'required' : '']" >
    <label>{{ label }}</label>
    <div class="w-100">
      <select
        @input="$emit('update:' + name, $event.target.value)"
        class="form-select"
        :disabled="disabled"
      >
      <option class="text-secondary" value="">Choose option...</option>
        <option
          v-for="(sv, index) in selectValues"
          :key="name+index"
          :value="sv.id"
          :selected="sv.id == props.value"
          @change="valueChanged"
        >
          {{ sv.name }}
        </option>
      </select>
    </div>
  </div>
</template>

<script setup>
const emit = defineEmits()

const props = defineProps([
  'selectValues',
  'label',
  'name',
  'value',
  'required',
  'disabled'
])
const selectValues = props.selectValues //selectValues must have name attribute 
const label = props.label
const name = props.name
const required = props.required
const disabled = props.disabled

</script>
