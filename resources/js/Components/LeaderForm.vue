<script setup lang="ts">
import { LeaderData } from '@/types/generated';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';
import Button from "@/Components/Button.vue";
import Select from "@/Components/Select.vue";

const props = defineProps<{
    leader: LeaderData;
    civilizations: Array<{id: number, name: string}>;
    submitLabel?: string;
    isEdit?: boolean;
}>();

const emits = defineEmits(['submit']);

// Set default values for props
const submitLabel = props.submitLabel || (props.isEdit ? 'Save Changes' : 'Create Leader');

// Initialize the form with the leader data
const form = useForm({
    civilizationId: props.leader.civilizationId,
    name: props.leader.name,
    subtitle: props.leader.subtitle,
    lived: props.leader.lived,
    icon: props.leader.icon,
    trait: props.leader.trait || { name: '', effect: '' },
    titles: props.leader.titles || [],
    historicalInfo: props.leader.historicalInfo || [],
});

// Function to add new items to arrays
const addNewTitle = () => {
    form.titles.push('');
};

const addNewHistoricalInfo = () => {
    form.historicalInfo.push({ heading: '', text: '' });
};

// Functions to remove items from arrays
const removeTitle = (index: number) => {
    form.titles.splice(index, 1);
};

const removeHistoricalInfo = (index: number) => {
    form.historicalInfo.splice(index, 1);
};

const handleCivilizationChange = (value: number | string) => {
    form.civilizationId = Number(value);
};

const submit = () => {
    emits('submit', form);
};
</script>

<template>
    <div class="overflow-hidden rounded-lg bg-stone-800/50 shadow-xl">
        <div class="p-8">
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="civilizationId" value="Civilization" />
                    <Select
                        id="civilizationId"
                        :modelValue="form.civilizationId"
                        :options="civilizations"
                        placeholder="Select a civilization"
                        required
                        @update:modelValue="handleCivilizationChange"
                    />
                    <InputError :message="form.errors.civilizationId" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="subtitle" value="Subtitle" />
                    <TextInput
                        id="subtitle"
                        v-model="form.subtitle"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.subtitle" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="lived" value="Lived" />
                    <TextInput
                        id="lived"
                        v-model="form.lived"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.lived" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="icon" value="Icon URL" />
                    <TextInput
                        id="icon"
                        v-model="form.icon"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.icon" class="mt-2" />
                </div>

                <!-- Trait -->
                <div>
                    <InputLabel for="trait" value="Trait" />
                    <div class="space-y-2">
                        <TextInput
                            id="trait-name"
                            v-model="form.trait.name"
                            type="text"
                            placeholder="Trait name"
                            class="w-full"
                            required
                        />
                        <TextArea
                            id="trait-effect"
                            v-model="form.trait.effect"
                            placeholder="Trait effect"
                            class="w-full"
                            rows="2"
                            required
                        />
                    </div>
                    <InputError :message="form.errors.trait" class="mt-2" />
                </div>

                <!-- Titles -->
                <div>
                    <div class="flex items-center justify-between">
                        <InputLabel for="titles" value="Titles" />
                        <button
                            type="button"
                            @click="addNewTitle"
                            class="text-amber-400 hover:text-amber-300 text-sm"
                        >
                            + Add Title
                        </button>
                    </div>
                    <div v-for="(title, index) in form.titles" :key="index" class="mt-2 flex gap-2 items-start">
                        <div class="flex-1">
                            <TextInput
                                :id="`title-${index}`"
                                v-model="form.titles[index]"
                                type="text"
                                placeholder="Title"
                                class="w-full"
                                required
                            />
                        </div>
                        <button
                            type="button"
                            @click="removeTitle(index)"
                            class="text-red-500 hover:text-red-400 mt-2"
                        >
                            Remove
                        </button>
                    </div>
                    <InputError :message="form.errors.titles" class="mt-2" />
                </div>

                <!-- Historical Info -->
                <div>
                    <div class="flex items-center justify-between">
                        <InputLabel for="historicalInfo" value="Historical Information" />
                        <button
                            type="button"
                            @click="addNewHistoricalInfo"
                            class="text-amber-400 hover:text-amber-300 text-sm"
                        >
                            + Add Historical Info
                        </button>
                    </div>
                    <div v-for="(info, index) in form.historicalInfo" :key="index" class="mt-2 flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <h4 class="text-amber-400 text-sm">Entry {{ index + 1 }}</h4>
                            <button
                                type="button"
                                @click="removeHistoricalInfo(index)"
                                class="text-red-500 hover:text-red-400 text-sm"
                            >
                                Remove
                            </button>
                        </div>
                        <TextInput
                            :id="`history-heading-${index}`"
                            v-model="info.heading"
                            type="text"
                            placeholder="Heading"
                            class="w-full"
                            required
                        />
                        <TextArea
                            :id="`history-text-${index}`"
                            v-model="info.text"
                            placeholder="Historical text"
                            class="w-full"
                            rows="3"
                            required
                        />
                    </div>
                    <InputError :message="form.errors.historicalInfo" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-4">
                    <Button :disabled="form.processing">{{ submitLabel }}</Button>
                </div>
            </form>
        </div>
    </div>
</template>
