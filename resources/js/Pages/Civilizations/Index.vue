<script setup lang="ts">
import DataListLayout from '@/Components/DataListLayout.vue';
import EntityCard from '@/Components/EntityCard.vue';
import PageHeader from '@/Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { CivilizationData } from '@/types/generated';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    civilizations: Array<CivilizationData>;
    page: number;
    pageSize: number;
    totalPages: number;
    count: number;
    search?: string;
    sort?: string;
    filters?: string;
}>();

const sortOptions = [
    { value: 'name,asc', label: 'Name (A-Z)' },
    { value: 'name,desc', label: 'Name (Z-A)' },
    { value: 'created_at,desc', label: 'Newest first' },
    { value: 'created_at,asc', label: 'Oldest first' },
];

const isLoading = ref(false);
</script>

<template>
    <Head title="Civilizations" />

    <AppLayout>
        <PageHeader
            title="World Civilizations"
            subtitle="Explore the great civilizations that shaped human history with their unique cultures and achievements"
        />
        <DataListLayout
            :items="civilizations"
            :page="page"
            :page-size="pageSize"
            :total-pages="totalPages"
            :count="count"
            :search="search"
            :sort="sort"
            :filters="filters"
            :sort-options="sortOptions"
            base-route="/civilizations"
            item-name="civilizations"
            @update:loading="isLoading = $event"
        >
            <template #items="{ items }">
                <div
                    class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3"
                >
                    <EntityCard
                        v-for="civilization in items"
                        :key="civilization.id"
                        :icon="civilization.icon"
                        :name="civilization.name"
                        :link="route('civilizations.show', civilization.id)"
                        :related-entity="
                            civilization.leader
                                ? {
                                      name: civilization.leader.name,
                                      prefix: 'Led by',
                                  }
                                : undefined
                        "
                        :details="civilization.dawnOfMan"
                    />
                </div>
            </template>
        </DataListLayout>
    </AppLayout>
</template>
