<script setup lang="ts">
defineProps<{
    currentPage: number;
    totalPages: number;
    onPageChange: (page: number) => void;
}>();
</script>

<template>
    <nav
        class="isolate inline-flex -space-x-px rounded-md shadow-lg"
        aria-label="Pagination"
    >
        <button
            @click="onPageChange(currentPage - 1)"
            :disabled="currentPage <= 1"
            class="relative inline-flex items-center rounded-l-md border border-amber-700 bg-stone-900 px-2 py-2 text-amber-400 transition-colors duration-200 hover:bg-stone-800 focus:z-20 focus:outline-amber-500 focus:ring-1 focus:ring-amber-500 disabled:cursor-not-allowed disabled:opacity-40"
        >
            <span class="sr-only">Previous</span>
            <svg
                class="h-5 w-5"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
            >
                <path
                    fill-rule="evenodd"
                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>

        <!-- Page number buttons - show a limited number for better UI -->
        <template v-if="totalPages <= 7">
            <button
                v-for="pageNum in totalPages"
                :key="pageNum"
                @click="onPageChange(pageNum)"
                :class="[
                    'relative inline-flex items-center border border-amber-700 px-4 py-2 text-sm font-semibold transition-colors duration-200 focus:z-20 focus:outline-amber-500 focus:ring-1',
                    pageNum === currentPage
                        ? 'border-amber-500 bg-gradient-to-b from-amber-600 to-amber-800 font-bold text-stone-900 shadow-inner'
                        : 'bg-stone-900 text-amber-400 hover:bg-stone-800',
                ]"
            >
                {{ pageNum }}
            </button>
        </template>

        <template v-else>
            <!-- First page -->
            <button
                @click="onPageChange(1)"
                :class="[
                    'relative inline-flex items-center border border-amber-700 px-4 py-2 text-sm font-semibold transition-colors duration-200 focus:z-20 focus:outline-amber-500 focus:ring-1',
                    1 === currentPage
                        ? 'border-amber-500 bg-gradient-to-b from-amber-600 to-amber-800 font-bold text-stone-900 shadow-inner'
                        : 'bg-stone-900 text-amber-400 hover:bg-stone-800',
                ]"
            >
                1
            </button>

            <!-- Ellipsis if needed -->
            <span
                v-if="currentPage > 3"
                class="relative inline-flex items-center border border-amber-700 bg-stone-900 px-4 py-2 text-sm font-semibold text-amber-500"
            >
                ...
            </span>

            <!-- Pages around current -->
            <template v-for="i in 3" :key="'mid-' + i">
                <button
                    v-if="
                        currentPage - 2 + i > 1 &&
                        currentPage - 2 + i < totalPages
                    "
                    @click="onPageChange(currentPage - 2 + i)"
                    :class="[
                        'relative inline-flex items-center border border-amber-700 px-4 py-2 text-sm font-semibold transition-colors duration-200 focus:z-20 focus:outline-amber-500 focus:ring-1',
                        currentPage - 2 + i === currentPage
                            ? 'border-amber-500 bg-gradient-to-b from-amber-600 to-amber-800 font-bold text-stone-900 shadow-inner'
                            : 'bg-stone-900 text-amber-400 hover:bg-stone-800',
                    ]"
                >
                    {{ currentPage - 2 + i }}
                </button>
            </template>

            <!-- Ellipsis if needed -->
            <span
                v-if="currentPage < totalPages - 2"
                class="relative inline-flex items-center border border-amber-700 bg-stone-900 px-4 py-2 text-sm font-semibold text-amber-500"
            >
                ...
            </span>

            <!-- Last page -->
            <button
                @click="onPageChange(totalPages)"
                :class="[
                    'relative inline-flex items-center border border-amber-700 px-4 py-2 text-sm font-semibold transition-colors duration-200 focus:z-20 focus:outline-amber-500 focus:ring-1',
                    totalPages === currentPage
                        ? 'border-amber-500 bg-gradient-to-b from-amber-600 to-amber-800 font-bold text-stone-900 shadow-inner'
                        : 'bg-stone-900 text-amber-400 hover:bg-stone-800',
                ]"
            >
                {{ totalPages }}
            </button>
        </template>

        <button
            @click="onPageChange(currentPage + 1)"
            :disabled="currentPage >= totalPages"
            class="relative inline-flex items-center rounded-r-md border border-amber-700 bg-stone-900 px-2 py-2 text-amber-400 transition-colors duration-200 hover:bg-stone-800 focus:z-20 focus:outline-amber-500 focus:ring-1 focus:ring-amber-500 disabled:cursor-not-allowed disabled:opacity-40"
        >
            <span class="sr-only">Next</span>
            <svg
                class="h-5 w-5"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
            >
                <path
                    fill-rule="evenodd"
                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </nav>
</template>
