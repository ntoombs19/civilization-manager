<script setup lang="ts">
import CivilizationForm from '@/Components/CivilizationForm.vue';
import PageHeader from '@/Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { CivilizationData } from '@/types/generated';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    civilization: CivilizationData;
}>();

const handleSubmit = (form: any) => {
    form.put(route('civilizations.update', props.civilization.id));
};
</script>

<template>
    <Head title="Edit Civilization" />

    <AppLayout>
        <PageHeader
            title="Edit Civilization"
            :subtitle="civilization.name"
            align="left"
        />
        <CivilizationForm
            :civilization="civilization"
            :is-edit="true"
            submit-label="Save Changes"
            @submit="handleSubmit"
        />
    </AppLayout>
</template>
