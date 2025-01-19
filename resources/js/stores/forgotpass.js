import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";

export const useForgotPasswordStore = defineStore("forgot-pass", {
    state: () => ({
        currentSteps: 1,
        emailValue: useForm({
            email: "",
        }),
        authOTP: useForm({
            otp: "",
        }),
        newPasswordValue: useForm({
            password: "",
            password_confirmation: "",
        }),
    }),
    actions: {
        verifyEmail() {
            this.emailValue.post(route("password.email"), {
                onSuccess: () => {
                    this.emailValue.reset("email");
                    this.currentSteps++;
                },
            });
        },
        validateOTP() {
            this.authOTP.post(route("verify.otp"), {
                onSuccess: () => {
                    this.authOTP.reset("otp");
                    this.currentSteps++;
                },
            });
        },
        validateNewPassword() {
            this.newPasswordValue.post(route("password.update"), {
                onSuccess: () => {
                    this.newPasswordValue.reset(
                        "password",
                        "password_confirmation"
                    );
                    this.currentSteps++;
                },
            });
        },
    },
});
