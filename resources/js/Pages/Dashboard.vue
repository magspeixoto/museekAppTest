<template>
    <AppLayout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <Link href="/index">
                        <ApplicationMark class="block h-9 w-auto" />
                    </Link>
                </div>
    
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink class="ml-3" href="/index" :active="route().current('login')">
                       Home
                    </NavLink>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" v-for="category in categories" :key="category.id">
                        <NavLink class="" :href="`/category/${category.id}`">{{ category.name }}</NavLink>
                    </div>
                    <NavLink class="ml-20":href="`/myaccount`">
                        Minha Conta
                    </NavLink>
                    
                </div>
                <!-- CAROUSEL OF PRODUCTS: TO DO-->
            </div>
        </div>
        
        <div class="bg-black">
            <!-- CAROUSEL OF PRODUCTS: TO DO-->
        </div>
    </div>
</AppLayout>
    </template>
    
    <script setup>
    import { Head, Link, router } from '@inertiajs/vue3';
    import ApplicationMark from '@/Components/ApplicationMark.vue';
    import NavLink from '@/Components/NavLink.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
    
    defineProps({
            categories:Object,
    })
    
    </script>