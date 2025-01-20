import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";

export const useForgotPasswordStore = defineStore("forgot-pass", {
    state: () => ({
        currentSteps: 1,
        emailValue: useForm({
            email: "",
        }),
        authOTP: useForm({
            otp: null,
        }),
        newPasswordValue: useForm({
            password: null,
            password_confirmation: null,
        }),
    }),
    actions: {
        verifyEmail() {
            this.emailValue.post(route("password.email"), {
                onSuccess: () => {
                    this.emailValue.reset("email");
                    this.currentSteps++;
                },
                onError: (errors) => {
                    this.currentSteps = 1;
                },
            });
        },
        validateOTP() {
            this.authOTP.post(route("password.reset"), {
                onSuccess: () => {
                    this.authOTP.reset("otp");
                    this.currentSteps++;
                },

                onError: (errors) => {
                    this.currentSteps = 2;
                },
            });
        },
        validateNewPassword() {
            this.newPasswordValue.post(route("password.update"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.newPasswordValue.reset();
                    this.currentSteps++;
                },
                onError: (errors) => {
                    this.currentSteps = 3;
                },
            });
        },
    },
});
