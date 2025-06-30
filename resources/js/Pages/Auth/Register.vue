<script setup>
import Container from "../../Componenets/Container.vue";
import Title from "../../Componenets/Title.vue";
import TextLink from "../../Componenets/TextLink.vue";
import InputField from "../../Componenets/InputField.vue";
import PrimaryBtn from "../../Componenets/PrimaryBtn.vue";
import {useForm} from "@inertiajs/vue3";
import ErrorMessages from "../../Componenets/ErrorMessages.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation')
    });
};
</script>

<template>
    <Head title="- Register"/>

    <Container class="w-[90%] sm:w-[70%] md:w-[60%] lg:w-[50%]">

    <div class="mb-8 text-center">
        <Title>Register a new account</Title>
        <p>Already have an account? <TextLink routeName="login" label="Login"/></p>
    </div>
    <form @submit.prevent="submit" class="space-y-6">
        <ErrorMessages :errors="form.errors" />
        <InputField label="Name" icon="id-badge" v-model="form.name" />
        <InputField label="Email" type="email" icon="at" v-model="form.email" />
        <InputField label="Password" type="password" icon="key" v-model="form.password" />
        <InputField label="Confirm Password" type="password" icon="key" v-model="form.password_confirmation" />

        <p class="text-slate-500 text-sm dark:text-slate-400">
            By creating an account you agree to our Terms of Service and Privacy Policy
        </p>
        <div class="text-center">
            <PrimaryBtn >Register</PrimaryBtn>
        </div>

    </form>
</Container>
</template>
