import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";

export function useSearchBox(url, initialKeyword = "") {
    const keyword = ref(initialKeyword);

    watch(keyword, (newKeyword) => {
        router.get(url, {
            keyword: newKeyword,
        }, {
            preserveState: true,
            replace: true,
        });
    });

    return {keyword}
}
