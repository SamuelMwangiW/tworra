<script setup>

defineProps({
    modelValue: String
})
defineEmits(['update:modelValue'])
</script>

<template>
    <div class="flex-1 w-full">
        <textarea
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            type="text h-fit"
            placeholder="What's happening?"
            class="w-full p-0 text-[1.25rem] focus:outline-hidden border-none focus:ring-0 resize-none h-fit dark:bg-neutral-900"
        ></textarea>
    </div>
</template>
