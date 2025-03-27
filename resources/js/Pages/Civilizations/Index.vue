<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageHeader from '@/Components/PageHeader.vue';

defineProps<{
    civilizations?: Array<{
        id: number;
        name: string;
    }>
}>();
</script>

<template>
    <Head title="Civilizations" />

    <AppLayout>
      <PageHeader
          title="World Civilizations"
          subtitle="Explore the great civilizations that shaped human history with their unique cultures and achievements"
      />
    </AppLayout>
</template>

