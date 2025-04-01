<script>
export default {
    props: {
        modelValue: {
            type: [String, Number],
            default: null
        },
        options: {
            type: Array,
            required: true
        },
        id: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        customClass: {
            type: String,
            default: ''
        }
    },
    emits: ['update:modelValue']
}
</script>

<template>
  <select
    :id="id"
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
    class="block w-full rounded-md bg-stone-800/70 border-amber-900 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-amber-100"
    :class="customClass"
    :required="required"
    :disabled="disabled"
  >
    <option v-if="placeholder" value="" disabled>{{ placeholder }}</option>
    <option v-for="option in options" :key="option.value || option.id" :value="option.value || option.id">
      {{ option.label || option.name }}
    </option>
  </select>
</template>
