<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div class="min-h-[calc(100vh-10px)] flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-white" />
            </a>
        </div>

        <div
            class="w-full mt-6 px-6 py-4 overflow-hidden sm:rounded-lg flex sm:justify-center items-center"
        >
            <div class="sm:max-w-3xl ">
                <slot />
            </div>
        </div>
    </div>
</template>
