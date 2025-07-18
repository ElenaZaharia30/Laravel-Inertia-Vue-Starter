<script setup>
import Container from "../../../Components/Container.vue";
import InputField from "../../../Components/InputField.vue";
import Title from "../../../Components/Title.vue";
import PrimaryBtn from "../../../Components/PrimaryBtn.vue";
import {router, useForm, usePage} from "@inertiajs/vue3";
import ErrorMessages from "../../../Components/ErrorMessages.vue";
import SessionMessages from "../../../Components/SessionMessages.vue";
import {computed} from "vue";

const props = defineProps({
    user: Object,
    status: String,

})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
})

const resendForm = useForm({});
const resend = () =>{
// manual visit to route, send post request to verification.send
    resendForm.post(route("verification.send"));
}
const successMessage = computed(() => usePage().props.flash?.success)
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Title>Update Info</Title>
            <p>Update your account's profile info and email address.</p>
        </div>
<ErrorMessages :errors="form.errors"/>
        <form @submit.prevent="form.patch(route('profile.info'))"class="space-y-5">
            <InputField
            label="Name"
            icon="id-badge"
            class="w-1/2"
            v-model="form.name"
            />
            <InputField
                label="Email"
                icon="at"
                class="w-1/2"
                v-model="form.email"

            />
            <PrimaryBtn :disabled="form.processing">Save</PrimaryBtn>
        </form>
        <SessionMessages :status="status"/>
        <div
            v-if="user.email_verified_at === null"
            class="mb-3">

            <p>Your email address is unverified.</p>
            <button
                @click="resend"
                :disabled="resendForm.processing"
                class="font-medium underline cursor-pointer text-indigo-500 hover:text-indigo-600
               dark:text-indigo-400 dark:hover:text-indigo-500
               disabled:text-slate-400 disabled:cursor-wait"
            >
                {{ resendForm.processing ? 'Resending...' : 'Click here to resend' }}
            </button>

        </div>

        <div v-if="successMessage" class="alert alert-success">
            {{ successMessage }}
        </div>
        <p v-if="form.recentlySuccessful"
           class="text-green-500 font-medium">Saved</p>
    </Container>
</template>
