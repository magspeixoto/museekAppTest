<template>
  <AppLayout>
    <div class="mt-10 mx-60">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-900">Categorias</h1>
        <Link class="bg-gray-900 text-white border p-3 flex items-center space-x-2" :href="('/category/create')">
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
              <th scope="col"
                class="relative px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                Ações
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="category in categories.data" :key="category.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ category.name }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                <div class="flex justify-end space-x-4">
                  <Link class="text-indigo-600 hover:text-indigo-900" :href="`/category/${category.id}`"
                    title="Read more">
                  <i class="fas fa-eye"></i>
                  </Link>
                  <Link class="text-blue-600 hover:text-blue-900" :href="`/category/edit/${category.id}`" title="Edit">
                  <i class="fas fa-edit"></i>
                  </Link>
                  <Link class="text-red-600 hover:text-red-900" :href="`/category/delete/${category.id}?page=${categories.current_page}`" method="DELETE"
                    title="Delete">
                  <i class="fas fa-trash-alt"></i>
                  </Link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-if="categories.last_page > 1" class="mt-4">
        <Pagination :links="categories.links" :from="categories.from" :to="categories.to" :total="categories.total" />
      </div>
    </div>

    <FlashMessage v-if="flash.success" :message="flash.success" />
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue';
import FlashMessage from '@/Components/FlashMessage.vue';

const props = defineProps({
  categories: Array,
  flash: Object
});

</script>