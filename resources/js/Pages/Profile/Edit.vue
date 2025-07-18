<script setup>
import UpdateInfo from "./Sections/UpdateInfo.vue";
import {Head, usePage} from "@inertiajs/vue3";
import UpdatePassword from "./Sections/UpdatePassword.vue";
import DeleteInfo from "./Sections/DeleteInfo.vue";
defineProps({
    user: Object,
    status: String,

})
const flash = usePage().props.flash
</script>

<template>
<Head></Head>
    <UpdateInfo :user="user" :status="status"></UpdateInfo>
    <UpdatePassword></UpdatePassword>
    <DeleteInfo/>
</template>
