<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Button from '@/Components/Button.vue';
import Card from '@/Components/Card.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();

// Star animation setup
onMounted(() => {
    const createStars = () => {
        const starsContainer = document.getElementById('stars-container');
        if (!starsContainer) return;

        starsContainer.innerHTML = '';

        for (let i = 0; i < 80; i++) {
            const star = document.createElement('div');
            const size = Math.random() * 2 + 1;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const delay = Math.random() * 8;
            const duration = Math.random() * 4 + 4;

            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            star.style.left = `${posX}%`;
            star.style.top = `${posY}%`;
            star.style.animationDelay = `${delay}s`;
            star.style.animationDuration = `${duration}s`;

            star.className = 'absolute rounded-full bg-yellow-300 animate-twinkle';
            starsContainer.appendChild(star);
        }
    };

    createStars();
});
</script>

<template>
    <Head title="Home" />

    <div class="min-h-screen flex flex-col items-center justify-center bg-cover bg-center relative font-serif text-amber-100">
        <div class="absolute inset-0 bg-fixed bg-[url('/images/background.png')] bg-cover bg-center opacity-70 z-0"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70 z-1 pointer-events-none"></div>
        <div id="stars-container" class="absolute inset-0 overflow-hidden z-0"></div>

        <header class="relative z-10 w-full px-6 py-4 flex justify-between items-center gap-4">
            <div class="flex items-center flex-1">
                <ApplicationLogo />
                <Link :href="route('home')" class="text-xl lg:text-2xl text-white group mt-1">
                    <span class="group-hover:text-amber-400 transition-colors duration-300">Civilization Manager</span>
                </Link>
            </div>

            <div v-if="canLogin" class="flex flex-wrap gap-4 justify-end">
                <Button
                    v-if="$page.props.auth?.user"
                    :href="route('sign-out')"
                    size="sm"
                >
                    Sign out
                </Button>
                <template v-else>
                    <Button
                        :href="route('login')"
                        size="sm"
                    >
                        Log in
                    </Button>
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
        <main class="relative z-10 flex flex-col items-center justify-center flex-grow text-center px-4 py-10">
            <div class="max-w-3xl mb-12">
                <h1 class="flex flex-wrap justify-center text-4xl lg:text-5xl font-bold uppercase tracking-widest leading-tight mb-6">
                    <span class="text-amber-400">Civilization</span>
                    <span class="text-white ml-4">Manager</span>
                </h1>

                <div class="h-[3px] bg-gradient-to-r from-transparent via-amber-600 to-transparent w-3/5 mx-auto mb-10 relative">
                    <span class="absolute -left-2.5 top-1/2 -translate-y-1/2 text-amber-600 text-2xl">•</span>
                    <span class="absolute -right-2.5 top-1/2 -translate-y-1/2 text-amber-600 text-2xl">•</span>
                </div>

                <p class="text-lg text-amber-100/90 max-w-2xl mx-auto mb-12 leading-relaxed">
                    Explore the wonders of civilization with detailed information about leaders and civilizations throughout history.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row justify-center space-y-6 lg:space-y-0 lg:space-x-10 mb-6 perspective-distant">
                <Card variant="primary">
                    <div class="p-8">
                        <div class="flex justify-center mb-4">
                            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-stone-800 to-stone-900 text-amber-400 shadow-lg shadow-amber-900/40 border border-amber-700/60">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <h2>Civilizations</h2>
                        <p class="text-amber-100/90 mb-6 leading-relaxed text-center">
                            Discover the unique characteristics, units, and buildings of each civilization
                        </p>
                        <Button
                            :href="route('civilizations')"
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
                        <div class="flex justify-center mb-4">
                            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-stone-800 to-stone-900 text-amber-400 shadow-lg shadow-amber-900/40 border border-amber-700/60">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <h2>Leaders</h2>
                        <p class="text-amber-100/90 mb-6 leading-relaxed text-center">
                            Learn about the historical leaders who shaped the course of history
                        </p>
                        <Button
                            :href="route('leaders')"
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
