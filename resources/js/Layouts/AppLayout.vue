<script setup lang="ts">
import Actions, { ActionsType } from '@/Components/Actions.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Breadcrumbs, { BreadcrumbsType } from '@/Components/Breadcrumbs.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { PageProps } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage<
    {
        breadcrumbs?: BreadcrumbsType;
        actions?: ActionsType;
    } & PageProps
>();
const appName = computed(() => page.props.appName || 'Civilization Manager');

const props = page.props;
console.log(props.actions);
</script>

<style scoped>
.header-link {
    @apply flex-1 rounded-md px-3 py-2 text-center font-serif text-sm font-medium uppercase tracking-wider transition-colors duration-300;

    &.current {
        @apply bg-amber-900/20 text-amber-400;
    }
}

.footer-link {
    @apply text-amber-100/70 transition-colors duration-300 hover:text-amber-400;
}
</style>

<template>
    <div
        class="flex min-h-screen flex-col bg-gradient-to-b from-stone-900 to-stone-800 font-serif"
    >
        <FlashMessage />
        <nav
            class="border-b border-amber-900/30 bg-stone-900/80 backdrop-blur-sm"
        >
            <!-- Desktop menu -->
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex flex-shrink-0 items-center">
                        <Link :href="route('home')" class="flex items-center">
                            <ApplicationLogo />
                            <div
                                class="mt-1 font-serif text-xl uppercase tracking-wider text-white transition-colors duration-300 group-hover:text-amber-400"
                            >
                                {{ appName }}
                            </div>
                        </Link>
                    </div>
                    <div
                        class="mt-1 hidden md:ml-8 md:flex md:items-center md:space-x-4"
                    >
                        <Link
                            :href="route('leaders.index')"
                            class="header-link"
                            :class="{
                                current: route().current('leaders.index'),
                            }"
                        >
                            Leaders
                        </Link>
                        <Link
                            :href="route('civilizations.index')"
                            class="header-link"
                            :class="{
                                current: route().current('civilizations.index'),
                            }"
                        >
                            Civilizations
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div
                class="flex space-x-1 border-t border-amber-900/20 px-2 pb-3 pt-2 md:hidden"
            >
                <Link
                    :href="route('leaders.index')"
                    class="header-link"
                    :class="{ current: route().current('leaders.index') }"
                >
                    Leaders
                </Link>
                <Link
                    :href="route('civilizations.index')"
                    class="header-link"
                    :class="{ current: route().current('civilizations.index') }"
                >
                    Civilizations
                </Link>
            </div>
        </nav>
        <div
            class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6"
        >
            <Breadcrumbs
                :breadcrumbs="props.breadcrumbs"
                v-if="props.breadcrumbs"
            />
            <Actions
                v-if="props.actions"
                :actions="Object.values(props.actions)"
            />
        </div>
        <main
            class="mx-auto w-full max-w-7xl flex-1 px-4 py-6 font-serif text-amber-100 sm:px-6 lg:px-8"
        >
            <slot></slot>
        </main>

        <footer class="border-t border-amber-900/30 bg-stone-900 py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-8 grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div>
                        <h3>Navigation</h3>
                        <ul class="space-y-2">
                            <li>
                                <Link :href="route('home')" class="footer-link"
                                    >Home
                                </Link>
                            </li>
                            <li>
                                <Link
                                    :href="route('leaders.index')"
                                    class="footer-link"
                                    >Leaders
                                </Link>
                            </li>
                            <li>
                                <Link
                                    :href="route('civilizations.index')"
                                    class="footer-link"
                                    >Civilizations
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3>Resources</h3>
                        <ul class="space-y-2">
                            <li>
                                <a
                                    href="https://github.com/ntoombs19/civilization-manager"
                                    target="_blank"
                                    class="footer-link"
                                    >Documentation</a
                                >
                            </li>
                            <li>
                                <a
                                    href="https://eyefyre.github.io/civvapi/"
                                    target="_blank"
                                    class="footer-link"
                                    >API</a
                                >
                            </li>
                            <li>
                                <a
                                    href="mailto:ntoombs19@gmail.com"
                                    class="footer-link"
                                    >Support</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3>About</h3>
                        <p class="mb-4 leading-relaxed text-amber-100/70">
                            This application manages civilization and leader
                            data inspired by the Civilization game series.
                        </p>
                        <div class="flex space-x-4">
                            <a
                                href="https://x.com/ntoombs19"
                                target="_blank"
                                class="text-amber-400 transition-colors duration-300 hover:text-amber-300"
                            >
                                <span class="sr-only">Twitter</span>
                                <svg
                                    class="h-6 w-6"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                                    ></path>
                                </svg>
                            </a>
                            <a
                                href="https://github.com/ntoombs19"
                                target="_blank"
                                class="text-amber-400 transition-colors duration-300 hover:text-amber-300"
                            >
                                <span class="sr-only">GitHub</span>
                                <svg
                                    class="h-6 w-6"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-amber-900/20 pt-8">
                    <p class="text-center text-sm text-amber-100/50">
                        &copy; {{ new Date().getFullYear() }} Civilization
                        Manager. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
