<template>
  <AppLayout>
    <form @submit.prevent="update">
      <div class="grid grid-cols-6 gap-4">
        <div class="col-span-2">
          <label class="label">Name User</label>
          <input v-model="form.name" type="text" class="input" />
          <div v-if="form.errors.name" class="input-error">
            {{ form.errors.name }}
          </div>
        </div>
        <div class="col-span-2">
          <label class="label">Email User</label>
          <input v-model="form.email" type="text" class="input" />
          <div v-if="form.errors.email" class="input-error">
            {{ form.errors.email }}
          </div>
        </div>
        <div class="col-span-2">
          <label class="label">Password User</label>
          <input v-model="form.password" type="text" class="input" />
          <div v-if="form.errors.password" class="input-error">
            {{ form.errors.password }}
          </div>
        </div>
        
  
        <div class="col-span-6">
          <button type="submit" class="btn-primary">Update</button>
        </div>
      </div>
    </form>
  </AppLayout>
  </template>
  
  <script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3'
  
  const props = defineProps({
    user: Object,
  })
  const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: props.user.password,
  
  })
  const update = () => form.put(
    route('user.update', { user: props.user.id }),
  )
  </script>