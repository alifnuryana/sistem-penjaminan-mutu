<template>
    <AppLayout title="Tambah Unit">
        <!-- Card Section -->
        <div class="max-w-5xl w-full">
            <!-- Card -->
            <div
                class="bg-white rounded-xl border border-gray-200 p-4 sm:p-7 dark:bg-gray-800 dark:border-gray-700"
            >
                <form @submit.prevent="form.put(route('data.units.update', data.code))">
                    <!-- Section -->
                    <div
                        class="grid grid-cols-12 gap-4 py-8 first:pt-0 last:pb-0 first:border-transparent border-gray-200 dark:border-gray-700"
                    >
                        <div class="col-span-12">
                            <h2
                                class="text-lg font-semibold text-gray-800 dark:text-gray-200"
                            >
                                Informasi Dasar
                            </h2>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-3">
                            <InputLabel for="name" class="mt-3">
                                Nama Unit
                            </InputLabel>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-9">
                            <InputField
                                id="name"
                                name="name"
                                type="text"
                                :error="form.errors.name"
                                v-model="form.name"
                            />
                            <InputError id="name" v-if="form.errors.name">
                                {{ form.errors.name }}
                            </InputError>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-3">
                            <InputLabel for="email" class="mt-3">
                                Email Unit
                            </InputLabel>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-9">
                            <InputField
                                id="email"
                                name="email"
                                type="email"
                                :error="form.errors.email"
                                v-model="form.email"
                                placeholder="@widyatama.ac.id"
                            />
                            <InputError id="email" v-if="form.errors.email">
                                {{ form.errors.email }}
                            </InputError>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-3">
                            <InputLabel for="degree" class="mt-3"
                            >Jenjang</InputLabel
                            >
                        </div>
                        <!-- End Col -->

                        <div class="col-span-9">
                            <select
                                id="degree"
                                v-model="form.degree"
                                class="py-3 px-4 block border-gray-200 w-full rounded-md text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                            >
                                <option selected></option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                            <InputError id="degree" v-if="form.errors.degree">
                                {{ form.errors.degree }}
                            </InputError>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Section -->
                    <div class="flex w-full justify-end gap-3">
                        <PrimaryButton type="submit"> Simpan </PrimaryButton>
                        <Link
                            as="button"
                            class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-gray-500 text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                            :href="route('data.units.show', data.code)"
                        >
                            Batal
                        </Link>
                    </div>
                </form>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Card Section -->
    </AppLayout>
</template>

<script setup>
import AppLayout from "../../../Components/Layouts/AppLayout.vue";
import InputLabel from "../../../Components/InputLabel.vue";
import InputField from "../../../Components/InputField.vue";
import InputError from "../../../Components/InputError.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

import { toRef } from "vue";
import { useFilesPond } from "../../../Composables/useFilesPond.js";
import {Link} from "@inertiajs/vue3"

const props = defineProps({
    data:{
        required: true
    }
});

const form = useForm({
    name: props.data.name,
    email: props.data.email,
    degree: props.data.unitable.degree,
});

const { handleFilePondInit, handleAddPondFiles, handleRemovePondFiles } =
    useFilesPond(toRef(form, "decree"));

// const submit = function () {
//     form.submit(route('data.units.update', data.code))
// };
</script>
