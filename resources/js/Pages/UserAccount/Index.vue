<template>
  <AppLayout>

    <div class="grid grid-rows justify-between mx-20 mt-5 text-gray">
      <h1>Olá, {{ user.name }} </h1>

      <div class="flex my-20 gap-6 items-center">
        <Link class="bg-gray-900 text-white p-5" :href="'/category/index'">Categorias</Link><br>
        <Link class="bg-gray-900 text-white p-5" :href="'/brand/index'">Marcas</Link><br>
        <Link class="bg-gray-900 text-white p-5" :href="'/product/index'">Produtos</Link><br>
        <Link class="bg-gray-900 text-white p-5" :href="'/user/index'">Utilizadores</Link><br>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed } from 'vue';


const page = usePage()

const user = computed(
  () => page.props.user,
)




</script>