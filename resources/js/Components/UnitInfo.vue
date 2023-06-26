<script setup>
import { computed, toRef } from "vue";

const props = defineProps({
    unit: {
        type: Object,
        required: true,
    },
    accreditation: {
        type: Object,
    },
});

const unit = toRef(props, "unit");

const isHasActiveAccreditation = computed(() => {
    const accreditations = props.unit.accreditations.filter((accreditation) => {
        if (accreditation.status === "Aktif") {
            return accreditation;
        }
    });
    return accreditations.length > 0;
});
</script>

<template>
    <dl
        class="grid grid-cols-1 text-center gap-8 p-4 mx-auto text-gray-900 xl:grid-cols-2 dark:text-white sm:p-8"
    >
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-xl font-extrabold">Kode Unit</dt>
            <dd class="text-gray-500 dark:text-gray-400">
                {{ unit.code }}
            </dd>
        </div>
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-xl font-extrabold">Nama Unit</dt>
            <dd class="text-gray-500 dark:text-gray-400">
                {{ unit.name }}
                {{ unit.unitable.degree }}
            </dd>
        </div>
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-xl font-extrabold">Email</dt>
            <dd class="text-gray-500 dark:text-gray-400">
                {{ unit.email }}
            </dd>
        </div>
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-xl font-extrabold">Status Akreditasi</dt>
            <dd class="text-gray-500 dark:text-gray-400">
                {{ isHasActiveAccreditation ? "Aktif" : "Tidak Aktif" }}
            </dd>
        </div>
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-xl font-extrabold">Hasil Akreditasi</dt>
            <dd class="text-gray-500 dark:text-gray-400">
                {{
                    isHasActiveAccreditation
                        ? unit.accreditations[0].grade
                        : "-"
                }}
            </dd>
        </div>
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-xl font-extrabold">Masa Berlaku</dt>
            <dd class="text-gray-500 dark:text-gray-400">
                {{
                    accreditation ? new Date(
                        accreditation.decree.validity_date
                    ).toLocaleDateString() : "-"
                }}
            </dd>
        </div>
    </dl>
</template>

<style scoped></style>
