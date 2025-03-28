<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageHeader from '@/Components/PageHeader.vue';
import { ref } from 'vue';
import DataListLayout from '@/Components/DataListLayout.vue';
import EntityCard from '@/Components/EntityCard.vue';
import { CivilizationData } from "@/types/generated";

const props = defineProps<{
    civilizations: Array<CivilizationData>,
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

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                              <EntityCard 
                                  v-for="civilization in items" 
                                  :key="civilization.id"
                                  :icon="civilization.icon"
                                  :name="civilization.name"
                                  :related-entity="civilization.leader ? { name: civilization.leader.name, prefix: 'Led by' } : undefined"
                                  :details="civilization.dawnOfMan"
                              />
                          </div>
                      </template>
                  </DataListLayout>
              </div>
          </div>
      </div>
    </AppLayout>
</template>

