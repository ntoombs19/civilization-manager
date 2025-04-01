<script setup lang="ts">
defineProps<{
    text: string;
}>();
</script>

<template>
    <span class="rounded-full bg-stone-800/50 px-3 py-1 text-sm text-amber-300">
        {{ text }}
    </span>
</template>
