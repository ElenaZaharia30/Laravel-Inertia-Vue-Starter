<script setup>
import Container from "../../Components/Container.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import {useForm} from "@inertiajs/vue3";
import ErrorMessages from "../../Components/ErrorMessages.vue";

const form = useForm({
    password: "",
})

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset()
    });
};
</script>

<template>
    <Head title="- Password confirmation"/>
    <Container class="w-[90%] sm:w-[70%] md:w-[60%] lg:w-[50%]">

        <div class="mb-8 text-center">
            <p>This is a secure area of the app. Please confirm your password before continuing. </p>
        </div>
        <form @submit.prevent="submit" class="space-y-6">
            <ErrorMessages :errors="form.errors" />
            <InputField label="Password" type="password" icon="key" v-model="form.password" />
            <div class="text-center">
                <PrimaryBtn >Confirm</PrimaryBtn>
            </div>

        </form>
    </Container>
</template>
