<template>
    <div class="flex flex-col min-h-screen justify-between">
        <header class="bg-gray-900 p-20 w-full">  
                <!-- Logo -->
                <div class="flex items-center justify-center ">
                    <Link :href="`/index`">
                    <ApplicationMark class="block h-9 w-auto" />
                    </Link>
                    <div class="bg-green text-white" v-if="flashSuccess">{{ flashSuccess }}</div>
                    <!-- Navigation Links -->
                    <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex justify-between">
                        <NavLink class="ml-80 text-white" :href="`/index`" :active="route().current('login')">
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
                        <NavLink v-if="auth.user" class="ml-3 text-white" :href="`/myaccount`">
                            <div class="justify-end">A minha conta</div>
                        </NavLink>
                        <NavLink v-if="!auth.user" class="ml-3 text-white" :href="`/login`">
                            <div class="justify-end">Login</div>
                        </NavLink>
                        <NavLink v-if="auth.user" as="button" @click="logout" class="ml-20 text-white">
                            Terminar sessão
                        </NavLink>                        
                    </div>
                    <!-- CAROUSEL OF PRODUCTS: TO DO-->

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

const { props } = usePage();
const auth = props.auth;
const categories = props.categories;

const logout = () => {
    axios.post('/logout').then(response => {
        window.location = '/index';
    })
};


</script>
