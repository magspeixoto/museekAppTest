<template>
  <AppLayout>
      <div class="mt-10 mx-60">
          <Link class="bg-gray-900 text-white border p-5" :href="('/product/create')">Create New Product</Link><br><br>
          <div class="flex pt-5 flex-wrap gap-4">
              <div class="flex flex-col border p-10" v-for="product in products" :key="product.id">
                  <h2>{{  product.name }}</h2><br>
                  <Link class="" :href="`/product/${product.id}`">Read more</Link>
                  <Link class="" :href="`/product/edit/${product.id}`">Edit Product</Link>
                  <Link class="" :href="`/product/delete/${product.id}`" method="DELETE">Delete Product</Link>
                  <br>
              </div>
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