<script setup lang="ts">
defineProps<{
    title?: string;
    subtitle?: string;
}>();
</script>

<template>
    <div class="bg-stone-900/50 rounded-lg p-6 border border-amber-800/30">
        <h3 v-if="title" class="text-xl font-semibold text-amber-300 mb-4">{{ title }}</h3>
        <slot></slot>
    </div>
</template> 