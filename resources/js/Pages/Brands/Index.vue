<template>
<AppLayout>
    <h1 class="mx-80 pl-20 text-3xl mb-4 bg-gray-900 text-white">As tuas marcas</h1>

<div class="mx-80 container mx-auto pt-5 gap-4 flex-column my-20 items-center ">
    <Link class="bg-gray-900 text-white p-5 mx-40 flex" :href="('/brand/create')">Criar Nova Marca</Link><br><br>
    <div class="brand__block grid bg-gray-900 text-white mx-40 p-10 flex" v-for="brand in brands" :key="brand.id">
        <h2>{{  brand.name }}</h2><br>
        <Link class="" :href="`/brand/${brand.id}`">Ver mais</Link>
        <Link class="" :href="`/brand/edit/${brand.id}`">Editar marca</Link>
        <Link class="" :href="`/brand/delete/${brand.id}`" method="DELETE">Apagar marca</Link>
        <br>
    </div>
</div>
</AppLayout>

</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
defineProps({
    brands: Array,
});

</script>