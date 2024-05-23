<template>
    <div>
      <div v-for="product in products.data" :key="product.id">
        <!-- Render product information here -->
        <div :product="product">
            {{ product.name }}
            {{ product.price }}
            {{ product.description }}
        </div>
      </div>
  
      <!-- Pagination -->
      <ul v-if="products.last_page > 1">
        <li v-for="page in products.last_page" :key="page" :class="{ 'active': page === products.current_page }">
          <button @click="fetchProducts(page)">{{ page }}</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { usePage, Inertia } from '@inertiajs/vue3';

  

  
  const props = defineProps({
    products: Object,
  })
  
  const fetchProducts = (page) => {
    Inertia.get(route('products.index', { category: props.products.current_page, page }), {}, {
      preserveState: true,
      onSuccess: ({ props }) => {
        products = props.products;
      },
    });
  };
  </script>