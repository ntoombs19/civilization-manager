<script setup lang="ts">
import Divider from '@/Components/Divider.vue';

interface Props {
    title: string;
    subtitle?: string;
}

withDefaults(defineProps<Props>(), {
    subtitle: '',
    align: 'center',
});
</script>
<template>
    <div class="mx-auto mb-16 max-w-7xl text-center">
        <h1>
            {{ title }}
        </h1>

        <p
            v-if="subtitle"
            class="mx-auto mb-8 max-w-3xl text-center text-lg leading-relaxed text-amber-100/80"
        >
            {{ subtitle }}
        </p>

        <Divider class="mb-8" />

        <slot></slot>
    </div>
</template>
