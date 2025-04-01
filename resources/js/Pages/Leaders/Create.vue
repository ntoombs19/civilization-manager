<script setup lang="ts">
import { LeaderData } from '@/types/generated';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageHeader from '@/Components/PageHeader.vue';
import LeaderForm from '@/Components/LeaderForm.vue';

const props = defineProps<{
  leader: LeaderData;
  civilizations: Array<{id: number, name: string}>;
}>();

const handleSubmit = (form: any) => {
  form.post(route('leaders.store'));
};
</script>

<template>
  <Head title="Create Leader" />

  <AppLayout>
    <PageHeader title="Create Leader" />
    <LeaderForm
      :leader="leader"
      :civilizations="civilizations"
      :is-edit="false"
      submit-label="Create Leader"
      @submit="handleSubmit"
    />
  </AppLayout>
</template>
