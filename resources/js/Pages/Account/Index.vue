<template>
    <AppLayout>
      <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Minha Conta</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Account Information -->
          <div class="col-span-1 bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Informações da Conta</h2>
            <p><strong>Nome:</strong> {{ auth.user.name }}</p>
            <p><strong>Email:</strong> {{ auth.user.email }}</p>
            <img :src="auth.user.profile_photo_url" alt="User Avatar" class="h-16 w-16 rounded-full mt-4">
            <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar Informações</button>
          </div>
          
          <!-- Settings -->
          <div class="col-span-1 bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Configurações</h2>
            <button class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Mudar Senha</button>
          </div>
          
          <!-- Additional Section (e.g., Orders, Preferences) -->
          <div class="col-span-1 bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Outras Informações</h2>
            <button class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ver Pedidos</button>
            <button class="w-full mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Preferências</button>
          </div>
        </div>
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import { usePage } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue'
  
  const page = usePage()
  const auth = page.props.auth || { user: null }
  </script>
  
  <style scoped>
  /* Add any additional styling here */
  </style>