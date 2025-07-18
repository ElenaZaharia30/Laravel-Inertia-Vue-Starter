<script setup>
import {switchTheme} from "../theme.js";
import NavLink from "../Components/NavLink.vue";
import {router, usePage} from "@inertiajs/vue3";
import {computed, ref} from "vue";

const page = usePage();
const user = computed(() => {
    const name = page.props.auth.user?.name ?? '';
    return name
        .split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
});
const show = ref(false);
</script>

<template >
    <!---Overlay--->
    <div v-show="show" @click="show = false" class="fixed inset-0 z-40"></div>
    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">

            <NavLink routeName="home" componentName="Home">Home</NavLink>
            <div class="flex items-center space-x-6">
                <div v-if="!user" class="space-x-1">
                    <NavLink routeName="login" componentName="Auth/Login">Login</NavLink>
                    <NavLink routeName="register" componentName="Auth/Register">Register</NavLink>
                </div>

                <div v-if="user" class="relative">
                    <div @click="show = !show"
                         class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-slate-700 cursor-pointer"
                         :class="{'bg-slate-700' : show}"
                    >
                        <p>{{user}}</p>
                        <i class="fa-solid fa-angle-down" ></i>
                        <!-----User Dropdown Menu------->
                        <div v-show="show"
                            class="absolute z-50 top-14 right-0 text-center bg-slate-800 text-white rounded-lg border-slate-100 border overflow-hidden w-40">
                            <Link
                                :href="route('profile.edit')"
                                class="cursor-pointer block w-full px-6 py-3 hover:bg-slate-700">
                                Profile
                            </Link>
                            <Link
                                :href="route('dashboard')"
                                class="cursor-pointer block w-full px-6 py-3 hover:bg-slate-700">
                                Dashboard
                            </Link>
                            <Link
                               :href="route('logout')"
                                method="post"
                                as="button"
                                class="cursor-pointer block w-full px-6 py-3 hover:bg-slate-700">
                                Logout
                            </Link>

                        </div>
                    </div>

                </div>


                <button
                    @click="switchTheme"
                    class="hover:bg-slate-700 hover:cursor-pointer w-6 h-6 grid place-items-center rounded-full hover:outline outline-1 outline-white"><i class="fa-solid fa-circle-half-stroke"></i>
                </button>
            </div>
        </nav>
    </header>

    <main class="p-6 max-w-screen-lg mx-auto mt-12 min-h-screen">
        <slot />
    </main>
</template>
