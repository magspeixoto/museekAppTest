<template>
    <AppLayout>
        <div>

            <div v-if="!products.data.length" class="h-20 flex justify-center border-s">
                <h3 class="mt-auto">Não existem produtos para esta categoria.</h3>
            </div>

            <!-- Produtos da categoria -->
            <div v-if="products.data.length">
                <div class="bg-white">
                    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                        <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ category.name }}</h2>
                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                            <div v-for="product in products.data" :key="product.id" :product="product"
                                class="group relative">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                    <img :src="getImageUrl(product.main_image)"
                                        class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <div>
                                        <h3 class="text-sm text-gray-700">
                                            <a :href="`/products/${product.id}`"><span aria-hidden="true"
                                                    class="absolute inset-0"></span>{{ product.name }}</a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">{{ product.description }}</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">{{ product.price }}$</p>
                                </div>
                            </div>
                        </div>
                        <div v-if="products.last_page > 1" class="mt-4">
                            <Pagination :links="products.links" :from="products.from" :to="products.to"
                                :total="products.total" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import {
    Link,
    usePage
} from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';


const { category, products } = defineProps({
    category: Object,
    products: Object,
});

const getImageUrl = (image) => {
    if (image && image.imageURL) {
        return `/storage/${image.imageURL}`;
    }
    return '';
};

</script>
