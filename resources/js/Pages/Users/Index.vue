<template>
<AppLayout>
  <h1 class="mx-80 pl-20 text-3xl mb-4 bg-gray-900 text-white">Utilizadores (Área Reservada)</h1>

<div class="mx-80 container mx-auto pt-5 gap-4 flex my-20 items-center ">
    <Link class="bg-gray-900 text-white p-5 mx-40" :href="('/user/create')">Criar Novo Utilizador</Link><br><br>
    <div class="user__block grid bg-gray-900 text-white p-5" v-for="user in users" :key="user.id">
        <h2>{{  user.name }}</h2><br>
        <Link class="" :href="`/user/${user.id}`">Ver mais</Link>
        <Link class="" :href="`/user/edit/${user.id}`">Editar utilizador</Link>
        <Link class="" :href="`/user/delete/${user.id}`" method="DELETE">Apagar utilizador</Link>
        <br>
    </div>
</div>
  
  </AppLayout>
  
  </template>
  
  <script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
  defineProps({
    users: Array,
  });
  
  </script>