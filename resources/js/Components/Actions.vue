<script setup lang="ts">
import Button, { ButtonProps } from '@/Components/Button.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

export type ActionType = {
    url: string;
    label: string;
    variant: ButtonProps['variant'];
};

export type ActionsType = ActionType[];

const props = defineProps<{
    actions: ActionsType;
}>();

const confirmingDeletion = ref(false);

const confirmDeletion = () => {
    confirmingDeletion.value = true;
};

const deleteRecord = (url: string) => {
    router.delete(url, {
        onSuccess: () => {
            confirmingDeletion.value = false;
        },
    });
};
</script>
<template>
    <div v-if="props.actions.length > 0" class="flex items-center gap-3">
        <div v-for="action in props.actions">
            <Button
                v-if="action.url && action.variant !== 'danger'"
                size="sm"
                :href="action.url"
                :variant="action.variant"
            >
                {{ action.label }}
            </Button>

            <Button
                v-else-if="action.variant === 'danger'"
                size="sm"
                @click="confirmDeletion"
                variant="danger"
            >
                {{ action.label }}
            </Button>

            <div
                v-if="action.variant === 'danger' && confirmingDeletion"
                class="fixed inset-0 z-50 flex items-center justify-center bg-stone-900/75"
            >
                <div class="w-96 rounded-lg bg-stone-800 p-6 shadow-xl">
                    <h3 class="text-lg font-medium text-amber-100">
                        Delete Confirmation
                    </h3>
                    <p class="mt-2 text-sm text-amber-300">
                        Are you sure you want to delete this record? This action
                        cannot be undone.
                    </p>
                    <div class="mt-4 flex justify-end gap-3">
                        <Button
                            @click="confirmingDeletion = false"
                            variant="outline"
                            size="sm"
                        >
                            Cancel
                        </Button>
                        <Button variant="danger" size="sm" @click="() => deleteRecord(action.url)">
                            Delete
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
