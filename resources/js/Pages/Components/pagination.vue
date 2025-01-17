<script setup>


defineProps({
    users: Object,
});

</script>
<template>
    <div class="flex justify-between items-center mt-2 ">
        <div class="text-sm text-gray-600">
            Showing page {{ users.current_page }} of {{ users.last_page }}
        </div>
        <div class="join ">
            <Link
                prefetch
                cache-for="1m"
                v-for="(link, index) in users.links"
                :key="link.label"
                :href="link.url || '/'"
                class="join-item  btn font-normal "
                :class="{ 
                    'btn-primary  ': link.active,
                    'btn-disabled ': !link.url,
                }"
                v-html="link.label"
            />
        </div>
    </div>
</template>
