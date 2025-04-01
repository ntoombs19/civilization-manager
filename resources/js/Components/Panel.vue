<script setup lang="ts">
defineProps<{
    title?: string;
    subtitle?: string;
}>();
</script>

<template>
    <div class="rounded-lg border border-amber-800/30 bg-stone-900/50 p-6">
        <h3 v-if="title" class="mb-4 text-xl font-semibold text-amber-300">
            {{ title }}
        </h3>
        <slot></slot>
    </div>
</template>
