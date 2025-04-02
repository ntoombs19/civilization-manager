<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref, watch } from 'vue';
import { PageProps as InertiaPageProps } from '@/types';

interface PageProps extends InertiaPageProps {
    flash: {
        success: string | null;
        error: string | null;
    };
}

const page = usePage<PageProps>();
const show = ref(false);
const timeout = ref<number | null>(null);

const flash = computed(() => {
    return {
        success: page.props.flash.success,
        error: page.props.flash.error,
    };
});

const close = () => {
    show.value = false;
    if (timeout.value) {
        clearTimeout(timeout.value);
        timeout.value = null;
    }
};

watch(
    () => [flash.value.success, flash.value.error],
    () => {
        if (flash.value.success || flash.value.error) {
            show.value = true;
            if (timeout.value) {
                clearTimeout(timeout.value);
            }
            timeout.value = window.setTimeout(() => {
                show.value = false;
                timeout.value = null;
            }, 5000);
        }
    },
    { immediate: true }
);

onMounted(() => {
    if (flash.value.success || flash.value.error) {
        show.value = true;
        timeout.value = window.setTimeout(() => {
            show.value = false;
            timeout.value = null;
        }, 5000);
    }
});
</script>

<template>
    <div
        v-if="show"
        class="fixed right-4 top-4 z-50 max-w-md transform rounded-lg p-4 shadow-lg transition-transform duration-300"
        :class="{
            'bg-green-900/90 text-green-100': flash.success,
            'bg-red-900/90 text-red-100': flash.error,
        }"
    >
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg
                    v-if="flash.success"
                    class="h-6 w-6 text-green-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>
                <svg
                    v-if="flash.error"
                    class="h-6 w-6 text-red-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-base font-medium">
                    {{ flash.success || flash.error }}
                </p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button
                        @click="close"
                        class="inline-flex rounded-md p-1.5 transition-colors duration-300"
                        :class="{
                            'text-green-300 hover:bg-green-800 hover:text-green-200':
                                flash.success,
                            'text-red-300 hover:bg-red-800 hover:text-red-200':
                                flash.error,
                        }"
                    >
                        <span class="sr-only">Dismiss</span>
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template> 