<!-- resources/js/Components/UserStats.vue -->
<template>
  <div>
    
    <div class="mt-4">
      <p>Total Users: {{ totalUsers }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const totalUsers = ref(0);

onMounted(async () => {
  try {
    const response = await axios.get('admin/admin/user-stats');
    totalUsers.value = response.data.totalUsers;
  } catch (error) {
    console.error('Error fetching user stats:', error);
  }
});
</script>

<style scoped>
/* Add any styles for UserStats here */
</style>
