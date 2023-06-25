<template>
    <AppLayout title="Data Dokumen SK">
        <!-- Search box -->
        <div class="max-w-sm">
            <InputField id="searchbox" name="searchbox" v-model="keyword" placeholder="Pencarian"/>
        </div>
        <!-- End Search Box -->
        <!-- Table Section -->
        <div class="mt-5">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-gray-700">
                            <!-- Header -->
                            <HeaderTable>
                                <template v-slot:title>Dokumen SK</template>
                                <template v-slot:description>Seluruh dokumen yang tersedia di dalam sistem.</template>
                                <template v-slot:action>
                                </template>
                            </HeaderTable>
                            <!-- End Header -->

                            <!-- Table -->
                            <MainTable>
                                <template v-slot:head>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Informasi File
                                            </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Unit
                                            </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Diterbitkan Pada
                                            </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-right"></th>
                                    </tr>
                                </template>

                                <template v-slot:body>
                                    <tr v-for="decree in decrees.data" :key="decree.id">
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                {{ decree.name }}
                                            </span>
                                                <span class="block text-sm text-gray-500">{{ decree.type }}</span>
                                            </div>
                                        </td>
                                        <td class="h-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                {{ decree.decreeable.name }}
                                            </span>
                                                <span class="block text-sm text-gray-500">
                                                    {{ decree.decreeable.unitable.degree }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm text-gray-800 dark:text-gray-200">
                                                    {{ new Date(decree.release_date).toLocaleDateString() }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-1.5">
                                                <a target="_blank" class="inline-flex items-center gap-x-1.5 text-sm text-blue-600 decoration-2 hover:underline font-medium"
                                                   :href="route('data.decrees.file', decree.file_path)">
                                                    Download
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </MainTable>
                            <!-- End Table -->

                            <!-- Footer -->
                            <FooterTable :meta="decrees.meta" :links="decrees.links"/>
                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Table Section -->
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Components/Layouts/AppLayout.vue";
import {useSearchBox} from "../../../Composables/useSearchBox.js";
import InputField from "../../../Components/InputField.vue";
import MainTable from "../../../Components/MainTable.vue";
import HeaderTable from "../../../Components/HeaderTable.vue";
import FooterTable from "../../../Components/FooterTable.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    decrees: {
        type: Object,
        required: true
    },
    keyword: {
        type: String,
        default: ''
    }
});

const {keyword} = useSearchBox(route('data.decrees.index'), props.keyword);
</script>
