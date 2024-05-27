<template>
    <div class="flash-message" :class="{'slide-up-out': !visible}">
      {{ message }}
    </div>
  </template>
  
  <script setup>
  import { ref, watch, onMounted } from 'vue'
  
  const props = defineProps({
    message: {
      type: String,
      required: true,
    },
    duration: {
      type: Number,
      default: 3000,
    }
  })
  
  const visible = ref(true)
  
  const hideMessage = () => {
    visible.value = false
  }
  
  onMounted(() => {
    setTimeout(hideMessage, props.duration)
  })
  </script>
  
  <style scoped>

  .flash-message {
    position: fixed;
    top: 50px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #38a169; /* bg-green-500 */
    color: white;
    padding: 1rem;
    border-radius: 0.25rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    animation: slide-down 0.3s ease-out forwards;
  }
  
  @keyframes slide-down {
    0% {
      transform: translateX(-50%) translateY(-100%);
      opacity: 0;
    }
    100% {
      transform: translateX(-50%) translateY(0);
      opacity: 1;
    }
  }
  
  .slide-up-out {
    animation: slide-up 0.3s ease-out forwards;
  }
  
  @keyframes slide-up {
    0% {
      transform: translateX(-50%) translateY(0);
      opacity: 1;
    }
    100% {
      transform: translateX(-50%) translateY(-100%);
      opacity: 0;
    }
  }
  </style>