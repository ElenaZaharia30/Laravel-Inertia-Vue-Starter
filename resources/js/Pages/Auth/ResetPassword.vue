<script setup>
import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import TextLink from "../../Components/TextLink.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import {useForm} from "@inertiajs/vue3";
import ErrorMessages from "../../Components/ErrorMessages.vue";

const props = defineProps({
    token: String,
    email: String
})

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
})


const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    });
};
</script>

<template>
    <Head title="- Reset Password"/>

    <Container class="w-[90%] sm:w-[70%] md:w-[60%] lg:w-[50%]">

        <div class="mb-8 text-center">
            <Title>Enter a new password:</Title>
            <p>Already have an account? <TextLink routeName="login" label="Login"/></p>
        </div>
        <form @submit.prevent="submit" class="space-y-6">
            <ErrorMessages :errors="form.errors" />
            <InputField label="Email" type="email" icon="at" v-model="form.email" />
            <InputField label="Password" type="password" icon="key" v-model="form.password" />
            <InputField label="Confirm Password" type="password" icon="key" v-model="form.password_confirmation" />

            <div class="text-center">
                <PrimaryBtn >Reset Password</PrimaryBtn>
            </div>

        </form>
    </Container>
</template>
