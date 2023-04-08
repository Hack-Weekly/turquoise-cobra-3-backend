<!-- Your Java Script Here -->
<script setup>

const props= defineProps(["size","src"]);

const classes=`h-[${props.size}px]`;
</script>

<!-- Your Markup Here -->
<template>
    <img :src="src" class="rounded-[100%] object-cover" :class="classes" alt="User Avatar Image" :height="size" :width="size"/>
</template>

<!-- Your Styles Here -->
<style scoped>

</style>
