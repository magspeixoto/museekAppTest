<template>
    <AppLayout>
    <h1>{{ category.name }}</h1>
</AppLayout>
    </template>
    
    <script setup>
    
    import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
    
    defineProps({
        category:Object,
    })
    
    </script>