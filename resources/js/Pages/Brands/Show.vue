<template>
    <AppLayout>
        <div class="mt-10 mx-60">
            <div class="flex pt-5 flex-wrap gap-4">
                <div class="flex flex-col border p-10">
                    <h2>Id: {{ brand.id }}</h2>
                    <h2>Name: {{  brand.name }}</h2><br>
                    <br>
                </div>
            </div>
        </div>
    </AppLayout>
  </template>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

defineProps({
    brand:Object,
})

</script>