<template>
  <AppLayout>
    <h1 class="mx-80 pl-20 text-3xl mb-4 bg-gray-900 text-white">Os teus produtos</h1>

<div class="mx-80 container mx-auto pt-5 gap-4 flex my-20 items-center ">
    <Link class="bg-gray-900 text-white p-5 mx-40" :href="('/product/create')">Criar Novo Produto</Link><br><br>
    <div class="product__block grid bg-gray-900 text-white p-5" v-for="product in products" :key="product.id">
        <h2>{{  product.name }}</h2><br>
        <Link class="" :href="`/product/${product.id}`">Ver mais</Link>
        <Link class="" :href="`/product/edit/${product.id}`">Editar produto</Link>
        <Link class="" :href="`/product/delete/${product.id}`" method="DELETE">Apagar produto</Link>
        <br>
    </div>
</div>
  </AppLayout>
  </template>
  
  <script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
  defineProps({
    products: Array,
  });
  
  </script>