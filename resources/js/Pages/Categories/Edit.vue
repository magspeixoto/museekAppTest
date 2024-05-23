<template>
  <AppLayout>
    <form @submit.prevent="update">
      <div class="grid grid-cols-6 gap-4">
        <div class="col-span-2">
          <label class="label">Name Category</label>
          <input v-model="form.name" type="text" class="input" />
          <div v-if="form.errors.name" class="input-error">
            {{ form.errors.name }}
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
    category: Object,
  })
  const form = useForm({
    name: props.category.name,
  
  })
  const update = () => form.put(
    route('category.update', { category: props.category.id }),
  )
  </script>