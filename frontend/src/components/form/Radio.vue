<template>
  <div class="form-group" :class="[required ? 'required' : '']">
    <label id="">{{ label }}</label>
    <div class="w-100">
      <div v-for="(lab, index) in labels" :key="index" class="form-check">
        <input
          class="form-check-input"
          type="radio"
          :name="name"
          :value="values[index]"
          :id="name + lab"
          @input="$emit('update:' + name, $event.target.value)"
          :checked="props.value == values[index]"
          :disabled="props.disabled"
        />
        <label class="form-check-label" :for="name + lab">
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
  'required',
  'disabled'
])
const type = props.type ?? 'text'
const label = props.label
const labels = props.labels
const values = props.values
const name = props.name
const required = props.required
</script>
