<script setup lang="ts">
import { CivilizationData } from '@/types/generated';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageHeader from '@/Components/PageHeader.vue';
import CivilizationForm from '@/Components/CivilizationForm.vue';

const props = defineProps<{
  civilization: CivilizationData;
}>();

const handleSubmit = (form: any) => {
  form.post(route('civilizations.store'));
};
</script>

<template>
  <Head title="Create Civilization" />

  <AppLayout>
    <PageHeader title="Create Civilization" subtitle="Add a new civilization to the database" align="left" />
    <CivilizationForm 
      :civilization="civilization" 
      :is-edit="false"
      submit-label="Create Civilization"
      @submit="handleSubmit"
    />
  </AppLayout>
</template>
