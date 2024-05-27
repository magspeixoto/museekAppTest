<template>
  <nav class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
      <a
        v-for="(link, key) in links"
        :key="key"
        :href="link.url"
        v-html="link.label"
        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
        :class="{'text-gray-500': !link.url}"
        :aria-current="link.active ? 'page' : null"
      ></a>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Mostrar
          <span class="font-medium">{{ from }}</span>
          a
          <span class="font-medium">{{ to }}</span>
          de
          <span class="font-medium">{{ total }}</span>
          resultados
        </p>
      </div>
      <div>
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
          <a
            v-for="(link, key) in links"
            :key="key"
            :href="link.url"
            v-html="link.label"
            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
            :class="{'bg-gray-700 text-white hover:bg-gray-600': link.active, 'text-white-500 cursor-not-allowed': !link.url}"
            :aria-current="link.active ? 'page' : null"
          ></a>
        </nav>
      </div>
    </div>
  </nav>
</template>

<script setup>

defineProps({
  links: {
    type: Array,
    required: true
  },
  from: {
    type: Number,
    required: true
  },
  to: {
    type: Number,
    required: true
  },
  total: {
    type: Number,
    required: true
  }
})
</script>
