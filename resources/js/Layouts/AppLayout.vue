<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const page = usePage();
const appName = computed(() => page.props.appName || 'Civilization Manager');
</script>

<style scoped>
    .header-link {
        @apply px-3 py-2 rounded-md text-sm font-medium font-serif uppercase tracking-wider transition-colors duration-300 flex-1 text-center;
        &.current {
            @apply bg-amber-900/20 text-amber-400
        }
    }

    .footer-link {
        @apply text-amber-100/70 hover:text-amber-400 transition-colors duration-300
    }
</style>

<template>
    <div class="min-h-screen flex flex-col bg-gradient-to-b from-stone-900 to-stone-800 font-serif">
        <nav class="bg-stone-900/80 border-b border-amber-900/30 backdrop-blur-sm">
            <!-- Desktop menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                        <div class="flex-shrink-0 flex items-center">
                            <Link :href="route('home')" class="flex items-center">
                                <ApplicationLogo />
                                <div class="text-xl text-white font-serif uppercase tracking-wider group-hover:text-amber-400 transition-colors duration-300 mt-1">
                                    {{ appName }}
                                </div>
                            </Link>
                        </div>
                        <div class="hidden md:ml-8 md:flex md:items-center md:space-x-4 mt-1">
                            <Link :href="route('leaders')"
                                class="header-link"
                                :class="{ 'current': route().current('leaders') }">
                                Leaders
                            </Link>
                            <Link :href="route('civilizations')"
                                class="header-link"
                                :class="{ 'current': route().current('civilizations') }">
                                Civilizations
                            </Link>
                        </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden border-t border-amber-900/20 px-2 pt-2 pb-3 flex space-x-1">
                <Link :href="route('leaders')"
                    class="header-link"
                    :class="{ 'current': route().current('leaders') }">
                    Leaders
                </Link>
                <Link :href="route('civilizations')"
                    class="header-link"
                    :class="{ 'current': route().current('civilizations') }">
                    Civilizations
                </Link>
            </div>
        </nav>

        <main class="max-w-7xl w-full mx-auto flex-1 py-12 px-4 sm:px-6 lg:px-8 text-amber-100 font-serif">
            <slot></slot>
        </main>

        <footer class="bg-stone-900 border-t border-amber-900/30 py-8 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <h3>Navigation</h3>
                        <ul class="space-y-2">
                            <li>
                                <Link :href="route('home')" class="footer-link">Home</Link>
                            </li>
                            <li>
                                <Link :href="route('leaders')" class="footer-link">Leaders</Link>
                            </li>
                            <li>
                                <Link :href="route('civilizations')" class="footer-link">Civilizations</Link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3>Resources</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="https://github.com/ntoombs19/civilization-manager" target="_blank" class="footer-link">Documentation</a>
                            </li>
                            <li>
                                <a href="https://eyefyre.github.io/civvapi/" target="_blank" class="footer-link">API</a>
                            </li>
                            <li>
                                <a href="mailto:ntoombs19@gmail.com" class="footer-link">Support</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3>About</h3>
                        <p class="text-amber-100/70 mb-4 leading-relaxed">
                            This application manages civilization and leader data inspired by the Civilization game series.
                        </p>
                        <div class="flex space-x-4">
                            <a href="https://x.com/ntoombs19" target="_blank" class="text-amber-400 hover:text-amber-300 transition-colors duration-300">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                            </a>
                            <a href="https://github.com/ntoombs19" target="_blank" class="text-amber-400 hover:text-amber-300 transition-colors duration-300">
                                <span class="sr-only">GitHub</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-amber-900/20 pt-8">
                    <p class="text-amber-100/50 text-sm text-center">
                        &copy; {{ new Date().getFullYear() }} Civilization Manager. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
