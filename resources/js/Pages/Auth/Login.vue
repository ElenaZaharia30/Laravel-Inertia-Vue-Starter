<script setup>
import Container from "../../Componenets/Container.vue";
import Title from "../../Componenets/Title.vue";
import TextLink from "../../Componenets/TextLink.vue";
import InputField from "../../Componenets/InputField.vue";
import PrimaryBtn from "../../Componenets/PrimaryBtn.vue";
import {useForm} from "@inertiajs/vue3";
import ErrorMessages from "../../Componenets/ErrorMessages.vue";
import CheckBox from "../../Componenets/CheckBox.vue";

const form = useForm({
    email: "",
    password: "",
    remember: null,
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password')
    });
};
</script>

<template>
    <Head title="- Login"/>
    <Container class="w-[90%] sm:w-[70%] md:w-[60%] lg:w-[50%]">

        <div class="mb-8 text-center">
            <Title>Login a new account</Title>
            <p>Need an account? <TextLink routeName="register" label="Register"/></p>
        </div>
        <form @submit.prevent="submit" class="space-y-6">
            <ErrorMessages :errors="form.errors" />

            <InputField label="Email" type="email" icon="at" v-model="form.email" />
            <InputField label="Password" type="password" icon="key" v-model="form.password" />

            <div class="flex items-center justify-between" >
                <CheckBox name="remember"  v-model="form.remember"> Remember me</CheckBox>
                <TextLink routeName="home" label="Forgot password?"/>
            </div>

            <div class="text-center">
                <PrimaryBtn >Login</PrimaryBtn>
            </div>

        </form>
    </Container>
</template>
