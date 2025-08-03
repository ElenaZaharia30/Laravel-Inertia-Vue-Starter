<script setup>
import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import {Head, useForm} from "@inertiajs/vue3";
import TextArea from "../../Components/TextArea.vue";
import ImageUpload from "../../Components/ImageUpload.vue";


const form = useForm({
    title: "",
    description: "",
    tags: "",
    email: "",
    link: "",
    image: "",
})
</script>

<template>
    <Head title="- New Listing"></Head>
      <Container>
          <div class="mb-6">
              <Title>Add a new listing here:</Title>
          </div>

          <ErrorMessages :errors="form.errors"/>
          <form @submit.prevent="form.post(route('listing.store'))" class="grid grid-cols-2 gap-6">
             <div class="space-y-6">
                 <InputField
                     label="Title"
                     icon="heading"
                     placeholder="My new listing"
                     v-model="form.title"
                 />
                 <InputField
                     label="Tags (separate with comma)"
                     icon="tags"
                     placeholder="one, two, three"
                     v-model="form.tags"
                 />
                 <TextArea
                 label="Description"
                 icon="newspaper"
                 placeholder="This is my listing description"
                 v-model="form.description"
                 />
             </div>
              <div class="space-y-6">
                  <InputField
                      label="Email"
                      icon="at"
                      placeholder="example@gmail.com"
                      v-model="form.email"
                  />
                  <InputField
                      label="External link"
                      icon="up-right-from-square"
                      placeholder="https://example.com"
                      v-model="form.link"
                  />

                  <ImageUpload @image="(e) => form.image = e"/>
              </div>
                <div>  <PrimaryBtn :disabled="form.processing">Create</PrimaryBtn></div>
          </form>



      </Container>

</template>
