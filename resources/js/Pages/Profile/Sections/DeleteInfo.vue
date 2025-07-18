<script setup>
import Container from "../../../Components/Container.vue";
import InputField from "../../../Components/InputField.vue";
import Title from "../../../Components/Title.vue";
import PrimaryBtn from "../../../Components/PrimaryBtn.vue";
import { useForm} from "@inertiajs/vue3";
import ErrorMessages from "../../../Components/ErrorMessages.vue";
import {ref} from "vue";

const showConfirmPassword = ref(false);

const form = useForm({
    password: "",
})

const submit = () => {
    form.delete(route('profile.destroy'), {
        onFinish: () => form.reset(),
        preserveScroll: true,
    })
}
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Title>Delete Account</Title>
            <p>This action cannot be undone, your info will be lost forever.</p>
        </div>
        <ErrorMessages :errors="form.errors"/>
       <div v-if="showConfirmPassword">
           <form @submit.prevent="submit">
               <InputField
                   label="Confirm Pass"
                   icon="key"
                   class="w-1/2"
                   type="password"
                   v-model="form.password"
               />
               <div class="flex gap-4">
                   <PrimaryBtn :disabled="form.processing">Confirm</PrimaryBtn>
                   <button
                       @click="showConfirmPassword = false"
                       class="text-indigo-500 font-medium underline dark:text-indigo-400 cursor-pointer"
                   >Cancel</button>
               </div>

           </form>
       </div>
<button
    v-if="!showConfirmPassword"
    @click="showConfirmPassword = true"
    class="px-6 py-2 rounded-lg bg-red-500 text-white cursor-pointer">
    <i class="fa-solid fa-triangle-exclamation mr-2"></i>
    Delete Account</button>
    </Container>
</template>
