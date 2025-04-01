<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    icon?: string;
    name: string;
    subtitle?: string;
    details?: string;
    timeInfo?: string;
    link?: string;
    relatedEntity?: {
        name: string;
        prefix?: string;
    };
}>();
</script>

<template>
    <Link v-if="link" :href="link" class="block">
        <div
            class="group relative transform-gpu overflow-hidden rounded-lg shadow-md shadow-stone-900 transition-all duration-500 hover:scale-105"
        >
            <div
                class="flex h-full flex-col overflow-hidden rounded-lg border border-amber-800/30 bg-gradient-to-br from-stone-800 to-stone-900"
            >
                <div
                    class="absolute left-0 right-0 top-0 h-0.5 bg-gradient-to-r from-amber-700 via-amber-500 to-amber-700"
                ></div>
                <div class="p-4">
                    <div class="flex items-center space-x-3">
                        <img
                            v-if="icon"
                            :src="icon"
                            :alt="name"
                            class="h-12 w-12 rounded-full border border-amber-600/30 object-cover shadow-md"
                        />
                        <div class="min-w-0 flex-1">
                            <h3
                                class="truncate text-lg font-bold text-amber-200"
                            >
                                {{ name }}
                            </h3>
                            <p
                                v-if="subtitle"
                                class="truncate text-sm text-amber-300/80"
                            >
                                {{ subtitle }}
                            </p>
                            <p
                                v-if="relatedEntity"
                                class="mt-1 text-sm font-medium text-amber-500"
                            >
                                {{ relatedEntity.prefix || 'Related to' }}:
                                {{ relatedEntity.name }}
                            </p>
                            <p
                                v-if="details"
                                class="mt-2 line-clamp-2 text-sm text-amber-100/70"
                            >
                                {{ details }}
                            </p>
                            <p
                                v-if="timeInfo"
                                class="mt-1 text-xs text-amber-400/60"
                            >
                                {{ timeInfo }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Link>
    <div
        v-else
        class="group relative transform-gpu overflow-hidden rounded-lg shadow-xl shadow-black/50 transition-all duration-500 hover:scale-105"
    >
        <div
            class="flex h-full flex-col overflow-hidden rounded-lg border border-amber-800/30 bg-gradient-to-br from-stone-800 to-stone-900"
        >
            <div
                class="absolute left-0 right-0 top-0 h-0.5 bg-gradient-to-r from-amber-700 via-amber-500 to-amber-700"
            ></div>
            <div class="p-4">
                <div class="flex items-center space-x-3">
                    <img
                        v-if="icon"
                        :src="icon"
                        :alt="name"
                        class="h-12 w-12 rounded-full border border-amber-600/30 object-cover shadow-md"
                    />
                    <div class="min-w-0 flex-1">
                        <h3 class="truncate text-lg font-bold text-amber-200">
                            {{ name }}
                        </h3>
                        <p
                            v-if="subtitle"
                            class="truncate text-sm text-amber-300/80"
                        >
                            {{ subtitle }}
                        </p>
                        <p
                            v-if="relatedEntity"
                            class="mt-1 text-sm font-medium text-amber-500"
                        >
                            {{ relatedEntity.prefix || 'Related to' }}:
                            {{ relatedEntity.name }}
                        </p>
                        <p
                            v-if="details"
                            class="mt-2 line-clamp-2 text-sm text-amber-100/70"
                        >
                            {{ details }}
                        </p>
                        <p
                            v-if="timeInfo"
                            class="mt-1 text-xs text-amber-400/60"
                        >
                            {{ timeInfo }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
