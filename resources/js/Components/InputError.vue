<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red-400 font-serif">
            {{ message }}
        </p>
    </div>
</template>
