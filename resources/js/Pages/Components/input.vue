<!-- components/input.vue -->
<script setup>
import { computed } from "vue";

const props = defineProps({
    modelValue: String,
    name: String,
    type: String,
    placeholder: String,
    errors: Object,
});

const emit = defineEmits(["update:modelValue"]);

const inputValue = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});
</script>

<template>
    <label class="form-control w-full mb-4">
        <div class="label">
            <span class="label-text"><slot /></span>
        </div>
        <input
            :name="name"
            :type="type"
            v-model="inputValue"
            :placeholder="placeholder || 'Type here'"
            class="input input-bordered w-full"
            :class="{ 'border-red-500': errors?.[name] }"
        />
    </label>
    <span v-if="errors?.[name]" class="text-red-500 text-sm mt-2">
        {{ errors[name] }}
    </span>
</template>
