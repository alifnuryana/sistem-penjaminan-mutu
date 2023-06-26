<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {ArrowLeftOnRectangleIcon} from "@heroicons/vue/24/outline/index.js";
import ThemeSwitcher from "../../ThemeSwitcher.vue";

const page = usePage();
</script>


<template>
    <header
        class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 sm:py-4 lg:pl-64 dark:bg-gray-800 dark:border-gray-700">
        <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
            <div class="mr-5 lg:mr-0 lg:hidden">
                <Link class="flex-none cursor-pointer text-xl font-semibold dark:text-white"
                      :href="route('dashboard')"
                      aria-label="SPM Widyatama">SPM Widyatama
                </Link>
            </div>

            <div class="w-full flex items-center justify-end ml-auto sm:justify-between sm:gap-x-3 sm:order-3">
                <div class="flex flex-row w-full items-center justify-end space-x-5">
                    <ThemeSwitcher/>

                    <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                        <button id="hs-dropdown-with-header" type="button"
                                class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center gap-2 h-[2.375rem] w-[2.375rem] rounded-full font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-xs dark:bg-gray-800 dark:hover:bg-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800">
                            <img
                                class="inline-block h-[2.375rem] w-[2.375rem] rounded-full ring-2 ring-white dark:ring-gray-800"
                                src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                alt="Image Description">
                        </button>

                        <div
                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700"
                            aria-labelledby="hs-dropdown-with-header">
                            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg dark:bg-gray-700">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Masuk sebagai</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-300">{{page.props.user.email}}</p>
                            </div>
                            <div class="mt-2 py-2 first:pt-0 last:pb-0">
                                <Link :href="route('logout')"
                                      as="button"
                                      method="POST"
                                      class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    <ArrowLeftOnRectangleIcon class="flex-none w-5 h-5"/>
                                    Logout
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>
