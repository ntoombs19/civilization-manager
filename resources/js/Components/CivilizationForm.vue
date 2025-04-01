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
    uniqueBuildings: props.civilization.uniqueBuildings,
    uniqueUnits: props.civilization.uniqueUnits,
    cityNames: props.civilization.cityNames,
    spyNames: props.civilization.spyNames,
    historicalInfo: props.civilization.historicalInfo,
    url: props.civilization.url,
});

// Function to add new items to arrays
const addNewBuilding = () => {
    form.uniqueBuildings.push({ name: '', url: '' });
};

const addNewUnit = () => {
    form.uniqueUnits.push({ name: '', url: '' });
};

const addNewCity = () => {
    form.cityNames.push('');
};

const addNewSpy = () => {
    form.spyNames.push('');
};

const addNewHistoricalInfo = () => {
    form.historicalInfo.push({ heading: '', text: '' });
};

// Functions to remove items from arrays
const removeBuilding = (index: number) => {
    form.uniqueBuildings.splice(index, 1);
};

const removeUnit = (index: number) => {
    form.uniqueUnits.splice(index, 1);
};

const removeCity = (index: number) => {
    form.cityNames.splice(index, 1);
};

const removeSpy = (index: number) => {
    form.spyNames.splice(index, 1);
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

                <!-- Unique Buildings -->
                <div>
                    <div class="flex items-center justify-between">
                        <InputLabel
                            for="uniqueBuildings"
                            value="Unique Buildings"
                        />
                        <button
                            type="button"
                            @click="addNewBuilding"
                            class="text-sm text-amber-400 hover:text-amber-300"
                        >
                            + Add Building
                        </button>
                    </div>
                    <div
                        v-for="(building, index) in form.uniqueBuildings"
                        :key="index"
                        class="mt-2 flex items-start gap-2"
                    >
                        <div class="flex-1">
                            <TextInput
                                :id="`building-name-${index}`"
                                v-model="building.name"
                                type="text"
                                placeholder="Building name"
                                class="w-full"
                                required
                            />
                        </div>
                        <div class="flex-1">
                            <TextInput
                                :id="`building-url-${index}`"
                                v-model="building.url"
                                type="text"
                                placeholder="URL"
                                class="w-full"
                                required
                            />
                        </div>
                        <button
                            type="button"
                            @click="removeBuilding(index)"
                            class="mt-2 text-red-500 hover:text-red-400"
                        >
                            Remove
                        </button>
                    </div>
                    <InputError
                        :message="form.errors.uniqueBuildings"
                        class="mt-2"
                    />
                </div>

                <!-- Unique Units -->
                <div>
                    <div class="flex items-center justify-between">
                        <InputLabel for="uniqueUnits" value="Unique Units" />
                        <button
                            type="button"
                            @click="addNewUnit"
                            class="text-sm text-amber-400 hover:text-amber-300"
                        >
                            + Add Unit
                        </button>
                    </div>
                    <div
                        v-for="(unit, index) in form.uniqueUnits"
                        :key="index"
                        class="mt-2 flex items-start gap-2"
                    >
                        <div class="flex-1">
                            <TextInput
                                :id="`unit-name-${index}`"
                                v-model="unit.name"
                                type="text"
                                placeholder="Unit name"
                                class="w-full"
                                required
                            />
                        </div>
                        <div class="flex-1">
                            <TextInput
                                :id="`unit-url-${index}`"
                                v-model="unit.url"
                                type="text"
                                placeholder="URL"
                                class="w-full"
                                required
                            />
                        </div>
                        <button
                            type="button"
                            @click="removeUnit(index)"
                            class="mt-2 text-red-500 hover:text-red-400"
                        >
                            Remove
                        </button>
                    </div>
                    <InputError
                        :message="form.errors.uniqueUnits"
                        class="mt-2"
                    />
                </div>

                <!-- City Names -->
                <div>
                    <div class="flex items-center justify-between">
                        <InputLabel for="cityNames" value="City Names" />
                        <button
                            type="button"
                            @click="addNewCity"
                            class="text-sm text-amber-400 hover:text-amber-300"
                        >
                            + Add City
                        </button>
                    </div>
                    <div
                        v-for="(city, index) in form.cityNames"
                        :key="index"
                        class="mt-2 flex items-start gap-2"
                    >
                        <div class="flex-1">
                            <TextInput
                                :id="`city-${index}`"
                                v-model="form.cityNames[index]"
                                type="text"
                                placeholder="City name"
                                class="w-full"
                                required
                            />
                        </div>
                        <button
                            type="button"
                            @click="removeCity(index)"
                            class="mt-2 text-red-500 hover:text-red-400"
                        >
                            Remove
                        </button>
                    </div>
                    <InputError :message="form.errors.cityNames" class="mt-2" />
                </div>

                <!-- Spy Names -->
                <div>
                    <div class="flex items-center justify-between">
                        <InputLabel for="spyNames" value="Spy Names" />
                        <button
                            type="button"
                            @click="addNewSpy"
                            class="text-sm text-amber-400 hover:text-amber-300"
                        >
                            + Add Spy
                        </button>
                    </div>
                    <div
                        v-for="(spy, index) in form.spyNames"
                        :key="index"
                        class="mt-2 flex items-start gap-2"
                    >
                        <div class="flex-1">
                            <TextInput
                                :id="`spy-${index}`"
                                v-model="form.spyNames[index]"
                                type="text"
                                placeholder="Spy name"
                                class="w-full"
                                required
                            />
                        </div>
                        <button
                            type="button"
                            @click="removeSpy(index)"
                            class="mt-2 text-red-500 hover:text-red-400"
                        >
                            Remove
                        </button>
                    </div>
                    <InputError :message="form.errors.spyNames" class="mt-2" />
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

                <div>
                    <InputLabel for="url" value="URL" />
                    <TextInput
                        id="url"
                        v-model="form.url"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError :message="form.errors.url" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-4">
                    <Button :disabled="form.processing">{{
                        submitLabel
                    }}</Button>
                </div>
            </form>
        </div>
    </div>
</template>
