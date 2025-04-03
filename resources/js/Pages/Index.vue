<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Button from '@/Components/Button.vue';
import Card from '@/Components/Card.vue';
import Divider from '@/Components/Divider.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    isAuthenticated?: boolean;
}>();

console.log(props);
</script>
<template>
    <Head title="Home" />

    <div
        class="relative flex min-h-screen flex-col items-center justify-center bg-cover bg-center font-serif text-amber-100"
    >
        <div
            class="absolute inset-0 z-0 bg-[url('/images/background.png')] bg-cover bg-fixed bg-center opacity-70"
        ></div>
        <div
            class="z-1 pointer-events-none absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70"
        ></div>

        <header
            class="relative z-10 flex w-full items-center justify-between gap-4 px-6 py-4"
        >
            <div class="flex flex-1 items-center">
                <ApplicationLogo />
                <Link
                    :href="route('home')"
                    class="group mt-1 text-xl text-white lg:text-2xl"
                >
                    <span
                        class="transition-colors duration-300 group-hover:text-amber-400"
                        >Civilization Manager</span
                    >
                </Link>
            </div>

            <div v-if="canLogin" class="flex flex-wrap justify-end gap-4">
                <template v-if="isAuthenticated">
                    <Button
                        :href="route('logout')"
                        method="post"
                        size="sm"
                        variant="primary"
                    >
                        Log out
                    </Button>
                </template>
                <template v-else>
                    <Button :href="route('login')" size="sm"> Log in </Button>
                    <Button
                        v-if="canRegister"
                        :href="route('register')"
                        size="sm"
                    >
                        Register
                    </Button>
                </template>
            </div>
        </header>
        <main
            class="relative z-10 flex flex-grow flex-col items-center justify-center px-4 py-10 text-center"
        >
            <div class="mb-12 max-w-3xl">
                <h1
                    class="mb-6 flex flex-wrap justify-center text-4xl font-bold uppercase leading-tight tracking-widest lg:text-5xl"
                >
                    <span class="text-amber-400">Civilization</span>
                    <span class="ml-4 text-white">Manager</span>
                </h1>

                <Divider />

                <p
                    class="mx-auto mb-12 max-w-2xl text-lg leading-relaxed text-amber-100/90"
                >
                    Explore the wonders of civilization with detailed
                    information about leaders and civilizations throughout
                    history.
                </p>
            </div>

            <div
                class="perspective-distant mb-6 flex flex-col justify-center space-y-6 lg:flex-row lg:space-x-10 lg:space-y-0"
            >
                <Card variant="primary">
                    <div class="p-8">
                        <div class="mb-4 flex justify-center">
                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-full border border-amber-700/60 bg-gradient-to-br from-stone-800 to-stone-900 text-amber-400 shadow-lg shadow-amber-900/40"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    class="h-8 w-8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <h2>Civilizations</h2>
                        <p
                            class="mb-6 text-center leading-relaxed text-amber-100/90"
                        >
                            Discover the unique characteristics and history of each civilization
                        </p>
                        <Button
                            :href="route('civilizations.index')"
                            variant="primary"
                            size="lg"
                            full-width
                        >
                            Explore Civilizations
                        </Button>
                    </div>
                </Card>
                <Card variant="primary">
                    <div class="p-8">
                        <div class="mb-4 flex justify-center">
                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-full border border-amber-700/60 bg-gradient-to-br from-stone-800 to-stone-900 text-amber-400 shadow-lg shadow-amber-900/40"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    class="h-8 w-8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <h2>Leaders</h2>
                        <p
                            class="mb-6 text-center leading-relaxed text-amber-100/90"
                        >
                            Learn about the historical leaders who shaped the
                            course of history
                        </p>
                        <Button
                            :href="route('leaders.index')"
                            variant="primary"
                            size="lg"
                            full-width
                        >
                            Meet the Leaders
                        </Button>
                    </div>
                </Card>
            </div>
        </main>
    </div>
</template>
