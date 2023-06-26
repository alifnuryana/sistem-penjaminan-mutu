<script setup>
import AppLayout from "../../../Components/Layouts/AppLayout.vue";
import PersonalFileBro from "../../../Components/Assets/PersonalFileBro.vue";
import { computed, toRef } from "vue";
import UnitInfo from "../../../Components/UnitInfo.vue";
import MainTable from "../../../Components/MainTable.vue";
import { Link } from "@inertiajs/vue3";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import "dayjs/locale/id";

dayjs.locale("id");
dayjs.extend(relativeTime);

const props = defineProps({
    unit: {
        type: Object,
        required: true,
    },
    notifications: {
        type: Array,
    },
});

const unit = toRef(props, "unit");
const notifications = toRef(props, "notifications");

const notificationScheduled = computed(() => {
    if (!notifications.value) {
        return [];
    }
    return notifications.value
        .filter((notification) => {
            return notification.status === "Belum Terkirim";
        });
});

const notificationSended = computed(() => {
    if (!notifications.value) {
        return [];
    }
    return notifications.value.filter((notification) => {
        return notification.status === "Terkirim";
    });
});
</script>

<template>
    <AppLayout :title="`${unit.name} ${unit.unitable.degree}`">
        <div
            class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:text-gray-400 dark:bg-slate-900 dark:border-gray-700 p-5"
        >
            <div>
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-gray-200"
                >
                    Detail {{ unit.name }}
                    {{ unit.unitable.degree }}
                </h2>
                <p class="text-sm text-gray-600 mt-1 dark:text-gray-400">
                    Informasi mengenai {{ unit.name }}
                    {{ unit.unitable.degree }}
                </p>
            </div>

            <!-- Tabs Header Start -->
            <nav
                class="relative z-0 flex border mt-5 rounded-xl overflow-hidden dark:border-gray-700"
                aria-label="Tabs"
                role="tablist"
            >
                <button
                    type="button"
                    class="hs-tab-active:border-b-blue-600 hs-tab-active:text-gray-900 dark:hs-tab-active:text-white dark:hs-tab-active:border-b-blue-600 relative min-w-0 flex-1 bg-white first:border-l-0 border-l border-b-2 py-4 px-4 text-gray-500 hover:text-gray-700 text-sm font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 dark:bg-gray-800 dark:border-l-gray-700 dark:border-b-gray-700 dark:hover:bg-gray-700 dark:hover:text-gray-400 active"
                    id="bar-with-underline-item-1"
                    data-hs-tab="#bar-with-underline-1"
                    aria-controls="bar-with-underline-1"
                    role="tab"
                >
                    Informasi
                </button>
                <button
                    type="button"
                    class="hs-tab-active:border-b-blue-600 hs-tab-active:text-gray-900 dark:hs-tab-active:text-white dark:hs-tab-active:border-b-blue-600 relative min-w-0 flex-1 bg-white first:border-l-0 border-l border-b-2 py-4 px-4 text-gray-500 hover:text-gray-700 text-sm font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 dark:bg-gray-800 dark:border-l-gray-700 dark:border-b-gray-700 dark:hover:bg-gray-700 dark:hover:text-gray-400 dark:hover:text-gray-300"
                    id="bar-with-underline-item-3"
                    data-hs-tab="#bar-with-underline-3"
                    aria-controls="bar-with-underline-3"
                    role="tab"
                >
                    Notifikasi Terdekat
                </button>
            </nav>
            <!-- Tabs Header End -->

            <!-- Tabs Body Start -->
            <div class="mt-3">
                <!-- Informasi Start -->
                <div
                    id="bar-with-underline-1"
                    role="tabpanel"
                    aria-labelledby="bar-with-underline-item-1"
                >
                    <div class="flex flex-wrap">
                        <PersonalFileBro class="max-w-sm mx-auto" />
                        <UnitInfo :unit="unit" />
                    </div>
                </div>
                <!-- Informasi End -->
                <!-- Notofikasi Start -->
                <div
                    id="bar-with-underline-3"
                    class="hidden"
                    role="tabpanel"
                    aria-labelledby="bar-with-underline-item-3"
                >
                    <div class="flex gap-5">
                        <div class="w-full">
                            <MainTable>
                                <template v-slot:head>
                                    <tr>
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
                                                    Status
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
                                        v-for="notification in notificationScheduled.splice(0, 10)"
                                        :key="notification.id"
                                    >
                                        <td class="h-px whitespace-nowrap">
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
                                        <td class="h-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-gray-200"
                                                >
                                                    <span
                                                        v-if="
                                                            notification.status ===
                                                            'Belum Terkirim'
                                                        "
                                                        class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                                                        >Belum Terkirim</span
                                                    >
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-px whitespace-nowrap">
                                            <div class="px-6 py-1.5">
                                                <Link
                                                    as="button"
                                                    class="inline-flex items-center gap-x-1.5 text-sm text-blue-600 decoration-2 hover:underline font-medium"
                                                    :href="route('data.units.sendRemainder', {unit: unit.code, notification: notification.id})"
                                                    method="POST"
                                                >
                                                    Kirim Sekarang
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </MainTable>
                        </div>

                        <div>
                            <div
                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                            >
                                <h5
                                    class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white"
                                >
                                    Notifikasi Berhasil Terkirim
                                </h5>
                                <p
                                    class="font-bold text-3xl text-green-400 dark:text-green-500"
                                >
                                    {{ notificationSended.length}}
                                </p>
                            </div>
                            <div
                                class="block mt-5 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                            >
                                <h5
                                    class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white"
                                >
                                    Notifikasi Belum Terkirim
                                </h5>
                                <p
                                    class="font-bold text-3xl text-yellow-400 dark:text-yellow-500"
                                >
                                    {{ notificationScheduled.length }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Notofikasi End -->
            </div>
            <!-- Tabs Body End -->
        </div>
    </AppLayout>
</template>
