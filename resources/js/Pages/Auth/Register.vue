<script setup>
import Container from "../../Componenets/Container.vue";
import Title from "../../Componenets/Title.vue";
import TextLink from "../../Componenets/TextLink.vue";
import InputField from "../../Componenets/InputField.vue";
import PrimaryBtn from "../../Componenets/PrimaryBtn.vue";
</script>

<template>
    <Container class="w-[90%] sm:w-[70%] md:w-[60%] lg:w-[50%]">

    <div class="mb-8 text-center">
        <Title>Register a new account</Title>
        <p>Already have an account? <TextLink routeName="home" label="Login"/></p>
    </div>
    <form action="" class="space-y-6">
        <InputField label="Name" icon="id-badge" />
        <InputField label="Email" type="email" icon="at" />
        <InputField label="Password" type="password" icon="key" />
        <InputField label="Confirm Password" type="password" icon="key" />

        <p class="text-slate-500 text-sm dark:text-slate-400">
            By creating an account you agree to our Terms of Service and Privacy Policy
        </p>
        <div class="text-center">
            <PrimaryBtn>Register</PrimaryBtn>
        </div>

    </form>
</Container>
</template>
