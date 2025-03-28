<script setup lang="ts">
defineProps<{
    icon?: string;
    name: string;
    subtitle?: string;
    details?: string;
    timeInfo?: string;
    relatedEntity?: {
        name: string;
        prefix?: string;
    };
}>();
</script>

<template>
    <div class="border p-4 rounded-lg">
        <div class="flex items-center space-x-3">
            <img v-if="icon" :src="icon" :alt="name" class="w-12 h-12 object-cover rounded-full">
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-bold truncate">{{ name }}</h3>
                <p v-if="subtitle" class="text-sm text-gray-600 truncate">{{ subtitle }}</p>
                <p v-if="relatedEntity" class="text-sm text-indigo-600 font-medium">
                    {{ relatedEntity.prefix || 'Related to' }}: {{ relatedEntity.name }}
                </p>
                <p v-if="details" class="text-sm text-gray-600 line-clamp-2 mt-1">
                    {{ details }}
                </p>
                <p v-if="timeInfo" class="text-xs text-gray-500">{{ timeInfo }}</p>
            </div>
        </div>
    </div>
</template> 