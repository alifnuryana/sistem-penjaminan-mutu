<script setup>
import AppLayout from "../../../Components/Layouts/AppLayout.vue";
import InputField from "../../../Components/InputField.vue";
import { useSearchBox } from "../../../Composables/useSearchBox.js";
import MainTable from "../../../Components/MainTable.vue";
import HeaderTable from "../../../Components/HeaderTable.vue";
import { Link, router } from "@inertiajs/vue3";
import { useMultipleCheckbox } from "../../../Composables/useMultipleCheckbox.js";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import "dayjs/locale/id";
import FooterTableNew from "../../../Components/FooterTableNew.vue";
import { ref, toRef, watch } from "vue";

dayjs.locale("id");
dayjs.extend(relativeTime);

const props = defineProps({
    notifications: {
        type: Object,
        required: true,
    },
    keyword: {
        type: String,
        required: false,
        default: "",
    },
    filter: {
        required: true,
        default: [],
    },
});

const { checkedData, checkAll, isCheckedAll } = useMultipleCheckbox(
    props.notifications.data
);

const filter = ref(props.filter ? props.filter : []);
const notifications = toRef(props, "notifications");

const { keyword } = useSearchBox(
    route("data.notifications.index"),
    props.keyword,
    {
        filter: filter.value,
    }
);

watch(filter, (value) => {
    router.get(
        route("data.notifications.index"),
        {
            keyword: keyword.value,
            filter: value,
        },
        {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        }
    );
});

const deleteCheckedNotification = function () {
    if (confirm("Apakah kamu yakin ingin menghapus notifikasi init?")) {
        router.visit(route("accreditations.destroys"), {
            data: {
                ids: checkedData.value,
            },
            method: "delete",
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AppLayout title="Notifikasi">
        <!-- Search box -->
        <div class="max-w-sm mt-5">
            <InputField
                id="searchbox"
                name="searchbox"
                v-model="keyword"
                placeholder="Pencarian"
            />
        </div>
        <!-- End Search Box -->

        <!-- Table Section -->
        <div class="mt-5">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-gray-700"
                        >
                            <!-- Header -->
                            <HeaderTable>
                                <template v-slot:title>Notifikasi</template>
                                <template v-slot:description
                                    >Seluruh data notifikasi di dalam sistem
                                </template>
                                <template v-slot:action>
                                    <!-- Filter -->
                                    <div
                                        class="hs-dropdown relative inline-flex"
                                        data-hs-dropdown-auto-close="inside"
                                    >
                                        <button
                                            id="hs-dropdown-item-checkbox"
                                            type="button"
                                            class="hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
                                        >
                                            Filter
                                            <svg
                                                class="hs-dropdown-open:rotate-180 w-2.5 h-2.5 text-gray-600"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                />
                                            </svg>
                                        </button>

                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-gray-800 dark:border dark:border-gray-700"
                                            aria-labelledby="hs-dropdown-item-checkbox"
                                        >
                                            <div
                                                class="relative flex items-start py-2 px-3 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700"
                                            >
                                                <div
                                                    class="flex items-center h-5 mt-1"
                                                >
                                                    <input
                                                        id="hs-dropdown-item-checkbox-unsent"
                                                        name="hs-dropdown-item-checkbox-unsent"
                                                        type="checkbox"
                                                        class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                        aria-describedby="hs-dropdown-item-checkbox-delete-description"
                                                        v-model="filter"
                                                        value="Belum Terkirim"
                                                    />
                                                </div>
                                                <label
                                                    for="hs-dropdown-item-checkbox-unsent"
                                                    class="ml-3.5"
                                                >
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300"
                                                        >Belum Terkirim</span
                                                    >
                                                    <span
                                                        id="hs-dropdown-item-checkbox-delete-description"
                                                        class="block text-sm text-gray-600 dark:text-gray-500"
                                                        >Notifikasi yang belum
                                                        terkirim ke unit.</span
                                                    >
                                                </label>
                                            </div>
                                            <div
                                                class="relative flex items-start py-2 px-3 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700"
                                            >
                                                <div
                                                    class="flex items-center h-5 mt-1"
                                                >
                                                    <input
                                                        id="hs-dropdown-item-checkbox-sent"
                                                        name="hs-dropdown-item-checkbox-sent"
                                                        type="checkbox"
                                                        class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                        aria-describedby="hs-dropdown-item-checkbox-archive-description"
                                                        v-model="filter"
                                                        value="Terkirim"
                                                    />
                                                </div>
                                                <label
                                                    for="hs-dropdown-item-checkbox-sent"
                                                    class="ml-3.5"
                                                >
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800 dark:text-gray-300"
                                                        >Terkirim</span
                                                    >
                                                    <span
                                                        id="hs-dropdown-item-checkbox-archive-description"
                                                        class="block text-sm text-gray-600 dark:text-gray-500"
                                                        >Notifikasi yang sudah
                                                        terkirim ke unit.</span
                                                    >
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Filter -->
                                    <Transition
                                        enter-active-class="duration-300 ease-out"
                                        enter-from-class="transform opacity-0"
                                        enter-to-class="opacity-100"
                                        leave-active-class="duration-200 ease-in"
                                        leave-from-class="opacity-100"
                                        leave-to-class="transform opacity-0"
                                    >
                                        <button
                                            v-if="checkedData.length >= 1"
                                            @click="deleteCheckedNotification"
                                            class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                                        >
                                            Hapus
                                        </button>
                                    </Transition>
                                </template>
                            </HeaderTable>
                            <!-- End Header -->

                            <!-- Table -->
                            <MainTable>
                                <template v-slot:head>
                                    <tr>
                                        <th
                                            scope="col"
                                            class="pl-6 py-3 text-left"
                                        >
                                            <label
                                                for="hs-at-with-checkboxes-main"
                                                class="flex"
                                            >
                                                <input
                                                    type="checkbox"
                                                    v-model="isCheckedAll"
                                                    @change="checkAll"
                                                    class="shrink-0 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                    id="hs-at-with-checkboxes-main"
                                                />
                                            </label>
                                        </th>

                                        <th
                                            scope="col"
                                            class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3 text-left"
                                        >
                                            <div
                                                class="flex items-center gap-x-2"
                                            >
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200"
                                                >
                                                    Nama Unit
                                                </span>
                                            </div>
                                        </th>

                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left"
                                        >
                                            <div
                                                class="flex items-center gap-x-2"
                                            >
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200"
                                                >
                                                    Jadwal Pengiriman
                                                </span>
                                            </div>
                                        </th>

                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left"
                                        >
                                            <div
                                                class="flex items-center gap-x-2"
                                            >
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200"
                                                >
                                                    Status Notifikasi
                                                </span>
                                            </div>
                                        </th>

                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-right"
                                        ></th>
                                    </tr>
                                </template>

                                <template v-slot:body>
                                    <tr
                                        v-for="notification in notifications.data"
                                        :key="notification.id"
                                    >
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="pl-6 py-3">
                                                <label
                                                    :for="`hs-at-with-checkboxes-${notification.id}`"
                                                    class="flex"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        class="shrink-0 border-gray-200 rounded text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                        :id="`hs-at-with-checkboxes-${notification.id}`"
                                                        :value="notification.id"
                                                        v-model="checkedData"
                                                    />
                                                </label>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div
                                                class="pl-6 lg:pl-3 xl:pl-3 pr-6 py-3"
                                            >
                                                <span
                                                    class="block text-sm text-gray-800 dark:text-gray-300"
                                                >
                                                    {{
                                                        notification
                                                            .accreditation.unit
                                                            .name
                                                    }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-gray-300"
                                                >
                                                    {{
                                                        new Date(
                                                            notification.due_date
                                                        ).toLocaleDateString()
                                                    }}
                                                </span>
                                                <span
                                                    class="block text-sm text-gray-500"
                                                >
                                                    {{
                                                        dayjs(
                                                            notification.due_date
                                                        ).fromNow()
                                                    }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    v-if="
                                                        notification.status ===
                                                        'Belum Terkirim'
                                                    "
                                                    class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                                                    >Belum Terkirim</span
                                                >
                                                <span
                                                    v-if="
                                                        notification.status ===
                                                        'Terkirim'
                                                    "
                                                    class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"
                                                >Terkirim</span
                                                >
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-1.5">
                                                <Link
                                                    href="#"
                                                    class="inline-flex items-center gap-x-1.5 text-sm text-blue-600 decoration-2 hover:underline font-medium"
                                                >
                                                    Detail
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </MainTable>
                            <!-- End Table -->

                            <!-- Footer -->
                            <FooterTableNew
                                :total="notifications.total"
                                :to="notifications.to"
                                :from="notifications.from"
                                :next-page-url="notifications.next_page_url"
                                :prev-page-url="notifications.prev_page_url"
                            />
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
