import {ref, watch} from "vue";

export function useMultipleCheckbox(data) {
    const checkedAll = ref(false);
    const checked = ref([]);

    watch(checked, function () {
        if (checked.value.length === data.length) {
            checkedAll.value = true;
        } else {
            checkedAll.value = false;
        }
    });

    function checkAll() {
        if (checkedAll.value) {
            checked.value = data.map((item) => item.id);
        } else {
            checked.value = [];
        }
    }

    return {checkedAll, checked, checkAll};
}
