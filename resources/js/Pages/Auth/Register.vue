<script setup>
import { ref, computed } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import NavLink from "../Components/navLink.vue";
import inputLayout from "../Components/input.vue";
import { formToJSON } from "axios";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    avatar: null,
});

const submit = () => {
    form.post("/register-test", {
        onError: () => form.reset("password", "password_confirmation"),
        forceFormData: true,
        preserveScroll: true,
    });
};

defineOptions({
    layout: null,
});

defineProps({
    page: String,
});

const addFiles = (fileValue) => {
    form.avatar = fileValue[0];
};
</script>

<template>
    <Head title="Register"></Head>
    <div class="flex flex-col items-center justify-center w-full h-full">
        <h1 class="text-2xl font-semibold text-primary">Registration Page</h1>

        <div
            class="flex items-center justify-center w-11/12 sm:max-w-sm md:max-w-md lg:w-full"
        >
            <form @submit.prevent="submit" class="w-full flex flex-col gap-4">
                <inputLayout
                    type="text"
                    :errors="form.errors.name"
                    name="name"
                    pagename="Name"
                    placeholder="Enter your Name"
                    v-model="form.name"
                />

                <inputLayout
                    type="email"
                    :errors="form.errors.email"
                    name="email"
                    pagename="Email"
                    placeholder="Enter your Email"
                    v-model="form.email"
                />

                <inputLayout
                    type="password"
                    :errors="form.errors.password"
                    name="password"
                    pagename="Password"
                    placeholder="Enter your Password"
                    v-model="form.password"
                />

                <inputLayout
                    type="password"
                    :errors="form.errors.password"
                    name="password"
                    pagename="Confirm Password"
                    placeholder="Enter your Password"
                    v-model="form.password_confirmation"
                />

                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">Upload Profile</span>
                    </div>
                    <input
                        type="file"
                        class="file-input file-input-bordered w-full"
                        id="avatar"
                        @input="addFiles($event.target.files)"
                    />
                    <span
                        v-if="form.errors.avatar"
                        class="text-red-500 text-sm"
                    >
                        {{ form.errors.avatar }}
                    </span>
                </label>

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
