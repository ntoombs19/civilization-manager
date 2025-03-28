<script setup lang="ts">
defineProps<{
    value?: string;
}>();
</script>

<template>
    <label class="block text-sm font-medium text-amber-300 uppercase tracking-wider">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
