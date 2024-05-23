<template>
  <AppLayout>
  <h1 class="mx-80 pl-20 text-3xl mb-4 bg-gray-900 text-white">As tuas categorias</h1>

  <div class="mx-80 container mx-auto pt-5 gap-4 flex my-20 items-center ">
      <Link class="bg-gray-900 text-white p-5 mx-40" :href="('/category/create')">Criar Nova Categoria</Link><br><br>
      <div class="category__block grid bg-gray-900 text-white p-5" v-for="category in categories" :key="category.id">
          <h2>{{  category.name }}</h2><br>
          <Link class="" :href="`/category/${category.id}`">Ver mais</Link>
          <Link class="" :href="`/category/edit/${category.id}`">Editar categoria</Link>
          <Link class="" :href="`/category/delete/${category.id}`" method="DELETE">Apagar categoria</Link>
          <br>
      </div>
  </div>

</AppLayout>


</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
defineProps({
  categories: Array,
});

</script>