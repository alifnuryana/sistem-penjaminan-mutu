<template>
    <Head title="Reset Password"/>
    <div class="dark:bg-slate-900 bg-gray-100 flex h-screen items-center py-16">
        <main class="w-full max-w-md mx-auto p-6">
            <!--todo : implementasi session error dan success-->
            <div
                class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <img :src="ResetIllustration" alt="Forgot Illustration" class="w-52 mx-auto">
                        <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Reset Password</h1>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Masukan Password Baru
                        </p>
                    </div>

                    <div class="mt-5">
                        <!-- Form -->
                        <form @submit.prevent="submit">
                            <div class="grid gap-y-4">
                                <!-- Form Group -->
                                <div>
                                    <InputField id="email" hidden name="email" type="email" v-model="form.email"/>
                                </div>
                                <!-- End Form Group -->

                                <!-- Form Group -->
                                <div>
                                    <div class="flex justify-between items-center">
                                        <InputLabel for="password">New Password</InputLabel>
                                    </div>
                                    <InputField id="password" name="password" type="password" v-model="form.password"
                                                :error="form.errors.password"/>
                                    <InputError v-if="form.errors.password" id="password">
                                        {{ form.errors.password }}
                                    </InputError>
                                </div>
                                <!-- End Form Group -->

                                <!--Form Group-->
                                <div>
                                    <div class="flex justify-between items-center">
                                        <InputLabel for="password">Password Confirmation</InputLabel>
                                    </div>
                                    <InputField id="password_confirmation" name="password_confirmation" type="password" v-model="form.password_confirmation"
                                                :error="form.errors.password_confirmation"/>
                                    <InputError v-if="form.errors.password_confirmation" id="password">
                                        {{ form.errors.password_confirmation }}
                                    </InputError>
                                </div>
                                <!--todo : watch password confirmation selama tidak sesuai dengan password baru dan berikan keterangan tidak sesuai-->

                                <!-- End Form Group -->

                                <!-- Submit Button -->
                                <PrimaryButton type="submit">
                                    Reset Password
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
import  ResetIllustration from "@assets/images/reset-illustration.png"



const props = defineProps({
    request: {
        required: true
    },
    token: {
        required: true
    }
})

const form = useForm({
    email: props.request.email,
    token: props.token,
    password: '',
    password_confirmation: '',
});


const submit = () => {
    form.post(route('password.update'), {
        preserveScroll: true,
        onError: () => {
            form.reset('password');
        },
    });
}
</script>
