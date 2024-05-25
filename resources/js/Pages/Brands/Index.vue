<template>
    <AppLayout>
        <div class="mt-10 mx-60">
            <Link class="bg-gray-900 text-white border p-5" :href="('/brand/create')">Create New Brand</Link><br><br>
            <div class="flex pt-5 flex-wrap gap-4">
                <div class="flex flex-col border p-10" v-for="brand in brands" :key="brand.id">
                    <h2>{{  brand.name }}</h2><br>
                    <Link class="" :href="`/brand/${brand.id}`">Read more</Link>
                    <Link class="" :href="`/brand/edit/${brand.id}`">Edit Brand</Link>
                    <Link class="" :href="`/brand/delete/${brand.id}`" method="DELETE">Delete Brand</Link>
                    <br>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import {
        Link
    } from '@inertiajs/vue3'
    defineProps({
        brands: Array,
    });

</script>
