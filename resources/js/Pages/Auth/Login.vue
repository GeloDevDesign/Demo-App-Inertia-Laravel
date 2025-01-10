<script setup>
import { Link } from "@inertiajs/vue3";
import navLink from "../Components/navLink.vue";
import inputTag from "../Components/input.vue";
import { router, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: null,
});

const form = useForm({
    email: "",
    password: "",
    remember: null,
});

const submit = () => {
    form.post("/login", {
        onError: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Login">
        <meta name="description" content="this is meta tag" />
    </Head>

    <div class="flex justify-center items-center h-full flex-col gap-6">
        <div>
            <span class="font-semibold text-2xl text-primary">
                Welcome Back</span
            >
        </div>
        <div class="w-11/12 sm:max-w-sm md:max-w-md lg:w-full">
            <form
                @submit.prevent="submit"
                class="w-full space-y-6"
                method="POST"
                action=""
            >
                <inputTag
                    :errors="form.errors.email"
                    v-model="form.email"
                    type="text"
                    name="name"
                    pagename="Email"
                />
                <inputTag
                    :errors="form.errors.password"
                    v-model="form.password"
                    type="password"
                    name="name"
                    pagename="Password"
                />

                <div class="flex items-center justify-between">
                    <div class="form-control">
                        <label class="label cursor-pointer space-x-2">
                            <input
                                v-model="form.remember"
                                type="checkbox"
                                checked="checked"
                                class="checkbox checkbox-secondary"
                            />
                            <span class="label-text">Remember me</span>
                        </label>
                    </div>
                    <div class="flex justify-center">
                        <p class="text-sm">
                            Don't have an account?
                            <Link
                                class="link text-blue-500 font-bold"
                                :href="route('register')"
                            >
                                Sign up here.
                            </Link>
                        </p>
                    </div>
                </div>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="btn btn-primary w-full mt-4"
                >
                    Login
                </button>
            </form>
        </div>
    </div>
</template>
