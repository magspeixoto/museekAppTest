<template>
    <AppLayout>
    <div class="flex justify-center">
        <div class="justify-center items-center col-span-2">
                <Link class="p-5 bg-orange-300 rounded" :href="`/product/index`">Back</Link>
                <form @submit.prevent="form.post('/product')"
                class="flex-column justify-center items-center">
                <div class="items-center col-span-2 justify-center mt-5">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
                        <input v-model="form.name" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.name" class="text-red-500">
                            {{ form.errors.name }}
                        </div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product image </label>
                        <input v-model="form.image" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.image" class="text-red-500">
                            {{ form.errors.image }}
                        </div>
                    </div>
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product price </label>
                        <input v-model="form.price" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.price" class="text-red-500">
                            {{ form.errors.price }}
                        </div>
                    </div>
                    
                    <div class="items-center col-span-2 justify-center mt-5 ">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Product description </label>
                        <input v-model="form.description" type="text"
                            class="input w-96 border border-gray-600 rounded items-center" />
                        <div v-if="form.errors.description" class="text-red-500">
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
                    <div class="flex justify-center">
                        <button type="submit"
                            class="btn-primary px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">Create
                            product</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue'
  import { useForm } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue';

  const form = useForm({
    name: '',
    description: '',
    price: '',
    image: '',
    category: '',
    brand: '',
  })

  const categories = ref([])
  const brands = ref([])

  const submit = () => {
    form.post('/products')
  }

  // Exporte todas as variáveis e funções necessárias
  

</script>
