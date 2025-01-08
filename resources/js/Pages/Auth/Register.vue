<script setup>
import { ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";

import navLink from "../Components/navLink.vue";

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
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Name</span>
                    </div>
                    <input
                        name="name"
                        type="text"
                        v-model="form.name"
                        placeholder="Type here"
                        class="input input-bordered w-full"
                    />
                </label>

                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Email</span>
                    </div>
                    <input
                        name="email"
                        type="email"
                        v-model="form.email"
                        placeholder="Type here"
                        class="input input-bordered w-full"
                    />
                </label>

                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Password</span>
                    </div>
                    <input
                        name="password"
                        type="password"
                        v-model="form.password"
                        placeholder="Type here"
                        class="input input-bordered w-full"
                    />
                </label>

                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Confirm Password</span>
                    </div>
                    <input
                        name="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        placeholder="Type here"
                        class="input input-bordered w-full"
                    />
                </label>
                <p class="mt-4">
                    Already Login?
                    <Link
                        class="link text-blue-500 font-bold"
                        :href="route('login')"
                        >Login</Link
                    >
                </p>
                <button type="submit" class="btn btn-primary w-full mt-4">
                    Register
                </button>
            </form>
        </div>
    </div>
</template>
