<template>
    <AppLayout>
      <div class="mt-10 mx-60">
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-2xl font-bold text-gray-900">Marcas</h1>
          <Link class="bg-gray-900 text-white border p-3 flex items-center space-x-2" :href="('/manage/brand/create')">
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
                <th scope="col" class="relative px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Ações
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="brand in brands.data" :key="brand.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ brand.name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                  <div class="flex justify-end space-x-4">
                    <Link class="text-indigo-600 hover:text-indigo-900" :href="`/manage/brand/${brand.id}`" title="Read more">
                      <i class="fas fa-eye"></i>
                    </Link>
                    <Link class="text-blue-600 hover:text-blue-900" :href="`/manage/brand/edit/${brand.id}`" title="Edit">
                      <i class="fas fa-edit"></i>
                    </Link>
                    <Link class="text-red-600 hover:text-red-900" :href="`/brand/delete/${brand.id}`" method="DELETE" title="Delete">
                      <i class="fas fa-trash-alt"></i>
                    </Link>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-if="brands.last_page > 1" class="mt-4">
          <Pagination :links="brands.links" :from="brands.from" :to="brands.to" :total="brands.total" />
        </div>

        <FlashMessage v-if="flash.success" :message="flash.success" />
      </div>
    </AppLayout>
  </template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import FlashMessage from '@/Components/FlashMessage.vue';
    import {
        Link
    } from '@inertiajs/vue3'
    defineProps({
        brands: Array,
        flash: Object
    });

</script>
