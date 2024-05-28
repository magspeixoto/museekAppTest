<template>
    <AppLayout>
        <carousel :items-to-show="4">
            <slide v-for="product in products" :key="product.id">
                <Link :href="`/products/${product.id}`" class="block">
                    <div class="mt-20 mb-20 mx-auto max-w-sm rounded-lg overflow-hidden shadow-lg bg-white transform transition-transform hover:scale-105 duration-300" style="width: 300px; height: 400px;">
                        <img :src="product.image" alt="Product Image" class="h-52 w-full object-cover">
                        
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ product.name }}</div>
                            <p class="text-gray-700 text-base">{{ product.description }}</p>
                        </div>
                        
                        <div class="px-6 pt-4 pb-2">
                            <p class="text-gray-900 font-bold text-xl">{{ product.price }}$</p>
                        </div>
                    </div>
                </Link>
            </slide>

            <template #addons>
                <navigation />
                <pagination />
            </template>
        </carousel>
    </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import 'vue3-carousel/dist/carousel.css'
import {
    Carousel,
    Slide,
    Pagination,
    Navigation
} from 'vue3-carousel';


const props = defineProps({
    products: Object,
    categories: Object,
})

</script>

<style scoped>
.carousel .slide {
    width: 300px;
    height: 400px;
}
</style>
