<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <div v-show="message">
        <p class="font-serif text-sm text-red-400">
            {{ message }}
        </p>
    </div>
</template>
