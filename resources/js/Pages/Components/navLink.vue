<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage(); // Access the $page object

const props = defineProps({
  page: String,
  componenName: String,
  collapse: Boolean
});

const isActive = computed(() => {
  return page.url === props.componenName
    ? "btn-active btn-ghost"
    : "btn-ghost";
});
</script>

<template>
  <div class="w-full justify-center">
    <Link
      class="btn w-full btn-sm font-normal flex justify-start items-center"
      cache-for="1m"
      :class="isActive"
      prefetch
      :href="route(props.page)"
    >
      <!-- Icon Slot -->
      <slot  name="icon" />
      
      <!-- Name Slot -->
      <slot v-if="collapse" name="name" />
    </Link>
  </div>
</template>
