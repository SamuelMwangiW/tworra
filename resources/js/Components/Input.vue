<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="border-gray-300 dark:bg-neutral-700 focus:border-indigo-300 focus:ring-3 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-xs"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
