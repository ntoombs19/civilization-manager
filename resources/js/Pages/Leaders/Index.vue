<script setup lang="ts">
import PageHeader from '@/Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    leaders?: Array<{
        id: number;
        name: string;
    }>;
}>();
</script>

<template>
    <Head title="Leaders" />

    <AppLayout>
        <PageHeader
            title="Historical Leaders"
            subtitle="Discover the remarkable individuals who shaped civilizations and changed the course of history"
        />
    </AppLayout>
</template>
