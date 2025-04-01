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
  form.put(route('leaders.update', props.leader.id));
};
</script>

<template>
  <Head title="Edit Leader" />

  <AppLayout>
    <PageHeader title="Edit Leader" :subtitle="leader.name" align="left" />
    <LeaderForm
      :leader="leader"
      :civilizations="civilizations"
      :is-edit="true"
      submit-label="Save Changes"
      @submit="handleSubmit"
    />
  </AppLayout>
</template>
