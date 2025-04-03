<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

export type BreadcrumbType = {
    title: string;
    url: string;
    is_current_page: boolean;
};

export type BreadcrumbsType = BreadcrumbType[];

defineProps<{
    breadcrumbs: BreadcrumbsType;
}>();
</script>

<template>
    <nav>
        <ol class="flex flex-wrap items-center text-sm text-gray-500">
            <li v-for="(breadcrumb, i) in breadcrumbs" :key="i" class="flex">
                <svg
                    v-if="i !== 0"
                    class="mx-1 h-4 w-4 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    ></path>
                </svg>
                <template v-if="breadcrumb.url && i < breadcrumbs.length - 1">
                    <Link :href="breadcrumb.url" class="hover:text-amber-300">{{
                        breadcrumb.title
                    }}</Link>
                </template>
                <template v-else>
                    <span class="font-medium text-amber-300">{{
                        breadcrumb.title
                    }}</span>
                </template>
            </li>
        </ol>
    </nav>
</template>
