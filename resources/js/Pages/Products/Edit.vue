<template>
  <AppLayout>
    <div class="flex justify-center">
      <div class="block justify-center items-center mt-20 mb-0 col-span-2">
        <Link class="p-5 bg-orange-300 rounded" :href="`/product/index`">Back</Link>
        <form  @submit.prevent="update"
        class="flex-column justify-center items-center">
        <div class="items-center col-span-2 justify-center mt-5">
          <label class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
                        <input v-model="form.name" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.name" class="input-error">
                            {{ form.errors.name }}
                        </div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product image </label>
                        <input v-model="form.image" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.image" class="input-error">
                            {{ form.errors.image }}
                        </div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product price </label>
                        <input v-model="form.price" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.price" class="input-error">
                            {{ form.errors.price }}
                        </div>
                    </div>

                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product description </label>
                        <input v-model="form.description" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.description" class="input-error">
                            {{ form.errors.description }}
                        </div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product description </label>
                        <input v-model="form.description" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.description" class="input-error">
                            {{ form.errors.description }}
                        </div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900" for="category">Choose
                            Category</label>
                        <select class="input w-96 border border-gray-600 rounded" id="category" v-model="form.category">
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                            <div v-if="form.errors.category" class="input-error">
                                {{ form.errors.category }}
                            </div>
                        </select>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900" for="brand">Choose
                            Brand</label>
                        <select class="input w-96 border border-gray-600 rounded items-center" id="brand"
                            v-model="form.brand">
                            <option class="border border-gray-600 rounded" v-for="brand in brands" :key="brand.id"
                                :value="brand.id">
                                {{ brand.name }}
                            </option>
                            <div v-if="form.errors.brand"
                                class="input-error mt-5 ml-5 px-5 py-3 w-96 border border-gray-600 rounded">
                                {{ form.errors.brand }}
                            </div>
                        </select>
                    </div>
                    <div class="flex justify-center mb-10">
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
import { Link, useForm } from '@inertiajs/vue3'
  
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