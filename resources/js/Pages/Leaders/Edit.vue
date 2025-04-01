<script setup lang="ts">
import LeaderForm from '@/Components/LeaderForm.vue';
import PageHeader from '@/Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { LeaderData } from '@/types/generated';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    leader: LeaderData;
    civilizations: Array<{ id: number; name: string }>;
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
