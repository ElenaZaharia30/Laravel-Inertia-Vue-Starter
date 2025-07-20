<script setup>

import {router} from "@inertiajs/vue3";

defineProps({
    listing: Object,
})
const params = route().params;

const selectUser = (id) => {
    router.get(route('home'), {
        user_id: id,
        search: params.search
    })
}
</script>

<template>
    <div
        class="bg-white rounded-lg shadow-lg overflow-hidden dark:bg-slate-800 h-full flex flex-col justify-between"
    >
        <div>
        <!--Image-->
            <div ></div>
            <Link href="#">
                <img :src="listing.image
                ? `/storage/${listing.image}`
                : `storage/images/listing/default.jpg` " alt="" class="w-full h-48 bg-slate-300 object-cover object-center">
            </Link>
<!--            Title and user-->
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">
                    {{listing.title.substring(0,35)}}...
                </h3>
                <p>Listed on {{new Date(listing.created_at).toLocaleDateString()}}
                    by
                    <button class="text-link" @click="selectUser(listing.user.id)">
                        {{listing.user.name}}
                    </button>
                </p>
            </div>
        </div>
        <div v-if="listing.tags" class="flex items-center gap-3 p-4 pt-0">
            <div v-for="tag in listing.tags.split(',')" :key="tag">
                <button class="bg-slate-500 text-white px-2 py-px
                rounded-full cursor-pointer hover:bg-slate-700 dark:hover:bg-slate-900">
                    {{tag}}
                </button>
            </div>
        </div>
    </div>
</template>
