<script setup>
import { useForm } from "@inertiajs/vue3";
import {ref,onMounted} from 'vue';
import sessionMessage from '../Components/sessionMessage.vue';

defineOptions({
    layout: null,
});

defineProps({
    status:String
})

const form = useForm({});

const submit = () => {
    form.post(route("verification.send"));
};

// onMounted(() => {
//     submit();
// });


</script>

<template>
    <Head title="Confirm Email">
        <meta name="description" content="Confirm your email to proceed" />
    </Head>

    <div class="flex justify-center h-full items-center p-10">
        <div class="card bg-neutral text-neutral-content max-w-96">
            <div class="card-body items-center text-center gap-4">
                <h2 class="card-title">Confirm Your Email</h2>
                
                <p>
                 
                    We've sent a confirmation link to your email address. Please
                    check your inbox and click the link to confirm your email.
                </p>
               
                    <form @submit.prevent="submit" action="" class="card-actions flex flex-col items-center">
                        <span class="text-sm text-success font-semibold" v-if="status">{{ status }}</span>
                        <button
                            :disabled="form.processing"
                            class="btn btn-primary"
                        >
                            Resend Email
                        </button>
                    </form>
              
            </div>
        </div>
    </div>
</template>
