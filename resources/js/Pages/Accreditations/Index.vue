<template>
    <AppLayout title="Akreditasi">
        <!-- Alert -->
        <AlertDiscovery>
            <template v-slot:title>
                Status Akreditasi
            </template>
            <template v-slot:messages>
                <span v-if="unitNotAccreditedCount === 0">
                    Seluruh unit sudah terakreditasi.
                </span>
                <span v-else>
                    Terdapat {{ unitNotAccreditedCount }} unit yang belum terakreditasi.
                </span>
            </template>
        </AlertDiscovery>
        <!-- End Alert -->

        <!-- Search box -->
        <div class="max-w-sm mt-5">
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
                                <template v-slot:title>Akreditasi</template>
                                <template v-slot:description>Seluruh data akreditasi di dalam sistem</template>
                                <template v-slot:action>
                                    <Transition enter-active-class="duration-300 ease-out"
                                                enter-from-class="transform opacity-0"
                                                enter-to-class="opacity-100"
                                                leave-active-class="duration-200 ease-in"
                                                leave-from-class="opacity-100"
                                                leave-to-class="transform opacity-0"
                                    >
                                        <button v-if="checkedData.length >= 1" as="button"
                                                @click="deleteCheckedAccreditation"
                                                class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                                        >
                                            Hapus
                                        </button>
                                    </Transition>
                                    <Link as="button"
                                          class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                                          :href="route('accreditations.create')">
                                        <PlusIcon class="w-4 h-4"/>
                                        Catat Akreditasi
                                    </Link>
                                </template>
                            </HeaderTable>
                            <!-- End Header -->

                            <!-- Table -->
                            <MainTable>
                                <template v-slot:head>
                                    <tr>
                                        <th scope="col" class="pl-6 py-3 text-left">
                                            <label for="hs-at-with-checkboxes-main" class="flex">
                                                <input type="checkbox"
                                                       v-model="isCheckedAll"
                                                       @change="checkAll"
                                                       class="shrink-0 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                       id="hs-at-with-checkboxes-main">
                                            </label>
                                        </th>

                                        <th scope="col" class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Kode
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
                                              Hasil Akrediasi
                                            </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left">
                                            <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                Masa Berlaku
                                            </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-right"></th>
                                    </tr>
                                </template>

                                <template v-slot:body>
                                    <tr v-for="accreditation in accreditations.data" :key="accreditation.id">
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="pl-6 py-3">
                                                <label :for="`hs-at-with-checkboxes-${accreditation.id}`" class="flex">
                                                    <input type="checkbox"
                                                           class="shrink-0 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                           :id="`hs-at-with-checkboxes-${accreditation.id}`"
                                                           :value="accreditation.id"
                                                           v-model="checkedData"
                                                    >
                                                </label>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3">
                                                <span class="block text-sm text-gray-800 dark:text-gray-300">
                                                    {{ accreditation.code }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-gray-300">
                                                {{ accreditation.unit.name }} {{ accreditation.unit.unitable.degree}}
                                                </span>
                                                <span
                                                    v-if="accreditation.status === 'active'"
                                                    class="inline-flex items-center mt-1 gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    <CheckCircleIcon class="w-4 h-4"/>
                                                    <!--TODO: lakukan cek apakah unit tersebut memiliki akreditasi yang aktif atau tidak -->
                                                    Aktif
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm text-gray-800 dark:text-gray-300">
                                                    {{ accreditation.grade }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-gray-300">
                                                    {{ new Date(accreditation.decree.validity_date).toLocaleDateString() }}
                                            </span>
                                                <span class="block text-sm text-gray-500">
                                                    {{ dayjs(accreditation.decree.validity_date).fromNow() }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-1.5">
                                                <!-- TODO : implementasikan halaman detail unit -->
                                                <a class="inline-flex items-center gap-x-1.5 text-sm text-blue-600 decoration-2 hover:underline font-medium"
                                                   href="#">
                                                    Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </MainTable>
                            <!-- End Table -->

                            <!-- Footer -->
                            <FooterTable :meta="accreditations.meta" :links="accreditations.links"/>
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
import AppLayout from "../../Components/Layouts/AppLayout.vue";
import InputField from "../../Components/InputField.vue";
import {useSearchBox} from "../../Composables/useSearchBox.js";
import FooterTable from "../../Components/FooterTable.vue";
import MainTable from "../../Components/MainTable.vue";
import HeaderTable from "../../Components/HeaderTable.vue";
import {Link, router} from "@inertiajs/vue3";
import {useMultipleCheckbox} from "../../Composables/useMultipleCheckbox.js";
import {PlusIcon, CheckCircleIcon} from "@heroicons/vue/24/outline/index.js";
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import 'dayjs/locale/id';
import AlertDiscovery from "../../Components/AlertDiscovery.vue";

dayjs.locale('id');
dayjs.extend(relativeTime);

const props = defineProps({
    accreditations: {
        type: Object,
        required: true
    },
    keyword: {
        type: String,
        required: false,
        default: '',
    },
    unitNotAccreditedCount: {
        type: Number,
        required: true,
    }
});

const {checkedData, checkAll, isCheckedAll} = useMultipleCheckbox(props.accreditations.data);
const {keyword} = useSearchBox(route('accreditations.index'), props.keyword)

const deleteCheckedAccreditation = function () {
    if (confirm('Apakah anda yakin ingin menghapus akreditasi yang dipilih?')) {
        router.visit(route('accreditations.destroys'), {
            data: {
                ids: checkedData.value,
            },
            method: 'delete',
            preserveScroll: true,
        });
    }
};

</script>
