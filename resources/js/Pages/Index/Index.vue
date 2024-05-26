<template>
    <AppLayout>
        <!--  <div class="bg-black">
            CAROUSEL OF PRODUCTS: TO DO
            <div class="bg-white">
                <Carousel :perPage="3" :autoplay="false" :paginationEnabled="true">
                    <Slide v-for="product in products" :key="product.id">
                        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Produtos mais recentes:</h2>
                            <div
                                class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                                <Link :href="`/products/${product.id}`" v-for="product in products" :key="product.id"
                                    class="group relative">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                    <img :src="product.image"
                                        class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <div>
                                        <h3 class="text-sm text-gray-700">
                                            <a href="#"><span aria-hidden="true"
                                                    class="absolute inset-0"></span>{{ product.name }}</a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">{{ product.description }}</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">{{ product.price }}$</p>
                                </div>
                                </Link>
                            </div>
                        </div>
                    </Slide>
                </Carousel>
            </div>
        </div>
        <div>
        </div> -->
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
