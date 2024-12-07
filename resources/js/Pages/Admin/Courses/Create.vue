<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import '/public/css/style.css';
const form = useForm({
  title: '',
  description: '',
  duration: '',
  level: ''
});

function submit() {
  form.post(route('admin.courses.store'), {
    onSuccess: () => form.reset(),
  });
}
</script>

<template>
  <AdminLayout>
     <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add courses</h2>
    </template>
    <Head title="Add Course" />
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="shadow-cg p-6 text-gray-900">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-4">Add Course</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="title" class="block text-gray-700">Title</label>
          <input v-model="form.title" id="title" type="text" class="w-full p-2 border rounded filter-input" required>
        </div>

        <div class="mb-4">
          <label for="description" class="block text-gray-700">Description</label>
          <textarea v-model="form.description" id="description" class="w-full p-2 border rounded filter-input" required></textarea>
        </div>

        <div class="mb-4">
          <label for="duration" class="block text-gray-700">Duration</label>
          <input v-model="form.duration" id="duration" type="text" class="w-full p-2 border rounded filter-input">
        </div>

        <div class="mb-4">
          <label for="level" class="block text-gray-700">Level</label>
          <input v-model="form.level" id="level" type="text" class="w-full p-2 border rounded filter-input">
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
          Save Course
        </button>
      </form>
    </div></div></div></div></div>
  </AdminLayout>
</template>
