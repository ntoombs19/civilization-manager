<script setup lang="ts">
import CivilizationForm from '@/Components/CivilizationForm.vue';
import PageHeader from '@/Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { CivilizationData } from '@/types/generated';
import { Head } from '@inertiajs/vue3';

defineProps<{
    civilization: CivilizationData;
}>();

const handleSubmit = (form: any) => {
    form.post(route('civilizations.store'));
};
</script>

<template>
    <Head title="Create Civilization" />

    <AppLayout>
        <PageHeader
            title="Create Civilization"
            subtitle="Add a new civilization to the database"
            align="left"
        />
        <CivilizationForm
            :civilization="civilization"
            :is-edit="false"
            submit-label="Create Civilization"
            @submit="handleSubmit"
        />
    </AppLayout>
</template>
