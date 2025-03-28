<script setup lang="ts">
import Divider from "@/Components/Divider.vue";

interface Props {
  title: string;
  subtitle?: string;
  align?: 'left' | 'center' | 'right';
  divider?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  subtitle: '',
  align: 'center',
  divider: true
});

const alignmentClasses = {
  left: 'text-left',
  center: '',
  right: 'text-right ml-auto'
};
</script>
<template>
  <div class="max-w-7xl mx-auto mb-16 text-center">
    <h1>
      {{ title }}
    </h1>

    <p v-if="subtitle" class="text-lg max-w-3xl mx-auto text-amber-100/80 mb-8 leading-relaxed text-center">
      {{ subtitle }}
    </p>

    <Divider v-if="divider" class="mb-8" />

    <slot></slot>
  </div>
</template>
