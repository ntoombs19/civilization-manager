<script setup lang="ts">
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
  center: 'text-center mx-auto',
  right: 'text-right ml-auto'
};
</script>

<style scoped>
.divider-cap {
    @apply absolute top-1/2 -translate-y-1/2 text-amber-600 text-2xl;
}
</style>

<template>
  <div class="max-w-7xl mx-auto mb-16" :class="alignmentClasses[align]">
    <h1>
      {{ title }}
    </h1>

    <p v-if="subtitle" class="text-lg max-w-3xl mx-auto text-amber-100/80 mb-8 leading-relaxed" :class="alignmentClasses[align]">
      {{ subtitle }}
    </p>

    <div v-if="divider" class="h-[3px] bg-gradient-to-r from-transparent via-amber-600 to-transparent w-1/2 mb-10 relative" :class="alignmentClasses[align]">
      <span class="divider-cap -left-2.5">•</span>
      <span class="divider-cap -right-2.5">•</span>
    </div>

    <slot></slot>
  </div>
</template>
