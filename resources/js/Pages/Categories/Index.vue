<template>
  <AppLayout>
      <div class="mt-10 mx-60">
          <Link class="bg-gray-900 text-white border p-5" :href="('/category/create')">Create New Category</Link><br><br>
          <div class="flex pt-5 flex-wrap gap-4">
              <div class="flex flex-col border p-10" v-for="category in categories" :key="category.id">
                  <h2>{{  category.name }}</h2><br>
                  <Link class="" :href="`/category/${category.id}`">Read more</Link>
                  <Link class="" :href="`/category/edit/${category.id}`">Edit Category</Link>
                  <Link class="" :href="`/category/delete/${category.id}`" method="DELETE">Delete category</Link>
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
  categories: Array,
});

</script>