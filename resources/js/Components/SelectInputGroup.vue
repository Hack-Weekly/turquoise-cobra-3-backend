<script setup>
import { onMounted, ref } from "vue";

const props= defineProps(["modelValue", "label", "options"]);
defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value?.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <label class="input-group mt-1 p-0 bg-transparent border-0">
    <span class="bg-primary text-slate-700 w-4/12 text-xl">{{ label }}</span>
    <select
    class="select select-bordered select-primary w-8/12 rounded-md shadow-sm input block max-w-full text-base-content focus:ring-0 focus:outline-none focus:border-primary-focus text-xl"
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
    >
        <slot></slot>
    </select>
  </label>
</template>
