<template>
  <div 
    class="form-group"
    :class="[required ? 'required': '']"
  >
    <label>{{ label }}</label>
    <div class="w-100">
        <textarea  
            class="form-control" 
            :value="props.value"
            @input="$emit('update:'+name, $event.target.value)"
            :disabled="disabled"
            :rows="rows"
        >
        </textarea>
    </div>
  </div>
</template>

<script setup>
const props = defineProps(['label', 'name', 'value', 'required', 'disabled', 'rows'])
const label = props.label 
const name = props.name
const required = props.required
const disabled = props.disabled
const rows = props.rows ?? 4
</script>
