<script setup>
import { ref } from "vue";
import ErrorMessages from "./ErrorMessages.vue";

const emit = defineEmits(['image']);

const props = defineProps({
    listingImage : String
});

const currentImage = props.listingImage ? `/storage/${props.listingImage}` : null;

const imageErrors = ref({});
const preview = ref(currentImage);
const showRevertBtn = ref(false);


const imageSelected = (e) => {
    const file = e.target.files[0];
    if (!file) return;

    imageErrors.value = {};

    const isImage = file.type.startsWith("image/");
    const isOversized = file.size > 3145728;

    if (!isImage) {
        preview.value = null;
        imageErrors.value = { image: "Only image files are allowed." };
        return;
    }

    if (isOversized) {
        preview.value = null;
        imageErrors.value = { image: "The selected image exceeds 3MB." };
        return;
    }

    preview.value = URL.createObjectURL(file);
    showRevertBtn.value = true;
    emit('image', e.target.files[0]);
};

const revertImageChange = () => {
    showRevertBtn.value = false
    preview.value = currentImage
    emit('image', null);

}
</script>


<template>
    <div>
<!--        <ErrorMessages :errors="imageErrors" />-->

        <span
            class="block text-sm font-medium text-slate-700 dark:text-slate-300"
            :class="{ '!text-red-500': imageErrors.image }"
        >
      {{ imageErrors.image || 'Image (Max size 3MB)' }}
    </span>

        <label
            for="image"
            class="relative block rounded-md mt-1 bg-slate-300 h-[140px] overflow-hidden cursor-pointer border"
            :class="{ '!border-red-500': imageErrors.image, 'border-slate-300': !imageErrors.image }"
        >
            <img
                :src="preview ?? '/storage/images/listing/default.jpg'"
                class="object-center object-cover h-full w-full"
                alt=""
            />
            <button
                @click.prevent="revertImageChange"
                class="absolute top-2 right-2 bg-white/75 w-8 h-8 rounded-full grid
                           place-items-center text-slate-700 cursor-pointer"
                    v-if="showRevertBtn"
                    type="button">
                <i class="fa-solid fa-rotate-left"></i>
            </button>
        </label>

        <input
            @input="imageSelected"
            type="file"
            name="image"
            id="image"

            hidden
        />
    </div>
</template>
