<template>
    <AppLayout>
    <div>
        <h1 class="bg-orange-600 flex justify-center">Create Product</h1>
        <form @submit.prevent="form.post('/product')">
            <div class="flex justify-center items-center mt-20 mb-0">
                    <label class="label ">Product Name</label>
                    <input v-model="form.name" type="text" class="input ml-5 mt-5 px-5 py-3 w-96 border border-gray-600 rounded" />
                    <div v-if="form.errors.name" class="input-error">
                        {{ form.errors.name }}
                    </div>
                </div>
                <div class="col-span-2 flex justify-center mb-2 mt-2 ">
                    <label class="label">Product image </label>
                    <input v-model="form.image" type="text" class="input ml-5 mt-5 px-5 py-3 w-96 border border-gray-600 rounded" />
                    <div v-if="form.errors.image" class="input-error">
                        {{ form.errors.image }}
                    </div>
                </div>
                <div class="col-span-2 flex justify-center mb-2 mt-2">
                    <label class="label">Product price </label>
                    <input v-model="form.price" type="text" class="input ml-5 mt-5 px-5 py-3 w-96 border border-gray-600 rounded" />
                    <div v-if="form.errors.price" class="input-error">
                        {{ form.errors.price }}
                    </div>
                </div>
                <div class="col-span-2 flex justify-center mb-2 mt-2">
                    <label class="label">Product description </label>
                    <input v-model="form.description" type="text" class="input ml-5 mt-5 px-5 py-3 w-96 border border-gray-600 rounded" />
                    <div v-if="form.errors.description" class="input-error">
                        {{ form.errors.description }}
                    </div>
                </div>
                <div class="col-span-2 flex justify-center mb-2 mt-2">
                    <label for="category">Choose Category</label>
                    <select id="category" v-model="form.category_id">
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                        <div v-if="form.errors.category_id" class="input-error ml-5 mt-5 px-5 py-3 w-96 border border-gray-600 rounded">
                        {{ form.errors.category_id }}
                    </div>
                    </select>
                </div>
                <div class="col-span-2 flex justify-center mb-2 mt-2">
                    <label for="brand">Brand</label>
                    <select id="brand" v-model="form.brand_id">
                        <option v-for="brand in brands" :key="brand.id" :value="brand.id">
                            {{ brand.name }}
                        </option>
                        <div v-if="form.errors.brand_id" class="input-error mt-5 ml-5 px-5 py-3 w-96 border border-gray-600 rounded">
                        {{ form.errors.brand_id }}
                    </div>
                    </select>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="btn-primary ml-5 px-5 py-3 mt-5 w-96 bg-orange-300 justify-center">Create product</button>
                </div>
        </form>
    </div>
</AppLayout>
</template>

<script>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'


export default {
    props: {
        categories: Array,
        brands: Array,
    },
    setup(props) {
        const form = useForm({
            name: '',
            description: '',
            price: '',
            image: '',
            category_id: '',
            brand_id: '',
        })

        const submit = () => {
            form.post('/products')
        }

        return {
            form,
            categories: props.categories,
            brands: props.brands,
            submit
        }
    }
}
</script>