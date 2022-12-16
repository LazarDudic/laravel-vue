<template>
  <div 
    class="form-group"
    :class="[required ? 'required': '']"
  >
    <label>{{ label }}</label>
    <div class="w-100">
        <input 
            :type="type" 
            :value="props.value"
            @input="$emit('update:'+name, $event.target.value)"
            class="form-control" 
            :disabled="props.disabled"
        />
    </div>
  </div>
</template>

<script setup>

const props = defineProps(['type', 'label', 'name', 'value', 'required', 'disabled'])
const type = props.type ?? 'text'
const label = props.label 
const name = props.name
const required = props.required
const disabled = props.disabled

</script>
