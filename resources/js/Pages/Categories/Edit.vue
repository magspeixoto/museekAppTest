<template>
  <AppLayout>
    <div class="flex justify-center">
    <div class="block justify-center items-center mt-20 mb-0 col-span-2">
    <Link class="p-5 bg-orange-300 rounded" :href="`/product/index`">Back</Link>
    <form @submit.prevent="update" class="flex-column justify-center items-center">
        <div class="items-center col-span-2 justify-center mt-5 ">
          <Link class="p-5 bg-orange-300 rounded" :href="`/product/index`">Back</Link>
                        <label class="block text-sm font-medium leading-6 text-gray-900">Change Category </label>
                        <input v-model="form.name" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.name" class="input-error">
                            {{ form.errors.name }}
                        </div>
                    </div>
  
        <div class="col-span-6 mb-80">
          <button type="submit"
                            class="btn-primary px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">Update</button>
        </div>
      </form>
    </div>
  </div>
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