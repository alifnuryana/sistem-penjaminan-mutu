<template>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-slate-800">
            <slot name="head"/>
        </thead>

        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            <slot name="body"/>
        </tbody>
    </table>
</template>

<script></script>
