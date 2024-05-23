<template>
<AppLayout>
  <h1>{{ product.name }}</h1>
  <h2>{{ product.image }}</h2>
  <h3>{{ product.price }}</h3>
  <h4>{{ product.description }}</h4>

</AppLayout>
  </template>
  
  <script setup>
  
  import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
  
  defineProps({
      product:Object,
  })
  
  </script>