<script setup lang="ts">
import LeaderForm from '@/Components/LeaderForm.vue';
import PageHeader from '@/Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { LeaderData } from '@/types/generated';
import { Head } from '@inertiajs/vue3';

defineProps<{
    leader: LeaderData;
    civilizations: Array<{ id: number; name: string }>;
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
