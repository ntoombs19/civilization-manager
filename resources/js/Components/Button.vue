<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Props {
  href?: string;
  type?: 'button' | 'submit' | 'reset';
  variant?: 'primary' | 'secondary' | 'outline';
  size?: 'sm' | 'md' | 'lg';
  fullWidth?: boolean;
  disabled?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
  type: 'button',
  variant: 'primary',
  size: 'md',
  fullWidth: false,
  disabled: false
});

const classes = computed(() => {
  const base = 'relative inline-flex items-center justify-center font-semibold rounded border transition-all duration-300 uppercase tracking-wider relative overflow-hidden hover:text-stone-900';

  const widthClass = props.fullWidth ? 'w-full' : '';

  const sizeClasses = {
    sm: 'px-4 py-1.5 text-xs',
    md: 'px-6 py-2 text-sm',
    lg: 'px-8 py-3 text-base'
  };

  const variantClasses = {
    primary: 'bg-gradient-to-b from-amber-500 to-amber-700 text-stone-900 border-amber-300 hover:from-amber-400 hover:to-amber-600 hover:shadow-lg hover:shadow-amber-600/40 hover:-translate-y-0.5',
    secondary: 'bg-gradient-to-b from-amber-700 to-amber-900 text-amber-100 border-amber-600 hover:from-amber-600 hover:to-amber-800 hover:shadow-lg hover:shadow-amber-700/30 hover:-translate-y-0.5',
    outline: 'bg-transparent border-amber-600 text-amber-400 hover:bg-amber-900/30 hover:text-amber-300 hover:border-amber-400 hover:-translate-y-0.5'
  };

  const disabledClasses = props.disabled
    ? 'opacity-50 cursor-not-allowed pointer-events-none'
    : '';

  return [
    base,
    widthClass,
    sizeClasses[props.size],
    variantClasses[props.variant],
    disabledClasses
  ].join(' ');
});
</script>

<template>
  <Link v-if="href" :href="href" :class="classes">
    <span class="relative z-10">
      <slot></slot>
    </span>
  </Link>

  <button v-else :type="type" :disabled="disabled" :class="classes">
    <span class="relative z-10">
      <slot></slot>
    </span>
  </button>
</template>
