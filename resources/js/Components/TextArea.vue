<script setup lang="ts">
import { onMounted, ref } from 'vue';

const model = defineModel<string>({ required: true });

const textarea = ref<HTMLTextAreaElement | null>(null);

onMounted(() => {
    if (textarea.value?.hasAttribute('autofocus')) {
        textarea.value?.focus();
    }
});

defineExpose({ focus: () => textarea.value?.focus() });
</script>

<template>
    <textarea
        class="rounded-md bg-stone-800/70 border-amber-900 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-amber-100 placeholder-amber-400/50"
        v-model="model"
        ref="textarea"
    ></textarea>
</template> 