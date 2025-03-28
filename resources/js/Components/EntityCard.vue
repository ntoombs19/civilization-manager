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
    <div class="relative overflow-hidden shadow-md rounded-lg transform-gpu hover:scale-102 transition-all duration-300 group">
        <div class="h-full flex flex-col overflow-hidden bg-gradient-to-br from-stone-800 to-stone-900 border border-amber-800/30 rounded-lg">
            <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-amber-700 via-amber-500 to-amber-700"></div>
            <div class="p-4">
                <div class="flex items-center space-x-3">
                    <img v-if="icon" :src="icon" :alt="name" class="w-12 h-12 object-cover rounded-full border border-amber-600/30 shadow-md">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold truncate text-amber-200">{{ name }}</h3>
                        <p v-if="subtitle" class="text-sm text-amber-300/80 truncate">{{ subtitle }}</p>
                        <p v-if="relatedEntity" class="text-sm text-amber-500 font-medium mt-1">
                            {{ relatedEntity.prefix || 'Related to' }}: {{ relatedEntity.name }}
                        </p>
                        <p v-if="details" class="text-sm text-amber-100/70 line-clamp-2 mt-2">
                            {{ details }}
                        </p>
                        <p v-if="timeInfo" class="text-xs text-amber-400/60 mt-1">{{ timeInfo }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template> 