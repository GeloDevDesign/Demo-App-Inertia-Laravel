<!-- components/input.vue -->
<script setup>
import { computed } from "vue";

const model = defineModel({
    type: [String, Number], 
    required: true, 
});


const props = defineProps({
    name: String,
    pagename: String,
    type: String,
    placeholder: String,
    errors: Object,
});
</script>

<template>
    <div class="">
        <label class="form-control w-full">
            <div class="label">
                <span class="label-text">{{ pagename }}</span>
            </div>

            <input
                :name="name"
                :type="type"
                :placeholder="placeholder"
                class="input input-bordered w-full"
                v-model="model"
                :class="errors ? 'border-red-500' : ''"
            />
        </label>
        <span v-if="errors" class="text-red-500 text-sm">
            {{ errors }}
        </span>
    </div>
</template>
