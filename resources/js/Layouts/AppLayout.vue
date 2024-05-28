<template>
    <div class="flex flex-col min-h-screen justify-between">
        <header class="bg-gray-900 p-10 w-full">
            <!-- Logo -->
            <div class="flex items-center justify-center ">
                <Link :href="`/`">
                <ApplicationMark class="block h-9 w-auto" />
                </Link>
                <div class="bg-green text-white" v-if="flashSuccess">{{ flashSuccess }}</div>
                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex justify-between">
                    <NavLink class="ml-80 text-white" :href="`/`" :active="route().current('login')">
                        Inicio
                    </NavLink>
                    <!-- Renderização dinâmica das categorias -->
                    <template v-if="categories && categories.length">
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" v-for="category in categories"
                            :key="category.id">
                            <NavLink class="ml-3 text-white" :href="`/category/${category.id}/products`">{{
                                category.name }}</NavLink>
                        </div>
                    </template>
                    <NavLink v-if="!auth.user" class="ml-3 text-white" :href="`/login`">
                        <div class="justify-end">Login</div>
                    </NavLink>
                    <div v-if="auth.user" class="relative ml-20">
                        <button @click="toggleDropdown" class="flex items-center text-white focus:outline-none">
                            <img :src="auth.user.profile_photo_url" alt="User Avatar" class="h-8 w-8 rounded-full">
                        </button>
                        <div v-if="dropdownOpen"
                            class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-sm shadow-gray-900 py-1 z-20">
                            <div class="px-4 py-2">
                                <div class="text-gray-900 font-semibold">Olá, {{ auth.user.name }}!</div>
                                <div class="flex justify-center mt-2">
                                    <img :src="auth.user.profile_photo_url" alt="User Avatar"
                                        class="h-16 w-16 rounded-full">
                                </div>
                                <div class="flex justify-center text-sm text-gray-600">{{ auth.user.email }}</div>
                            </div>
                            <div class="border-t border-gray-200 mt-2"></div>
                            <Link :href="`/my-account`" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Minha conta
                            </Link>
                            <div>
                                <Link class="block px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                                    :href="`/manage`">
                                Gestão
                                </Link>
                                <div class="ml-4">
                                    <ul class="list-none list-inside">
                                        <li>
                                            <Link :href="`/manage/category`"
                                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            Gerir categorias
                                            </Link>
                                        </li>
                                        <li>
                                            <Link :href="`/manage/brand`"
                                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            Gerir marcas
                                            </Link>
                                        </li>
                                        <li>
                                            <Link :href="`/manage/product`"
                                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            Gerir produtos
                                            </Link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button @click="logout" class="block w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100">
                                Terminar sessão
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow mb-auto">
            <slot></slot>
        </main>

        <footer class="h-20 w-full bg-gray-900 px-4 sm:px-6 lg:px-9 p-5 flex justify-center items-center text-white">
            All rights reserved to @Museek2024
        </footer>
    </div>
</template>

<script setup>
import {
    Link, usePage,
} from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import NavLink from '@/Components/NavLink.vue';
import axios from 'axios';
import { ref, onMounted, onUnmounted, watch } from 'vue'

const { props } = usePage();
const auth = props.auth;
let categories = props.cachedCategories;


const dropdownOpen = ref(false)

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value
}

const closeDropdown = (event) => {
    if (!event.target.closest('.relative')) {
        dropdownOpen.value = false
    }
}

onMounted(() => {
    document.addEventListener('click', closeDropdown)
})

onUnmounted(() => {
    document.removeEventListener('click', closeDropdown)
})

const logout = () => {
    axios.post('/logout').then(response => {
        window.location = '/';
    })
};

const page = usePage();
// listen for profile updates
watch(() => page.props.auth.user, (newValue) => {
    auth.user = newValue;
});

// list for category updates
watch(() => page.props.cachedCategories, (newValue) => {
    categories = newValue;
});
</script>
