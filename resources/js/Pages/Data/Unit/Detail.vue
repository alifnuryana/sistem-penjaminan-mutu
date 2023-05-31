<template>
    <AppLayout title="Detail unit">
        <div class="p-4">
            <h1 class="text-2xl md:text-3xl font-medium">Teknik Inforamtika</h1>
            <p v-if="props.unitData.degree" class="text-base">S1</p>
        </div>
        <!--card-->
        <div class="px-5 pt-5 pb-0 mb-10 bg-white rounded-md overflow-x-auto shadow-md">
            <h1 class="text-lg md:text-xl font-normal mb-5 md:mb-7">Informasi Program Studi</h1>
            <!--Information List-->
            <div class="grid grid-cols-4 gap-y-2 text-sm md:text-base">
                <h3 class="font-medium">Kode</h3>
                <div class="col-span-3">
                    <p>{{props.unitData.code}}</p>
                </div>
                <hr class="col-span-4">
                <h3 class="font-medium">Nama</h3>
                <div class="col-span-3">
                    <p>{{props.unitData.name}}</p>
                </div>
                <hr class="col-span-4">
                <h3 class="font-medium">Email</h3>
                <div class="col-span-3">
                    <p>{{props.unitData.email}}</p>
                </div>
                <hr class="col-span-4">
                <h3 class="font-medium">Tipe Unit</h3>
                <div class="col-span-3">
                    <p>{{props.unitData.unitable_type}}</p>
                </div>
                <hr class="col-span-4">
                <h3 class="font-medium">SK Pendirian</h3>
                <div class="col-span-3">
                    <a :href="route('data.decrees.file', props.unitData.unitable.decrees.file_path)" class="text-blue-500 hover:text-blue-900" target="_blank">download</a>
                </div>
                <hr class="col-span-4">
            </div>
        </div>
        <!--end card-->

        <!--card-->
        <div class="px-5 pt-5 pb-0 my-10 bg-white rounded-md overflow-x-auto shadow-md">
            <h1 class="text-lg md:text-xl font-normal mb-5 md:mb-7">Informasi Akreditasi</h1>
            <!--Information List-->
            <div class="grid grid-cols-4 gap-y-2 text-sm md:text-base">
                <h3 class="font-medium">Kode</h3>
                <div class="col-span-3">
                    <p>{{props.unitData.accreditations[0].code}}</p>
                </div>
                <hr class="col-span-4">
                <h3 class="font-medium">Nilai</h3>
                <div class="col-span-3">
                    <p>{{props.unitData.accreditations[0].grade}}</p>
                </div>
                <hr class="col-span-4">
                <h3 class="font-medium">Status</h3>
                <div class="col-span-3">
                    <p>{{props.unitData.accreditations[0].status}}</p>
                </div>
                <hr class="col-span-4">
                <h3 class="font-medium">SK Akreditasi</h3>
                <div class="col-span-3">
                    <a :href="route('data.decrees.file', props.unitData.accreditations[0].decree.file_path)" class="text-blue-500 hover:text-blue-900" target="_blank">download</a>
                </div>
                <hr class="col-span-4">
            </div>
        </div>
        <!--end card-->
    </AppLayout>
</template>
<script setup>

import AppLayout from "@/Components/Layouts/AppLayout.vue";

const props = defineProps({
    unitData : {
        required: true,
        default: null
    }
})
</script>
