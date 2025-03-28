<script setup lang="ts">
import PageHeader from '@/Components/PageHeader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import debounce from 'lodash/debounce';
import {CivilizationData, LeaderData} from "@/types/generated";

const props = defineProps<{
    leaders: Array<LeaderData & { civilization: CivilizationData}> ,
    page: number,
    pageSize: number,
    totalPages: number,
    count: number,
    search?: string,
    sort?: string,
    filters?: string
}>();

const search = ref(props.search || '');
const sort = ref(props.sort || 'name,asc');
const filters = ref(props.filters || '');
const pageSize = ref(props.pageSize.toString());
const currentPage = ref(props.page);
const offset = props.pageSize;

const pageSizeOptions = [
    { value: '10', label: '10 per page' },
    { value: '25', label: '25 per page' },
    { value: '50', label: '50 per page' },
    { value: '100', label: '100 per page' },
];

const sortOptions = [
    { value: 'name,asc', label: 'Name (A-Z)' },
    { value: 'name,desc', label: 'Name (Z-A)' },
    { value: 'lived,asc', label: 'Lived (Oldest first)' },
    { value: 'lived,desc', label: 'Lived (Newest first)' },
    { value: 'created_at,desc', label: 'Added recently' },
    { value: 'created_at,asc', label: 'Added first' },
];

const loading = ref(false);

const from = computed(() => {
    return (currentPage.value - 1) * parseInt(pageSize.value) + 1;
});

const to = computed(() => {
    const calculatedTo = currentPage.value * parseInt(pageSize.value);
    return calculatedTo > props.count ? props.count : calculatedTo;
});

const updateQueryParams = debounce(() => {
    loading.value = true;
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

    router.get('/leaders', params, {
        preserveState: true,
        replace: true,
        onFinish: () => {
            loading.value = false;
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

watch([search, sort, pageSize], () => {
    updateQueryParams();
});
</script>

<template>
    <Head title="Leaders" />

    <AppLayout>
        <PageHeader
            title="Historical Leaders"
            subtitle="Discover the remarkable individuals who shaped civilizations and changed the course of history"
        />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Search and filter controls -->
                        <div class="mb-6 flex flex-col md:flex-row justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <label for="search" class="sr-only">Search</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input
                                        type="search"
                                        name="search"
                                        id="search"
                                        v-model="search"
                                        @input="handleSearchInput"
                                        class="block w-full rounded-md border-0 py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        placeholder="Search leaders..."
                                    />
                                </div>
                            </div>
                            <div class="flex flex-row gap-4">
                                <div class="min-w-32">
                                    <label for="pageSize" class="sr-only">Items per page</label>
                                    <select
                                        id="pageSize"
                                        v-model="pageSize"
                                        @change="handlePageSizeChange"
                                        class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
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
                                        class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
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
                            <svg class="animate-spin h-8 w-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>

                        <!-- Leaders list -->
                        <div v-else-if="leaders.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div v-for="leader in leaders" :key="leader.id" class="border p-4 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <img v-if="leader.icon" :src="leader.icon" :alt="leader.name" class="w-12 h-12 object-cover rounded-full">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold truncate">{{ leader.name }}</h3>
                                        <p v-if="leader.subtitle" class="text-sm text-gray-600 truncate">{{ leader.subtitle }}</p>
                                        <p v-if="leader.civilization" class="text-sm text-gray-500 truncate">
                                            Civilization: {{ leader.civilization.name }}
                                        </p>
                                        <p v-if="leader.lived" class="text-xs text-gray-500">{{ leader.lived }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Empty state -->
                        <div v-else class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No leaders found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try changing your search criteria or clear filters.</p>
                        </div>

                        <!-- Pagination controls -->
                        <div v-if="leaders.length > 0" class="mt-6">
                            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                <span class="text-sm text-gray-700">
                                    Showing <span class="font-semibold">{{ from }}</span> to <span class="font-semibold">{{ to }}</span> of <span class="font-semibold">{{ count }}</span> leaders
                                </span>
                                <div class="flex justify-center">
                                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                        <button
                                            @click="goToPage(currentPage - 1)"
                                            :disabled="currentPage <= 1"
                                            class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <span class="sr-only">Previous</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <!-- Page number buttons - show a limited number for better UI -->
                                        <template v-if="totalPages <= 7">
                                            <button
                                                v-for="pageNum in totalPages"
                                                :key="pageNum"
                                                @click="goToPage(pageNum)"
                                                :class="[
                                                    'relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0',
                                                    pageNum === currentPage
                                                        ? 'bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                                        : 'text-gray-900 hover:bg-gray-50'
                                                ]"
                                            >
                                                {{ pageNum }}
                                            </button>
                                        </template>

                                        <template v-else>
                                            <!-- First page -->
                                            <button
                                                @click="goToPage(1)"
                                                :class="[
                                                    'relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0',
                                                    1 === currentPage
                                                        ? 'bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                                        : 'text-gray-900 hover:bg-gray-50'
                                                ]"
                                            >
                                                1
                                            </button>

                                            <!-- Ellipsis if needed -->
                                            <span v-if="currentPage > 3" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">
                                                ...
                                            </span>

                                            <!-- Pages around current -->
                                            <button
                                                v-for="offset in 3"
                                                :key="'mid-' + offset"
                                                v-if="currentPage - 2 + offset > 1 && currentPage - 2 + offset < totalPages"
                                                @click="goToPage(currentPage - 2 + offset)"
                                                :class="[
                                                    'relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0',
                                                    currentPage - 2 + offset === currentPage
                                                        ? 'bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                                        : 'text-gray-900 hover:bg-gray-50'
                                                ]"
                                            >
                                                {{ currentPage - 2 + offset }}
                                            </button>

                                            <!-- Ellipsis if needed -->
                                            <span v-if="currentPage < totalPages - 2" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">
                                                ...
                                            </span>

                                            <!-- Last page -->
                                            <button
                                                @click="goToPage(totalPages)"
                                                :class="[
                                                    'relative inline-flex items-center px-4 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0',
                                                    totalPages === currentPage
                                                        ? 'bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                                        : 'text-gray-900 hover:bg-gray-50'
                                                ]"
                                            >
                                                {{ totalPages }}
                                            </button>
                                        </template>

                                        <button
                                            @click="goToPage(currentPage + 1)"
                                            :disabled="currentPage >= totalPages"
                                            class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <span class="sr-only">Next</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
