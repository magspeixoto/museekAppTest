<template>
  <AppLayout>
      <div class="mt-10 mx-60">
          <Link class="bg-gray-900 text-white border p-5" :href="('/user/create')">Create New User</Link><br><br>
          <div class="flex pt-5 flex-wrap gap-4">
              <div class="flex flex-col border p-10" v-for="user in users" :key="user.id">
                  <h2>{{  user.name }}</h2><br>
                  <Link class="" :href="`/user/${user.id}`">Read more</Link>
                  <Link class="" :href="`/user/edit/${user.id}`">Edit User</Link>
                  <Link class="" :href="`/user/delete/${user.id}`" method="DELETE">Delete User</Link>
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
    users: Array,
  });
  
  </script>