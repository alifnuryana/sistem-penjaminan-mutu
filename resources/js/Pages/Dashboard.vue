<script setup>
import AppLayout from "@/Components/Layouts/AppLayout.vue";

defineProps({
    totalAccreditation: {
        required: true,
    },
    totalAccreditationActive: {
        required: true,
    },
    totalAccreditationInactive: {
        required: true,
    },
    totalUnit: {
        required: true,
    },
    totalUnitHasActiveAccreditation: {
        required: true,
    },
    totalUnitDoesntHaveActiveAccreditation: {
        required: true,
    },
    totalNotification: {
        required: true,
    },
    totalScheduleNotification: {
        required: true,
    },
    totalSendedNotification: {
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Dashboard">
        <!-- Card Section -->
        <div class="max-w-[85rem]">
            <!-- Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Card -->
                <div
                    class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800"
                >
                    <div class="inline-flex justify-center items-center">
                        <span
                            class="w-2 h-2 inline-block bg-gray-500 rounded-full mr-2"
                        ></span>
                        <span
                            class="text-xs font-semibold uppercase text-gray-600 dark:text-gray-400"
                            >Unit</span
                        >
                    </div>

                    <div class="text-center">
                        <h3
                            class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-gray-200"
                        >
                            {{ totalUnit }}
                        </h3>
                    </div>

                    <dl
                        class="flex justify-center items-center divide-x divide-gray-200 dark:divide-gray-700"
                    >
                        <dt class="pr-3 text-right">
                            <span
                                class="text-sm font-semibold text-gray-800 dark:text-gray-200"
                            >
                                {{ totalUnitHasActiveAccreditation }}
                            </span>
                            <span class="block text-sm text-gray-500">
                                Sudah Akreditasi
                            </span>
                        </dt>
                        <dd class="text-left pl-3">
                            <span
                                class="text-sm font-semibold text-gray-800 dark:text-gray-200"
                            >
                                {{ totalUnitDoesntHaveActiveAccreditation }}
                            </span>
                            <span class="block text-sm text-gray-500">
                                Belum Akreditasi
                            </span>
                        </dd>
                    </dl>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div
                    class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800"
                >
                    <div class="inline-flex justify-center items-center">
                        <span
                            class="w-2 h-2 inline-block bg-gray-500 rounded-full mr-2"
                        ></span>
                        <span
                            class="text-xs font-semibold uppercase text-gray-600 dark:text-gray-400"
                        >
                            Akreditasi
                        </span>
                    </div>

                    <div class="text-center">
                        <h3
                            class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-gray-200"
                        >
                            {{ totalAccreditation }}
                        </h3>
                    </div>

                    <dl
                        class="flex justify-center items-center divide-x divide-gray-200 dark:divide-gray-700"
                    >
                        <dt class="pr-3 text-right">
                            <span
                                class="text-sm font-semibold text-gray-800 dark:text-gray-200"
                            >
                                {{ totalAccreditationActive }}
                            </span>
                            <span class="block text-sm text-gray-500">
                                Akreditasi Masih Aktif
                            </span>
                        </dt>
                        <dd class="text-left pl-3">
                            <span
                                class="text-sm font-semibold text-gray-800 dark:text-gray-200"
                            >
                                {{ totalAccreditationInactive }}
                            </span>
                            <span class="block text-sm text-gray-500">
                                Akreditasi Tidak Aktif
                            </span>
                        </dd>
                    </dl>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div
                    class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-5 bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800"
                >
                    <div class="inline-flex justify-center items-center">
                        <span
                            class="w-2 h-2 inline-block animate-ping bg-green-500 rounded-full mr-2"
                        ></span>
                        <span
                            class="text-xs font-semibold uppercase text-gray-600 dark:text-gray-400"
                        >
                            Notifikasi
                        </span>
                    </div>

                    <div class="text-center">
                        <h3
                            class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-gray-200"
                        >
                            {{totalNotification}}
                        </h3>
                    </div>

                    <dl
                        class="flex justify-center items-center divide-x divide-gray-200 dark:divide-gray-700"
                    >
                        <dt class="pr-3 text-right">
                            <span
                                class="text-sm font-semibold text-gray-800 dark:text-gray-200"
                            >
                                {{totalSendedNotification}}
                            </span>
                            <span class="block text-sm text-gray-500">
                                Terkirim
                            </span>
                        </dt>
                        <dd class="text-left pl-3">
                            <span
                                class="text-sm font-semibold text-gray-800 dark:text-gray-200"
                            >
                                {{totalScheduleNotification}}
                            </span>
                            <span class="block text-sm text-gray-500">
                                Terjadwal
                            </span>
                        </dd>
                    </dl>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Grid -->
        </div>
        <!-- End Card Section -->
    </AppLayout>
</template>
