<!-- resources/js/Components/CourseStats.vue -->
<template>
  <div>
    
    <div class="mt-4">
      <p>Total Courses: {{ totalCourses }}</p>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const totalCourses = ref(0);

onMounted(async () => {
  try {
    const response = await axios.get('admin/admin/courses-stats'); // Ensure this URL matches your route
    totalCourses.value = response.data.totalCourses;
  } catch (error) {
    console.error('Error fetching course stats:', error);
  }
});
</script>

<style scoped>
/* Add any styles for CourseStats here */
</style>
