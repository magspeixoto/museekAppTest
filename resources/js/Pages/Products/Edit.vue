<template>
  <AppLayout>
    <form @submit.prevent="update">
      <div class="flex grid-cols-8 gap-6">
        <div class="col-span-2">
          <label class="label">Name Product</label>
          <input v-model="form.name" type="text" class="input" />
          <div v-if="form.errors.name" class="input-error">
            {{ form.errors.name }}
          </div>
        </div>
        <div class="col-span-2">
          <label class="label">Image Product</label>
          <input v-model="form.image" type="text" class="input" />
          <div v-if="form.errors.image" class="input-error">
            {{ form.errors.image }}
          </div>
        </div>
        <div class="col-span-2">
          <label class="label">Price Product</label>
          <input v-model="form.price" type="text" class="input" />
          <div v-if="form.errors.price" class="input-error">
            {{ form.errors.price }}
          </div>
        </div>
        <div class="col-span-2">
          <label class="label">Description Product</label>
          <input v-model="form.description" type="text" class="input" />
          <div v-if="form.errors.description" class="input-error">
            {{ form.errors.description }}
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
    product: Object,
  })
  const form = useForm({
    name: props.product.name,
    image: props.product.image,
    price: props.product.price,
    description: props.product.description,
  
  })
  const update = () => form.put(
    route('product.update', { product: props.product.id }),
  )
  </script>