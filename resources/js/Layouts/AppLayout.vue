<template>
    
    <div class="bg-gray-900 mx-auto px-4 sm:px-6 lg:px-9 ">
        <div class="flex justify-center h-36 border-b border-gray-200">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center">
                    <Link :href="`/index`">
                    <ApplicationMark class="block h-9 w-auto" />
                    </Link>
                <div class="bg-green text-white" v-if="flashSuccess">{{flashSuccess}}</div>
                <!-- Navigation Links -->
                <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex justify-between">
                    <NavLink class="ml-80 text-white" :href="`/index`" :active="route().current('login')">
                        Home
                    </NavLink>
                    <!-- Renderização dinâmica das categorias -->
                    <template v-if="categories && categories.length">
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" v-for="category in categories" :key="category.id">
                            <NavLink class="ml-3 text-white" :href="`/category/${category.id}/products`">{{ category.name }}</NavLink>
                        </div>
                    </template>
                    <NavLink v-if="auth.user" class="ml-3 text-white" :href="`/myaccount`">
                        <div class="justify-end">A minha conta</div>
                    </NavLink>
                    <NavLink v-if="!auth.user" class="ml-3 text-white" :href="`/login`">
                        <div class="justify-end">Login</div>
                    </NavLink>
                    
                    
                    <NavLink v-if="auth.user" as="button" @click="logout" class="ml-20 text-white">
                        Logout
                    </NavLink>
                    <!-- <div class="flex" v-if="auth.user">{{ user.name }}</div> -->
                </div>
                <!-- CAROUSEL OF PRODUCTS: TO DO-->
                
            </div>
        </div>
        <div></div>
    </div></div>
    <slot></slot>
        
    <div class="absolute inset-x-0 bottom-0 bg-gray-900 mx-auto px-4 sm:px-6 lg:px-9 mx-80 my-30 mt-30 p-10 flex justify-center items-center text-white ">
        
        <footer class="">All rights reserved to @Museek2024 </footer>
    </div>
    </template>

<script setup>
    import {
        Link, usePage,
    } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';
    import ApplicationMark from '@/Components/ApplicationMark.vue';
    import NavLink from '@/Components/NavLink.vue';
    import { defineProps } from 'vue';
    import axios from 'axios';

    const { props } = usePage();
    const auth = props.auth;

    const logout = () => {
  axios.post('/logout').then(response => {
    window.location = '/index';
  })
}
    defineProps({
        categories:Object,
    })

  
    const categories = ref([]);

    // Método para carregar as categorias do backend
    const loadCategories = async () => {
    try {
        const response = await axios.get('/categories'); // Certifique-se de importar axios ou usar outra forma de fazer a requisição HTTP
        categories.value = response.data;
    } catch (error) {
        console.error('Erro ao carregar categorias:', error);
    }
    };

    onMounted(() => {
        loadCategories();
    });


</script>
