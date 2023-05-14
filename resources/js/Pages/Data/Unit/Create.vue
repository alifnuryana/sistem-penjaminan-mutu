<template>
    <AppLayout title="Tambah Unit">
        <!-- Card Section -->
        <div class="max-w-5xl w-full">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                <form @submit.prevent="submit">
                    <!-- Section -->
                    <div
                        class="grid grid-cols-12 gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-gray-700">
                        <div class="col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                Informasi Dasar
                            </h2>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-3">
                            <InputLabel for="name" class="mt-3">
                                Kode Unit
                            </InputLabel>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-9">
                            <InputField id="name" name="name" type="text" readonly :error="form.errors.code"
                                        v-model="form.code"/>
                            <InputError id="name" v-if="form.errors.code">
                                {{ form.errors.code }}
                            </InputError>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-3">
                            <InputLabel for="name" class="mt-3">
                                Nama Unit
                            </InputLabel>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-9">
                            <InputField id="name" name="name" type="text" :error="form.errors.name"
                                        v-model="form.name"/>
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
                            <InputField id="email" name="email" type="email" :error="form.errors.email"
                                        v-model="form.email" placeholder="@widyatama.ac.id"/>
                            <InputError id="email" v-if="form.errors.email">
                                {{ form.errors.email }}
                            </InputError>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-3">
                            <InputLabel for="degree" class="mt-3">Jenjang</InputLabel>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-9">
                            <!-- TODO : jadikan select input sebagai komponen terpisah -->
                            <select id="degree"
                                    v-model="form.degree"
                                    class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
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

                    <!-- Section -->
                    <div
                        class="grid grid-cols-12 gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-gray-700">
                        <div class="col-span-12">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                SK
                            </h2>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-3">
                            <InputLabel for="decree" class="mt-3">SK Pendirian</InputLabel>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-9">
                            <!-- TODO : jadikan file input sebagai komponen terpisah -->
                            <label class="block">
                                <input type="file" id="decree" name="decree"
                                       @input="form.decree = $event.target.files[0]" class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-500 file:text-white
                                  hover:file:bg-blue-600
                                "/>
                            </label>
                            <InputError id="decree" v-if="form.errors.decree">
                                {{ form.errors.decree }}
                            </InputError>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-3">
                            <InputLabel for="decree_number" class="mt-3">Nomor SK</InputLabel>
                        </div>
                        <!-- End Col -->

                        <div class="col-span-9">
                            <InputField id="decree_number" name="decree_number" type="text" v-model="form.decree_number"
                                        :error="form.errors.decree_number"/>
                            <InputError id="decree_number" v-if="form.errors.decree_number">
                                {{ form.errors.decree_number }}
                            </InputError>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Section -->

                    <div class="flex w-full justify-end">
                        <PrimaryButton type="submit">
                            Submit
                        </PrimaryButton>
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
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    code: {
        type: String,
        required: true,
    }
});

const form = useForm({
    code: props.code,
    name: "",
    email: "",
    degree: "",
    decree_number: "",
    decree: "",
});

const submit = function () {
    form.post(route('data.units.store'))
};
</script>
