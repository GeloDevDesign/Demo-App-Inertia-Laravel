<script setup>
import { ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import NavLink from "../Components/navLink.vue";
import InputTag from "../Components/input.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post("/register-test");
};

defineOptions({
    layout: null,
});

defineProps({
    page: String,
});
</script>

<template>
    <Head title="Register"></Head>
    <div class="flex flex-col items-center justify-center w-full h-full">
        <h1 class="text-lg text-blue-500">Registration Page</h1>

        <div class="flex items-center justify-center">
            <form @submit.prevent="submit" class="w-96">
                <InputTag
                    v-model="form.name"
                    name="name"
                    type="text"
                    placeholder="Enter your name"
                    :errors="form.errors"
                >
                    Name
                </InputTag>

                <InputTag
                    v-model="form.email"
                    name="email"
                    type="email"
                    placeholder="Enter your email"
                    :errors="form.errors"
                >
                    Email
                </InputTag>

                <InputTag
                    v-model="form.password"
                    name="password"
                    type="password"
                    placeholder="Enter your password"
                    :errors="form.errors"
                >
                    Password
                </InputTag>

                <InputTag
                    v-model="form.password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Confirm your password"
                    :errors="form.errors"
                >
                    Confirm Password
                </InputTag>

                <p class="mt-4">
                    Already have an account?
                    <Link
                        class="link text-blue-500 font-bold"
                        :href="route('login')"
                    >
                        Login
                    </Link>
                </p>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="btn btn-primary w-full mt-4"
                >
                    Register
                </button>
            </form>
        </div>
    </div>
</template>
