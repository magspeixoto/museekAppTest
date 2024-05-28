<template>
  <AppLayout>
    <div class="grid grid-rows justify-between mx-20 mt-5 text-gray-700">
      <h1 class="text-3xl font-bold">Gestão</h1>

      <div class="flex my-20 gap-6 items-center">
        <Link v-if="hasPermission('manage categories')"
          class="bg-gray-900 text-white p-5 flex items-center gap-2 hover:bg-gray-700 transition-colors duration-300"
          :href="'manage/category'">
        <i class="fas fa-th-list"></i>
        <span>Gerir categorias</span>
        </Link>
        <Link v-if="hasPermission('manage brands')"
          class="bg-gray-900 text-white p-5 flex items-center gap-2 hover:bg-gray-700 transition-colors duration-300"
          :href="'manage/brand'">
        <i class="fas fa-tags"></i>
        <span>Gerir marcas</span>
        </Link>
        <Link v-if="hasPermission('manage products')"
          class="bg-gray-900 text-white p-5 flex items-center gap-2 hover:bg-gray-700 transition-colors duration-300"
          :href="'/manage/product'">
        <i class="fas fa-boxes"></i>
        <span>Gerir produtos</span>
        </Link>
        <Link v-if="hasPermission('manage users')"
          class="bg-gray-900 text-white p-5 flex items-center gap-2 hover:bg-gray-700 transition-colors duration-300"
          :href="'/manage/users'">
        <i class="fas fa-users"></i>
        <span>Gerir utilizadores</span>
        </Link>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.user)

const hasPermission = (permission) => {
  const currentUser = user.value;
  if (currentUser && currentUser.permissions) {
    return currentUser.permissions.includes(permission);
  }
  return false;
} 
</script>

