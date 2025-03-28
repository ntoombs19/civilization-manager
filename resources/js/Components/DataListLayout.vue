<script setup lang="ts">
import { ref, watch, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';
import Pagination from '@/Components/Pagination.vue';

interface SortOption {
    value: string;
    label: string;
}

interface PageSizeOption {
    value: string;
    label: string;
}

const props = defineProps<{
    items: Array<any>;
    page: number;
    pageSize: number;
    totalPages: number;
    count: number;
    search?: string;
    sort?: string;
    filters?: string;
    baseRoute: string;
    searchPlaceholder?: string;
    sortOptions: SortOption[];
    pageSizeOptions?: PageSizeOption[];
    itemName: 'leaders' | 'civilizations';
}>();

const emit = defineEmits(['update:loading']);

const search = ref(props.search || '');
const sort = ref(props.sort || 'name,asc');
const filters = ref(props.filters || '');
const pageSize = ref(props.pageSize.toString());
const currentPage = ref(props.page);
const loading = ref(false);

const pageSizeOptions = [
    { value: '12', label: '12 per page' },
    { value: '24', label: '24 per page' },
    { value: '48', label: '48 per page' },
    { value: '96', label: '96 per page' },
];

const from = computed(() => {
    return (currentPage.value - 1) * parseInt(pageSize.value) + 1;
});

const to = computed(() => {
    const calculatedTo = currentPage.value * parseInt(pageSize.value);
    return calculatedTo > props.count ? props.count : calculatedTo;
});

const updateQueryParams = debounce(() => {
    loading.value = true;
    emit('update:loading', true);

    const params: Record<string, any> = {
        page: currentPage.value,
        pageSize: pageSize.value,
        sort: sort.value
    };

    if (search.value) {
        params.search = search.value;
    }

    if (filters.value) {
        params.filters = filters.value;
    }

    router.get(props.baseRoute, params, {
        preserveState: true,
        replace: true,
        onFinish: () => {
            loading.value = false;
            emit('update:loading', false);
        }
    });
}, 300);

const goToPage = (page: number) => {
    if (page > 0 && page <= props.totalPages) {
        currentPage.value = page;
        updateQueryParams();
    }
};

const handleSearchInput = () => {
    currentPage.value = 1; // Reset to first page when searching
    updateQueryParams();
};

const handleSortChange = () => {
    updateQueryParams();
};

const handlePageSizeChange = () => {
    currentPage.value = 1; // Reset to first page when changing page size
    updateQueryParams();
};

const clearSearch = () => {
    search.value = '';
    currentPage.value = 1;
    updateQueryParams();
};

watch([search, sort, pageSize], () => {
    updateQueryParams();
});

defineExpose({
    loading
});
</script>

<template>
    <div class="p-6 text-amber-100">
        <!-- Search and filter controls -->
        <div class="mb-6 flex flex-col md:flex-row justify-between gap-4">
            <div class="flex-1 min-w-0">
                <label for="search" class="sr-only">Search</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-amber-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input
                        type="search"
                        name="search"
                        id="search"
                        v-model="search"
                        @input="handleSearchInput"
                        class="block w-full rounded-md border-amber-700 bg-stone-800/70 py-1.5 pl-10 pr-3 text-amber-100 shadow-sm focus:border-amber-500 focus:ring-amber-500 placeholder:text-amber-400/50 sm:text-sm sm:leading-6"
                        :placeholder="searchPlaceholder || `Search ${itemName}...`"
                    />
                </div>
                <div v-if="search" class="mt-2 flex items-center">
                    <span class="text-xs text-amber-300/70">Searching for: </span>
                    <span class="ml-1 text-xs text-amber-200 font-medium">{{ search }}</span>
                    <button 
                        @click="clearSearch" 
                        class="ml-2 inline-flex items-center rounded-md border border-amber-700/50 bg-stone-800/40 px-2 py-0.5 text-xs font-medium text-amber-400 hover:bg-amber-900/20 hover:text-amber-300 transition-colors duration-200"
                        title="Clear search"
                    >
                        <svg class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>
                        Clear
                    </button>
                </div>
            </div>
            <div class="flex flex-row gap-4">
                <div class="min-w-32">
                    <label for="pageSize" class="sr-only">Items per page</label>
                    <select
                        id="pageSize"
                        v-model="pageSize"
                        @change="handlePageSizeChange"
                        class="block w-full rounded-md border-amber-700 bg-stone-800/70 py-1.5 pl-3 pr-10 text-amber-100 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm sm:leading-6"
                    >
                        <option v-for="option in pageSizeOptions" :key="option.value" :value="option.value">
                            {{ option.label }}
                        </option>
                    </select>
                </div>
                <div class="min-w-40">
                    <label for="sort" class="sr-only">Sort by</label>
                    <select
                        id="sort"
                        v-model="sort"
                        @change="handleSortChange"
                        class="block w-full rounded-md border-amber-700 bg-stone-800/70 py-1.5 pl-3 pr-10 text-amber-100 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm sm:leading-6"
                    >
                        <option v-for="option in sortOptions" :key="option.value" :value="option.value">
                            {{ option.label }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Loading state -->
        <div v-if="loading" class="flex justify-center items-center py-12">
            <svg class="animate-spin h-8 w-8 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        <!-- Items list -->
        <div v-else-if="items.length > 0">
            <slot name="items" :items="items"></slot>
        </div>

        <!-- Empty state -->
        <div v-else class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-amber-600/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-amber-200">No {{ itemName }} found</h3>
            <p class="mt-1 text-sm text-amber-400/70">Try changing your search criteria or clear filters.</p>
        </div>

        <!-- Pagination controls -->
        <div v-if="items.length > 0" class="mt-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <span class="text-sm text-amber-300/80">
                    Showing <span class="font-semibold text-amber-200">{{ from }}</span> to <span class="font-semibold text-amber-200">{{ to }}</span> of <span class="font-semibold text-amber-200">{{ count }}</span> {{ itemName }}
                </span>
                <div class="flex justify-center">
                    <Pagination
                        :current-page="currentPage"
                        :total-pages="totalPages"
                        :on-page-change="goToPage"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
