<template>
<AppLayout>
    <h1>{{ user.name }}</h1>
    <h1>{{ user.email }}</h1>
    <h1>{{ user.password }}</h1>
</AppLayout>
    </template>
    
    <script setup>
    
    import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
    
    defineProps({
        user:Object,
    })
    
    </script>