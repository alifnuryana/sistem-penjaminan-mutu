<template>
    <AppLayout title="Data Unit">
        <!-- Table Section -->
        <div class="">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-gray-700">
                            <!-- Header -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                        Unit
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Seluruh data unit yang terdaftar.
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <Transition enter-active-class="duration-300 ease-out"
                                                    enter-from-class="transform opacity-0"
                                                    enter-to-class="opacity-100"
                                                    leave-active-class="duration-200 ease-in"
                                                    leave-from-class="opacity-100"
                                                    leave-to-class="transform opacity-0"
                                        >
                                            <button v-if="unitChecked.length >= 1" as="button"
                                                    @click="deleteCheckedUnit"
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                                            >
                                                Hapus
                                            </button>
                                        </Transition>

                                        <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                                           href="#">
                                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16"
                                                 height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="M2.63452 7.50001L13.6345 7.5M8.13452 13V2"
                                                      stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                            Tambahkan Unit
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-slate-800">
                                <tr>
                                    <th scope="col" class="pl-6 py-3 text-left">
                                        <label for="hs-at-with-checkboxes-main" class="flex">
                                            <input type="checkbox"
                                                   v-model="checkedAll"
                                                   @change="checkAll"
                                                   class="shrink-0 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                   id="hs-at-with-checkboxes-main">
                                        </label>
                                    </th>

                                    <th scope="col" class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3 text-left">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Nama
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Email
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                              Akreditasi
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-right"></th>
                                </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <tr v-for="unit in units.data" :key="unit.id">
                                    <td class="h-px w-px whitespace-nowrap">
                                        <div class="pl-6 py-3">
                                            <label :for="`hs-at-with-checkboxes-${unit.id}`" class="flex">
                                                <input type="checkbox"
                                                       class="shrink-0 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                       :id="`hs-at-with-checkboxes-${unit.id}`"
                                                       :value="unit.id"
                                                       v-model="unitChecked"
                                                >
                                            </label>
                                        </div>
                                    </td>
                                    <td class="h-px w-px whitespace-nowrap">
                                        <div class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                {{ unit.name }}
                                            </span>
                                            <span class="block text-sm text-gray-500">{{ unit.code }}</span>
                                        </div>
                                    </td>
                                    <td class="h-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                {{ unit.unitable_type }}
                                            </span>
                                            <span class="block text-sm text-gray-500">{{ unit.email }}</span>
                                        </div>
                                    </td>
                                    <td class="h-px w-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                <CheckCircleIcon class="w-4 h-4"/>
                                                Aktif
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-px whitespace-nowrap">
                                        <div class="px-6 py-1.5">
                                            <a class="inline-flex items-center gap-x-1.5 text-sm text-blue-600 decoration-2 hover:underline font-medium"
                                               href="#">
                                                Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Total
                                        <span class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ units.meta.from }}
                                        </span>
                                        -
                                        <span class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ units.meta.to }}
                                        </span>
                                        dari
                                        <span
                                            class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ units.meta.total }}
                                        </span>
                                        hasil.
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <Link
                                            v-if="units.links.prev"
                                            type="button"
                                            :href="units.links.prev"
                                            class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                                            <ChevronLeftIcon class="w-4 h-4"/>
                                            Prev
                                        </Link>

                                        <Link v-if="units.links.next"
                                              type="button"
                                              :href="units.links.next"
                                              class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                                            Next
                                            <ChevronRightIcon class="w-4 h-4"/>
                                        </Link>
                                    </div>
                                </div>
                            </div>
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
import {CheckCircleIcon, ChevronRightIcon, ChevronLeftIcon} from "@heroicons/vue/24/solid/index.js";
import {Link, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";

const props = defineProps({
    units: {
        type: Object,
        required: true
    },
});

const checkedAll = ref(false);
const unitChecked = ref([]);

watch(unitChecked, function () {
    if (unitChecked.value.length === props.units.data.length) {
        checkedAll.value = true;
    } else {
        checkedAll.value = false;
    }
});

function checkAll() {
    if (checkedAll.value) {
        unitChecked.value = props.units.data.map((unit) => unit.id);
    } else {
        unitChecked.value = [];
    }
}

const deleteCheckedUnit = function () {
    if (unitChecked.value.length > 0) {
        console.log(unitChecked.value.join(','));
        if (confirm('Apakah anda yakin ingin menghapus unit yang dipilih?')) {
            router.visit(route('data.units.destroys'), {
                data: {
                    ids: unitChecked.value,
                },
                method: 'delete',
                preserveScroll: true,
            });
        }
    }
};
</script>
