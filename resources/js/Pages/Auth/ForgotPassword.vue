<script setup>
import { ref, toRef } from "vue";
import titlePage from "../Components/titlePage.vue";
import inputTag from "../Components/input.vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "../Components/PrimaryButton.vue";
import { useForgotPasswordStore } from "../../stores/forgotpass";
import { Link } from "@inertiajs/vue3";
import { storeToRefs } from "pinia";

const store = useForgotPasswordStore();
const { currentSteps, emailValue, authOTP, newPasswordValue } =
    storeToRefs(store);

defineOptions({
    layout: null,
});

// Handle email verification form
const handleEmailSubmit = () => {
    store.verifyEmail();
};

// Handle OTP verification form
const handleOTPSubmit = () => {
    store.validateOTP();
};

// Handle new password form
const handlePasswordSubmit = () => {
    store.validateNewPassword();
};
</script>

<template>
    <div class="flex justify-center items-center h-full flex-col gap-6 w-full">
        <!-- Steps and title remain the same -->
        <ul class="steps">
            <li class="step step-primary">Input Email</li>
            <li :class="currentSteps >= 2 ? 'step-primary' : ''" class="step">
                Enter OTP
            </li>
            <li :class="currentSteps >= 3 ? 'step-primary' : ''" class="step">
                New Password
            </li>
            <li :class="currentSteps >= 4 ? 'step-primary' : ''" class="step">
                Sign In
            </li>
        </ul>
        <!-- Email Form -->
        <div v-if="currentSteps <= 1" class="w-full max-w-md">
            <form
                @submit.prevent="handleEmailSubmit"
                method="POST"
                class="space-y-6"
            >
                <inputTag
                    :errors="emailValue.errors?.email"
                    v-model="emailValue.email"
                    type="email"
                    name="email"
                    pagename="Email"
                />
                <PrimaryButton
                    type="submit"
                    routeName="password.request"
                    buttonName="Verify Email"
                    :disabled="emailValue.processing"
                />
            </form>
            <div class="text-center">
                Doesn't have Account yet?
                <Link
                    class="link text-primary font-semibold"
                    :href="route('register')"
                >
                    Register
                </Link>
            </div>
        </div>

        <!-- OTP Form -->
        <div v-if="currentSteps === 2" class="w-full max-w-md">
            <form
                @submit.prevent="handleOTPSubmit"
                method="POST"
                class="space-y-6"
            >
                <inputTag
                    :errors="authOTP.errors?.otp"
                    v-model="authOTP.otp"
                    type="text"
                    name="otp"
                    pagename="OTP"
                />
                <PrimaryButton
                    type="submit"
                    routeName="verify.otp"
                    buttonName="Verify OTP"
                    :disabled="authOTP.processing"
                />
            </form>
        </div>

        <!-- New Password Form -->
        <div v-if="currentSteps === 3" class="w-full max-w-md">
            <form
                @submit.prevent="handlePasswordSubmit"
                method="POST"
                class="space-y-6"
            >
                <inputTag
                    :errors="newPasswordValue.errors?.password"
                    v-model="newPasswordValue.password"
                    type="password"
                    name="password"
                    pagename="New Password"
                />
                <inputTag
                    :errors="newPasswordValue.errors?.password_confirmation"
                    v-model="newPasswordValue.password_confirmation"
                    type="password"
                    name="password_confirmation"
                    pagename="Confirm Password"
                />
                <PrimaryButton
                    type="submit"
                    routeName="password.update"
                    buttonName="Update Password"
                    :disabled="newPasswordValue.processing"
                />
            </form>
        </div>

        <!-- Success Message -->
        <div v-if="currentSteps === 4" class="w-full max-w-md text-center">
            <div class="alert alert-success mb-4">
                Password successfully updated!
            </div>
            <Link :href="route('login')" class="btn btn-primary w-full">
                Back to Login
            </Link>
        </div>
    </div>
</template>
