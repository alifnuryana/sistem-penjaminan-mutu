<template>
    <AppLayout title="Data SK">
        <div class="mt-5">
        <!--card-->
            <div class="flex flex-col">
                <div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
                    <!--Header-->
                    <HeaderTable>
                        <template v-slot:title>Surat Keputusan (SK)</template>
                        <template v-slot:description>Seluruh SK yang terdaftar</template>
                    </HeaderTable>
                    <!--Table-->
                    <MainTable>
                        <template v-slot:head>
                            <tr class="font-medium">
                                <th scope="col" class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3 text-left">
                                    <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Document
                                            </span>
                                    </div>
                                </th>
                                <th scope="col" class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3 text-left">
                                    <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Nama
                                            </span>
                                    </div>
                                </th>
                                <th scope="col" class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3 text-left">
                                    <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Tipe
                                            </span>
                                    </div>
                                </th>
                                <th scope="col" class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3 text-left">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                            Masa Berlaku
                                        </span>
                                    </div>
                                </th>
                                <th></th>
                            </tr>
                        </template>

                        <template v-slot:body>
                            <tr v-for="decree in props.decrees">
                                <td class="h-px w-px whitespace-nowrap">
                                    <div class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3">
                                        <a :href="route('data.decrees.file', decree.path)" class="group hover:text-blue-500" target="_blank">
                                            <span class="inline-flex items-center gap-1 group-hover:underline">
                                                <DocumentIcon class="w-5 h-5"/>
                                                {{decree.path}}
                                            </span>

                                        </a>
                                    </div>
                                </td>
                                <td class="h-px w-px whitespace-nowrap">
                                    <div class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                {{decree.name}}
                                            </span>
                                    </div>
                                </td>
                                <td class="h-px w-px whitespace-nowrap">
                                    <div class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                {{decree.type}}
                                            </span>
                                    </div>
                                </td>
                                <td class="h-px w-px whitespace-nowrap">
                                    <div class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3">
                                            <span v-if="decree.validity_date != null" :class="[ decree.validity_date > decree.current_date ? 'text-green-500' : 'text-red-500' , 'block text-sm font-semibold']">
                                                {{decree.validity_date}}
                                            </span>
                                            <span v-else class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                Tidak Ada
                                            </span>
                                    </div>
                                </td>
                                <td class="h-px w-px whitespace-nowrap">
                                    <div class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3">
                                        <a :href="route('data.decrees.detail', 1)" class=" text-blue-500 font-semibold hover:underline">Detail</a>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </MainTable>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Components/Layouts/AppLayout.vue";
import HeaderTable from "@/Components/HeaderTable.vue";
import MainTable from "@/Components/MainTable.vue";
import {DocumentIcon} from "@heroicons/vue/24/outline/index.js";

const props = defineProps({
    decrees : {
        default : null,
        required : true
    }
});
</script>
