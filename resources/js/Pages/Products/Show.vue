<template>
    <AppLayout>
        <div class="mt-10 mx-60">
            <div class="flex pt-5 flex-wrap gap-4">
                <div class="flex flex-col border p-10">
                    <h1>Product Name: {{ product.name }}</h1>
                    <h2>URL: {{ product.image }}</h2>
                    <h3>Price: {{ product.price }}$</h3>
                    <h4>Description: {{ product.description }}</h4>
                    <br>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import {
        defineProps
    } from 'vue';

    defineProps({
        product: Object,
    })

</script>
