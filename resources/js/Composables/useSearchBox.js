import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";

export function useSearchBox(url, initialKeyword = "", filter = {}) {
    const keyword = ref(initialKeyword);

    watch(keyword, (newKeyword) => {
        router.get(url, {
            ...filter,
            keyword: newKeyword,
        }, {
            preserveState: true,
            replace: true,
        });
    });

    return {keyword}
}
