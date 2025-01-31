<script setup>
import { ref } from "vue";
import Nav from "../Shared/Nav.vue";
import Layout from "../Shared/Layout.vue";
import timeCard from "../Components/timeCard.vue";

defineProps({
    time: String,
});
</script>
<template>
    <Head title="Welcome"> </Head>
    <div class="flex justify-evenly items-center h-[90vh] flex-col">
        <div class="grid auto-cols-max grid-flow-col gap-5 text-center">
            <div class="flex flex-col">
                <span class="countdown font-mono text-8xl">
                    <span style="--value: 15"></span>
                </span>
                days
            </div>
            <div class="flex flex-col">
                <span class="countdown font-mono text-8xl">
                    <span style="--value: 10"></span>
                </span>
                hours
            </div>
            <div class="flex flex-col">
                <span class="countdown font-mono text-8xl">
                    <span style="--value: 24"></span>
                </span>
                min
            </div>
            <div class="flex flex-col">
                <span class="countdown font-mono text-8xl">
                    <span style="--value:${counter};"></span>
                </span>
                sec
            </div>
        </div>

        <div class="flex gap-4">
            <timeCard class="bg-info rounded-md"  header="Time in" description="Press Arrow up to Time in" />
            <timeCard class="bg-success rounded-md" header=" Break In" description="Press Arrow up to Time in" />
            <timeCard class="bg-warning rounded-md" header="Break Out" description="Press Arrow up to Time in"  />
            <timeCard class="bg-error rounded-md"  header="Time Out" description="Press Arrow up to Time in" color="accent" />
        </div>
    </div>
</template>
