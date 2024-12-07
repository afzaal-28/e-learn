<template>
  <div class="clock-widget flex items-center justify-center">
    <!-- <i class="fas fa-clock text-4xl text-blue-600 mr-2"></i> -->
    <p class="text-2xl">{{ time }}</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const time = ref('');

const updateClock = () => {
  const now = new Date();
  time.value = now.toLocaleTimeString();
};

onMounted(() => {
  updateClock();
  setInterval(updateClock, 1000); // Update every second
});
</script>

<style scoped>
.clock-widget {
  padding: 1rem;
  border: 1px solid #e5e7eb; /* Tailwind gray-200 */
  border-radius: 8px;
  background-color:rgb(17 24 39 / var(--tw-bg-opacity, 1));
  text-align: center;
}
</style>
