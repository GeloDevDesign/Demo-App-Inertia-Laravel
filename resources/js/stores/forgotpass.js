import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";


export const useForgotPasswordStore = defineStore("fogot-pass", {
    state: () => ({
        currentSteps: 4,
        emailValue: {
            email: "",
        },
        authOTP: {
            otp: null,
        },
        newPasswordValue: {
            password: null,
            password_confirmation: null,
        },
    }),
    getters: {},
    actions: {
        verifyEmail: () => {
            emailValue.post("forgot-password", {
                onSuccess: () => emailValue.reset("email"),
                onSuccess: () => {
                    this.currentSteps++;
                },
            });
        },
        validateOTP: () => {
            authOTP.post("forgot-password", {
                onError: () => form.authOTP("otp"),
                onSuccess: () => {
                    this.currentSteps++;
                },
            });
        },
        validateNewPassword: () => {
            newPasswordValue.post("forgot-password", {
                onError: () =>
                    newPasswordValue.reset("password", "password_confirmation"),
                onSuccess: () => {
                    this.currentSteps++;
                },
            });
        },
    },
});
