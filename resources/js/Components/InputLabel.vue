<script setup lang="ts">
defineProps<{
    value?: string;
}>();
</script>

<template>
    <label
        class="block text-sm font-medium uppercase tracking-wider text-amber-300"
    >
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
