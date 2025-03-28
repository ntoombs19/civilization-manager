<script setup lang="ts">
import PageHeader from '@/Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import DataListLayout from '@/Components/DataListLayout.vue';
import EntityCard from '@/Components/EntityCard.vue';
import {CivilizationData, LeaderData} from "@/types/generated";

const props = defineProps<{
    leaders: Array<LeaderData & { civilization: CivilizationData}> ,
    page: number,
    pageSize: number,
    totalPages: number,
    count: number,
    search?: string,
    sort?: string,
    filters?: string
}>();

const sortOptions = [
    { value: 'name,asc', label: 'Name (A-Z)' },
    { value: 'name,desc', label: 'Name (Z-A)' },
    { value: 'lived,asc', label: 'Lived (Oldest first)' },
    { value: 'lived,desc', label: 'Lived (Newest first)' },
    { value: 'created_at,desc', label: 'Added recently' },
    { value: 'created_at,asc', label: 'Added first' },
];

const isLoading = ref(false);
</script>

<template>
    <Head title="Leaders" />

    <AppLayout>
        <PageHeader
            title="Historical Leaders"
            subtitle="Discover the remarkable individuals who shaped civilizations and changed the course of history"
        />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DataListLayout
                        :items="leaders"
                        :page="page"
                        :page-size="pageSize"
                        :total-pages="totalPages"
                        :count="count"
                        :search="search"
                        :sort="sort"
                        :filters="filters"
                        :sort-options="sortOptions"
                        base-route="/leaders"
                        item-name="leaders"
                        @update:loading="isLoading = $event"
                    >
                        <template #items="{ items }">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <EntityCard
                                    v-for="leader in items"
                                    :key="leader.id"
                                    :icon="leader.icon"
                                    :name="leader.name"
                                    :subtitle="leader.subtitle"
                                    :time-info="leader.lived"
                                    :related-entity="leader.civilization ? { name: leader.civilization.name, prefix: 'Civilization' } : undefined"
                                />
                            </div>
                        </template>
                    </DataListLayout>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
