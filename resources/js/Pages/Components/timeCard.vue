<script setup>

const props = defineProps({
  header: String,
  description: String,
})


</script>

<template>
    <div class="indicator w-full cursor-pointer ">
        <span class="indicator-item indicator-center badge outline w-20 h-20"
            ><svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18"
                />
            </svg>
        </span>
        <div class="grid w-72 h-44 place-items-center rounded-lg"  >
            <div class="">
                <div class="text-center text-white ">
                    <h1 class="font-bold text-3xl">{{ props.header }}</h1>
                    <p class="font-semibold text-lg">{{ props.description }}</p>

                </div>
            </div>
        </div>
    </div>
</template>
