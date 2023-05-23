<template>
    <Head title="Lupa Password"/>
    <div class="dark:bg-slate-900 bg-gray-100 flex h-screen items-center py-16">

        <main class="w-full max-w-md mx-auto p-6">
            <div
                class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <img :src="ForgotIllustration" alt="FingerPrintBro" class="w-52 mx-auto">
                        <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Lupa Password</h1>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Masukan email anda dan kami akan mengirim tautan untuk melakukan reset password
                        </p>
                    </div>
                    <!--        todo : implement sent link successful session-->
                    <div class="mt-5">
                        <!-- Form -->
                        <form @submit.prevent="submit">
                            <div class="grid gap-y-4">
                                <!-- Form Group -->
                                <div>
                                    <InputLabel for="email">Email</InputLabel>
                                    <InputField id="email" name="email" type="email" v-model="form.email"
                                                :error="form.errors.email"/>
                                    <InputError v-if="form.errors.email" id="email">
                                        {{ form.errors.email }}
                                    </InputError>
                                </div>
                                <!-- End Form Group -->

                                <!-- Submit Button -->
                                <PrimaryButton type="submit">
                                    Send Reset Link
                                </PrimaryButton>
                                <!-- End Submit Button -->
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import InputField from "@/Components/InputField.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ForgotIllustration from "@assets/images/forgot-illustration.png"

const form = useForm({
    email: '',
});
const submit = () => {
    form.post(route('password.email'), {
        preserveScroll: true,
        onError: () => {
            form.reset('password');
        },
    });
}
</script>
