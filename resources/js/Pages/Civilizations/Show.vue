<script setup lang="ts">
import EntityCard from '@/Components/EntityCard.vue';
import PageHeader from '@/Components/PageHeader.vue';
import Panel from '@/Components/Panel.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { CivilizationData } from '@/types/generated';
import { Head } from '@inertiajs/vue3';

defineProps<{
    civilization: CivilizationData;
}>();
</script>

<template>
    <Head :title="civilization.name" />

    <AppLayout>
        <PageHeader
            :title="civilization.name"
            :subtitle="
                civilization.leader
                    ? `Led by ${civilization.leader.name}`
                    : undefined
            "
            align="left"
        />

        <div class="overflow-hidden rounded-lg bg-stone-800/50 shadow-xl">
            <div class="flex flex-col gap-6 p-8">
                <div class="flex flex-col gap-8 md:flex-row">
                    <div class="flex-shrink-0">
                        <img
                            :src="civilization.icon"
                            :alt="civilization.name"
                        />
                    </div>
                    <div class="flex-1">
                        <h2
                            class="mb-2 text-left text-2xl font-bold text-amber-200"
                        >
                            Leader
                        </h2>
                        <EntityCard
                            :key="civilization.leader.id"
                            :icon="civilization.leader.icon"
                            :name="civilization.leader.name"
                            :subtitle="civilization.leader.subtitle"
                            :time-info="civilization.leader.lived"
                            :link="
                                route('leaders.show', civilization.leader.id)
                            "
                            :related-entity="
                                civilization
                                    ? {
                                          name: civilization.name,
                                          prefix: 'Civilization',
                                      }
                                    : undefined
                            "
                        />
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <h2 class="mb-2 text-2xl font-bold text-amber-200">
                            Dawn of Man
                        </h2>
                        <p class="leading-relaxed text-amber-300">
                            {{ civilization.dawnOfMan }}
                        </p>
                    </div>
                    <div class="mt-12">
                        <h2 class="mb-6 text-2xl font-bold text-amber-200">
                            Historical Information
                        </h2>
                        <div class="space-y-6">
                            <Panel
                                v-for="(
                                    info, index
                                ) in civilization.historicalInfo"
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
