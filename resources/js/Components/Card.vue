<script setup lang="ts">
import { computed } from 'vue';

interface Props {
  variant?: 'primary';
  hover?: boolean;
  border?: boolean;
  shadow?: boolean;
  rounded?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  variant: 'primary',
  hover: true,
  border: true,
  shadow: true,
  rounded: true
});

const wrapperClasses = computed(() => {
  return [
    'relative overflow-hidden',
    props.hover ? 'transform-gpu hover:scale-105 transition-all duration-500' : '',
    props.shadow ? 'shadow-xl shadow-black/50' : '',
    props.rounded ? 'rounded-lg' : '',
    'group'
  ].join(' ');
});

const cardClasses = computed(() => {
  const base = 'relative h-full flex flex-col overflow-hidden max-w-xl';

  const variantClasses = {
    primary: 'bg-gradient-to-br from-amber-900 to-stone-900',
  };

  const borderClass = props.border ? 'border border-amber-800/40' : '';

  const roundedClass = props.rounded ? 'rounded-lg' : '';

  return [
    base,
    variantClasses[props.variant],
    borderClass,
    roundedClass
  ].join(' ');
});
</script>

<template>
  <div :class="wrapperClasses">
    <div :class="cardClasses">
      <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-700 via-amber-400 to-amber-700"></div>
      <slot></slot>
    </div>
  </div>
</template>
