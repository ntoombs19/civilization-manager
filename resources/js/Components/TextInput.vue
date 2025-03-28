<script setup lang="ts">
import { onMounted, ref } from 'vue';

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input
        class="rounded-md bg-stone-800/70 border-amber-900 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-amber-100 placeholder-amber-400/50"
        v-model="model"
        ref="input"
    />
</template>
