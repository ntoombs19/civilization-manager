<script setup lang="ts">
import EntityCard from '@/Components/EntityCard.vue';
import PageHeader from '@/Components/PageHeader.vue';
import Panel from '@/Components/Panel.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { CivilizationData, LeaderData } from '@/types/generated';
import { Head } from '@inertiajs/vue3';

defineProps<{
    leader: LeaderData & { civilization: CivilizationData };
}>();
</script>

<template>
    <Head :title="leader.name" />

    <AppLayout>
        <PageHeader
            :title="leader.name"
            :subtitle="leader.subtitle"
            align="left"
        />

        <div class="overflow-hidden rounded-lg bg-stone-800/50 shadow-xl">
            <div class="flex flex-col gap-6 p-8">
                <div class="flex flex-col gap-8 md:flex-row">
                    <div class="flex-shrink-0">
                        <img :src="leader.icon" :alt="leader.name" />
                    </div>
                    <div class="flex-1">
                        <h2
                            class="mb-2 text-left text-2xl font-bold text-amber-200"
                        >
                            Civilization
                        </h2>
                        <EntityCard
                            :key="leader.civilization.id"
                            :icon="leader.civilization.icon"
                            :name="leader.civilization.name"
                            :link="
                                route(
                                    'civilizations.show',
                                    leader.civilization.id,
                                )
                            "
                            :related-entity="
                                leader
                                    ? {
                                          name: leader.name,
                                          prefix: 'led by',
                                      }
                                    : undefined
                            "
                            :details="leader.civilization.dawnOfMan"
                        />
                    </div>
                </div>
                <div class="space-y-6">
                    <div v-if="leader.titles.length > 0">
                        <h2 class="mb-2 text-2xl font-bold text-amber-200">
                            Titles
                        </h2>
                        <ul class="list-inside list-disc space-y-1">
                            <li
                                v-for="title in leader.titles"
                                :key="title"
                                class="text-amber-300"
                            >
                                {{ title }}
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-2 text-2xl font-bold text-amber-200">
                            Historical Period
                        </h2>
                        <p class="text-center text-amber-300">
                            {{ leader.lived }}
                        </p>
                    </div>
                    <div>
                        <h2 class="mb-2 text-2xl font-bold text-amber-200">
                            Leader Trait
                        </h2>
                        <Panel :title="leader.trait.name">
                            <p class="text-amber-200/80">
                                {{ leader.trait.effect }}
                            </p>
                        </Panel>
                    </div>
                    <div>
                        <h2 class="mb-6 text-2xl font-bold text-amber-200">
                            Historical Information
                        </h2>
                        <div class="space-y-6">
                            <Panel
                                v-for="(info, index) in leader.historicalInfo"
                                :key="index"
                                :title="info.heading"
                            >
                                <p class="leading-relaxed text-amber-200/80">
                                    {{ info.text }}
                                </p>
                            </Panel>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
