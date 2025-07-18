<script setup>
defineProps({
    status :String
})
</script>

<template >
    <div>
        <p v-if="status"
           class="mt-6 font-medium text-sm text-green-500"
        >{{status}}</p>

    </div>
</template>
