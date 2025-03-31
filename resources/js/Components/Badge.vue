<script setup lang="ts">
defineProps<{
    text: string;
}>();
</script>

<template>
    <span class="px-3 py-1 bg-stone-800/50 rounded-full text-amber-300 text-sm">
        {{ text }}
    </span>
</template> 