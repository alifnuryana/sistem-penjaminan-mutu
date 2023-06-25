import {setOptions} from "vue-filepond";
import {usePage} from "@inertiajs/vue3";

export function useFilesPond(files) {
    function handleFilePondInit() {
        setOptions({
            credits: false,
            server: {
                url: '/filepond',
                headers: {
                    'X-CSRF-TOKEN': usePage().props.csrf_token,
                }
            }
        })
    }

    const handleAddPondFiles = (error, file) => {
        files.value.push({id: file.id, serverId: file.serverId});
    }

    const handleRemovePondFiles = (error, file) => {
        files.value = files.value.filter((item) => item.id !== file.id);
    }

    return {
        handleFilePondInit,
        handleAddPondFiles,
        handleRemovePondFiles
    }
}
