<template>
    <AppLayout>       
        <carousel :items-to-show="4">
            <slide v-for="product in products" :key="product.id">
                <div class="mt-20 mb-20 mx-auto max-w-sm rounded-lg overflow-hidden shadow-lg bg-white">
                    <img :src="product.image" alt="Product Image" class="">

                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ product.name }}</div>
                        <p class="text-gray-700 text-base">{{ product.description }}</p>
                    </div>

                    <div class="px-6 pt-4 pb-2">
                        <p class="text-gray-900 font-bold text-xl">{{ product.price }}$</p>
                    </div>
                </div>
            </slide>

            <template #addons>
                <navigation />
                <pagination />
            </template>
        </carousel>
    </AppLayout>
</template>

<script setup>
    import {
        Head,
        Link,
        router, usePage
    } from '@inertiajs/vue3'
    import AppLayout from '@/Layouts/AppLayout.vue';
    import 'vue3-carousel/dist/carousel.css'
    import {
        Carousel,
        Slide,
        Pagination,
        Navigation
    } from 'vue3-carousel'
    const { category, products } = usePage().props;
    console.log("Valor de products:", products);
console.log("Valor de products.links:", products && products.links);


    const props = defineProps({
        products: Object,
        categories: Object,
    })

    console.log(props);

    // Importar os componentes de carousel diretamente
    import {
        ref
    } from 'vue'

    const carouselProps = {
        itemsToShow: 1.5
    }

    const slides = ref([...Array(10).keys()]) // Criar uma matriz de slides

</script>
