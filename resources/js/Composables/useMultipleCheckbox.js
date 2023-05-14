import {ref, watch} from "vue";

export function useMultipleCheckbox(data) {
    const isCheckedAll = ref(false);
    const checkedData = ref([]);

    watch(checkedData, function () {
        if (checkedData.value.length === data.length) {
            isCheckedAll.value = true;
        } else {
            isCheckedAll.value = false;
        }
    });

    function checkAll() {
        if (isCheckedAll.value) {
            checkedData.value = data.map((item) => item.id);
        } else {
            checkedData.value = [];
        }
    }

    return {isCheckedAll, checkedData, checkAll};
}
