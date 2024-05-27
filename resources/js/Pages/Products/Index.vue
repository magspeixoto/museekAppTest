<template>
  <AppLayout>
    <div class="mt-10 mx-60">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-900">Produtos</h1>
        <Link class="bg-gray-900 text-white border p-3 flex items-center space-x-2" :href="('/product/create')">
        <i class="fas fa-plus"></i>
        <span>Adicionar</span>
        </Link>
      </div>
      <div class="flex pt-5">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nome
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Marca
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Categoria
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Preço
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Criado em
              </th>
              <th scope="col"
                class="relative px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                Ações
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="product in products.data" :key="product.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <img :src="getImageUrl(product.main_image)" alt="Product Image"
                    class="w-16 h-16 rounded-full mr-4">
                  <div class="text-sm text-gray-900">{{ product.name }}</div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ product.brand.name }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ product.category.name }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ product.price }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ new Date(product.created_at).toLocaleDateString() }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                <div class="flex justify-end space-x-4">
                  <Link class="text-indigo-600 hover:text-indigo-900" :href="`/product/${product.id}`" title="View">
                  <i class="fas fa-eye"></i>
                  </Link>
                  <Link class="text-blue-600 hover:text-blue-900" :href="`/product/edit/${product.id}`" title="Edit">
                  <i class="fas fa-edit"></i>
                  </Link>
                  <Link class="text-red-600 hover:text-red-900" :href="`/product/delete/${product.id}`" method="DELETE"
                    title="Delete">
                  <i class="fas fa-trash-alt"></i>
                  </Link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-if="products.last_page > 1" class="mt-4">
        <Pagination :links="products.links" :from="products.from" :to="products.to" :total="products.total" />
      </div>
    </div>
  </AppLayout>
</template>
  
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3'
const props = defineProps({
  products: Array,
});

console.log(props.products)

const getImageUrl = (image) => {
  if (image && image.imageURL) {
    return `/storage/${image.imageURL}`;
  }
  return '';
};

</script>