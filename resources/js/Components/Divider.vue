<style scoped>
.divider-cap {
    @apply absolute h-[3px] font-sans text-2xl leading-[0] text-amber-600;
}
</style>

<template>
    <div
        class="relative mx-auto mb-10 h-[3px] w-1/2 bg-gradient-to-r from-transparent via-amber-600 to-transparent text-center"
    >
        <span class="divider-cap -left-2.5">▸</span>
        <span class="divider-cap -right-2.5">◂</span>
    </div>
</template>
