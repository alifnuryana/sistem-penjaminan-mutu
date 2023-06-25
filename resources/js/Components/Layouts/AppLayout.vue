<template>
    <div class="bg-gray-50 min-h-screen dark:bg-slate-900 transition-colors duration-300">
        <Head>
            <title>{{title}}</title>
        </Head>
        <!-- ========== HEADER ========== -->
        <Header/>
        <!-- ========== END HEADER ========== -->

        <!-- ========== MAIN CONTENT ========== -->
        <!-- Sidebar Toggle -->
        <div
            class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center py-4">
                <!-- Navigation Toggle -->
                <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#application-sidebar"
                        aria-controls="application-sidebar" aria-label="Toggle navigation">
                    <Bars3Icon class="w-5 h-5"/>
                </button>
                <!-- End Navigation Toggle -->

                <!-- Breadcrumb -->
                <MobileBreadcrumbs/>
                <!-- End Breadcrumb -->
            </div>
        </div>
        <!-- End Sidebar Toggle -->

        <!-- Sidebar -->
        <Sidebar/>
        <!-- End Sidebar -->

        <!-- Content -->
        <div class="w-full py-10 px-4 sm:px-6 md:px-8 lg:pl-72">
            <Breadcrumbs class="hidden lg:flex"/>
            <slot/>
        </div>
        <!-- End Content -->
        <!-- ========== END MAIN CONTENT ========== -->
    </div>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import Header from "./Partials/Header.vue";
import Sidebar from "./Partials/Sidebar.vue";
import MobileBreadcrumbs from "../MobileBreadcrumbs.vue";
import {Bars3Icon} from "@heroicons/vue/24/outline/index.js";
import Breadcrumbs from "../Breadcrumbs.vue";

defineProps({
    title: {
        type: String,
        required: true,
    }
})
</script>
