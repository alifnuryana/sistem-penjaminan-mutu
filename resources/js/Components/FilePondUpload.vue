<script setup>
import vueFilepondEsm from "vue-filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js";
import FilePondPluginImagePreview from "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

const FilePond = vueFilepondEsm(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);
</script>

<template>
    <FilePond credits="false" labelIdle="Tarik & Lepas file atau <span class='filepond--label-action'> Sisipkan File </span>" />
</template>

<style>
.filepond--root {
    @apply text-sm font-semibold;
}

/* use a hand cursor intead of arrow for the action buttons */
.filepond--file-action-button {
    cursor: pointer;
}

/* the text color of the drop label*/
.filepond--drop-label {
    @apply text-gray-700 dark:text-gray-300;
}

/* underline color for "Browse" button */
.filepond--label-action {
    @apply decoration-gray-700;
}

/* the background color of the filepond drop area */
.filepond--panel-root {
    background-color: #eee;
}

/* the border radius of the drop area */
.filepond--panel-root {
    @apply rounded-xl;
}

/* the border radius of the file item */
.filepond--item-panel {
    @apply rounded-xl;
}

/* the background color of the file and file panel (used when dropping an image) */
.filepond--item-panel {
    background-color: #555;
}

/* the background color of the drop circle */
.filepond--drip-blob {
    background-color: #999;
}

/* the background color of the black action buttons */
.filepond--file-action-button {
    background-color: rgba(0, 0, 0, 0.5);
}

/* the icon color of the black action buttons */
.filepond--file-action-button {
    @apply text-gray-200;
}

/* the color of the focus ring */
.filepond--file-action-button:hover,
.filepond--file-action-button:focus {
    box-shadow: 0 0 0 0.125em rgba(255, 255, 255, 0.9);
}

/* the text color of the file status and info labels */
.filepond--file {
    color: white;
}

/* error state color */
[data-filepond-item-state*="error"] .filepond--item-panel,
[data-filepond-item-state*="invalid"] .filepond--item-panel {
    @apply bg-red-500 dark:bg-red-700;
}

[data-filepond-item-state="processing-complete"] .filepond--item-panel {
    @apply bg-green-500 dark:bg-green-700;
}

/* bordered drop area */
.filepond--panel-root {
    @apply border-2 border-dashed border-gray-200 bg-transparent dark:border-gray-700;
}
</style>
