<script setup>
import { ref } from "vue";
import titlePage from "../Components/titlePage.vue";
import inputTag from "../Components/input.vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "../Components/PrimaryButton.vue";
import { useForgotPasswordStore } from "../../stores/forgotpass";
import { Link } from "@inertiajs/vue3";

const store = useForgotPasswordStore();

const form = useForm({
    email: "",
});

const submit = () => {
    form.post("forgot-password", {
        onError: () => form.reset("email"),
    });
};

defineOptions({
    layout: null,
});

</script>

<template>
    <div class="flex justify-center items-center h-full flex-col gap-6 w-full">
        <div>
            <titlePage title="Forgot Password" />
        </div>
        <div>
            <ul class="steps">
                <li class="step step-primary">Input Email</li>
                <li
                    :class="store.currentSteps >= 2 ? 'step-primary' : ''"
                    class="step"
                >
                    Enter OTP
                </li>
                <li
                    :class="store.currentSteps >= 3 ? 'step-primary' : ''"
                    class="step"
                >
                    New Password
                </li>
                <li
                    :class="store.currentSteps >= 4 ? 'step-primary' : ''"
                    class="step"
                >
                    Sign In
                </li>
            </ul>
        </div>

        <div v-if="store.currentSteps <= 1" class="w-full max-w-md">
            <form @submit.prevent="submit" method="POST" class="space-y-6">
                <inputTag
                    :errors="form.errors.email"
                    v-model="form.email"
                    type="email"
                    name="email"
                    pagename="Email"
                />
                <PrimaryButton
                    type="submit"
                    routeName="password.request"
                    buttonName="Verify Email"
                    :disabled="form.processing"
                />

                <!-- <button class="btn btn-primary w-full">Next Step</button> -->
            </form>
            <div class="text-center">
                Doesnt have Account yet ?
                <Link class="link text-primary font-semibold" :href="route('register')">
                    Register
                </Link>
            </div>
        </div>

        <div v-if="store.currentSteps === 2" class="w-full max-w-md">
            <form @submit.prevent="submit" method="POST" class="space-y-6">
                <inputTag
                    :errors="form.errors.email"
                    v-model="form.email"
                    type="email"
                    name="email"
                    pagename="OTP"
                />
                <PrimaryButton
                    type="submit"
                    routeName="password.request"
                    buttonName="Verify Email"
                    :disabled="form.processing"
                />

                <!-- <button class="btn btn-primary w-full">Next Step</button> -->
            </form>
            <div class="text-center">
                Doesnt have Account yet ?
                <Link class="link text-primary font-semibold" :href="route('register')">
                    Register
                </Link>
            </div>
        </div>  

        <div v-if="store.currentSteps === 3" class="w-full max-w-md">
            <form @submit.prevent="submit" method="POST" class="space-y-6">
                <inputTag
                    :errors="form.errors.email"
                    v-model="form.email"
                    type="email"
                    name="email"
                    pagename="New Password"
                />

                <inputTag
                    :errors="form.errors.email"
                    v-model="form.email"
                    type="email"
                    name="email"
                    pagename="Confirm Password"
                />
                <PrimaryButton
                    type="submit"
                    routeName="password.request"
                    buttonName="Verify Email"
                    :disabled="form.processing"
                />

                <!-- <button class="btn btn-primary w-full">Next Step</button> -->
            </form>
            <div class="text-center">
                Doesnt have Account yet ?
                <Link class="link text-primary font-semibold" :href="route('register')">
                    Register
                </Link>
            </div>
        </div>


    </div>
</template>
