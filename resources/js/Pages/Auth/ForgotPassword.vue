<script setup>
import Container from "../../Components/Container.vue";
import TextLink from "../../Components/TextLink.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import {useForm} from "@inertiajs/vue3";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import SessionMessages from "../../Components/SessionMessages.vue";

const form = useForm({
    email: "",
})

defineProps({
    status: String
})

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="- Forgot Password"/>
    <Container class="w-[90%] sm:w-[70%] md:w-[60%] lg:w-[50%]">
        <div class="mb-8 text-center">
            <p>Forgot your password? Reset here:</p>
        </div>
        <form @submit.prevent="submit" class="space-y-6">
            <ErrorMessages :errors="form.errors" />
            <SessionMessages :status="status"/>
            <InputField label="Email" type="email" icon="at" v-model="form.email" />
            <div class="text-center">
                <PrimaryBtn class="cursor-pointer" >Send Link</PrimaryBtn>
            </div>
        </form>
    </Container>
</template>
