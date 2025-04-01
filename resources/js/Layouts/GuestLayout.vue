<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const appName = computed(() => page.props.appName || 'Civilization Manager');
</script>

<template>
    <div
        class="flex min-h-screen flex-col bg-gradient-to-b from-stone-900 to-stone-800 font-serif"
    >
        <div
            class="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0"
        >
            <div class="mb-6">
                <Link :href="route('home')" class="flex items-center">
                    <ApplicationLogo />
                    <div
                        class="mt-1 font-serif text-xl uppercase tracking-wider text-white transition-colors duration-300 hover:text-amber-400"
                    >
                        {{ appName }}
                    </div>
                </Link>
            </div>

            <div
                class="w-full overflow-hidden border border-amber-800/40 bg-gradient-to-br from-amber-900 to-stone-900 px-6 py-6 shadow-xl shadow-black/30 sm:max-w-md sm:rounded-lg"
            >
                <div
                    class="absolute left-0 right-0 top-0 h-1.5 bg-gradient-to-r from-amber-700 via-amber-400 to-amber-700"
                ></div>
                <slot />
            </div>

            <div class="mt-8 text-center text-sm text-amber-100/50">
                &copy; {{ new Date().getFullYear() }} Civilization Manager. All
                rights reserved.
            </div>
        </div>
    </div>
</template>
