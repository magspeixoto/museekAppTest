<template>
<AppLayout>
<h1>{{ brand.name }}</h1>
</AppLayout>
</template>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

defineProps({
    brand:Object,
})

</script>