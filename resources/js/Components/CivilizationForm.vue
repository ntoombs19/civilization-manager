<script setup lang="ts">
import Button from '@/Components/Button.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';
import { CivilizationData } from '@/types/generated';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    civilization: CivilizationData;
    submitLabel?: string;
    isEdit?: boolean;
}>();

const emits = defineEmits(['submit']);

// Set default values for props
const submitLabel =
    props.submitLabel ||
    (props.isEdit ? 'Save Changes' : 'Create Civilization');

// Initialize the form with the civilization data
const form = useForm({
    name: props.civilization.name,
    icon: props.civilization.icon,
    dawnOfMan: props.civilization.dawnOfMan,
    historicalInfo: props.civilization.historicalInfo,
});

const addNewHistoricalInfo = () => {
    form.historicalInfo.push({ heading: '', text: '' });
};


const removeHistoricalInfo = (index: number) => {
    form.historicalInfo.splice(index, 1);
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

                <div>
                    <InputLabel for="dawnOfMan" value="Dawn of Man" />
                    <TextArea
                        id="dawnOfMan"
                        v-model="form.dawnOfMan"
                        class="mt-1 block w-full"
                        rows="5"
                        required
                    />
                    <InputError :message="form.errors.dawnOfMan" class="mt-2" />
                </div>

                <!-- Historical Info -->
                <div>
                    <div class="flex items-center justify-between">
                        <InputLabel
                            for="historicalInfo"
                            value="Historical Information"
                        />
                        <button
                            type="button"
                            @click="addNewHistoricalInfo"
                            class="text-sm text-amber-400 hover:text-amber-300"
                        >
                            + Add Historical Info
                        </button>
                    </div>
                    <div
                        v-for="(info, index) in form.historicalInfo"
                        :key="index"
                        class="mt-2 flex flex-col gap-2"
                    >
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm text-amber-400">
                                Entry {{ index + 1 }}
                            </h4>
                            <button
                                type="button"
                                @click="removeHistoricalInfo(index)"
                                class="text-sm text-red-500 hover:text-red-400"
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
                    <InputError
                        :message="form.errors.historicalInfo"
                        class="mt-2"
                    />
                </div>

                <div class="flex items-center justify-end gap-4">
                    <Button type="submit" :disabled="form.processing">{{
                        submitLabel
                    }}</Button>
                </div>
            </form>
        </div>
    </div>
</template>
