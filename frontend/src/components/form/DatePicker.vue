<template>
  <div 
    class="form-group"
    :class="[required ? 'required': '']"
  >
    <label>{{ label }}</label>
        <input 
            type="date" 
            class="form-control" 
            :value="props.value"
            @input="$emit('update:'+name, $event.target.value)"
            :disabled="props.disabled"
        />
  </div>
</template>

<script setup>
const props = defineProps(['label', 'name', 'value', 'required', 'disabled'])
const label = props.label 
const name = props.name
const required = props.required
const disabled = props.disabled
</script>
