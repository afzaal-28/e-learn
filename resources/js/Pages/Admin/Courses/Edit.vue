
<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
const props = defineProps(['course']);
import '/public/css/style.css';

const form = useForm({
  title: props.course.title,
  description: props.course.description,
  duration: props.course.duration,
  level: props.course.level
});



function submit() {
  form.put(route('admin.courses.update', props.course.id), {
    onSuccess: () => form.reset(),
  });
}
</script>

<template>
  <AdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Course edit page</h2>
    </template>
    <Head title="Edit Course" />

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-4">Edit Course</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="title" class="block text-gray-700">Title</label>
          <input v-model="form.title" id="title" type="text" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
          <label for="description" class="block text-gray-700">Description</label>
          <textarea v-model="form.description" id="description" class="w-full p-2 border rounded" required></textarea>
        </div>

        <div class="mb-4">
          <label for="duration" class="block text-gray-700">Duration</label>
          <input v-model="form.duration" id="duration" type="text" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
          <label for="level" class="block text-gray-700">Level</label>
          <input v-model="form.level" id="level" type="text" class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
          Update Course
        </button>
        <Link :href="route('admin.courses.index')" class="bg-red-500   ml-2 text-white courselink px-4 rounded hover:bg-red-600">Back to Courses</Link>
        

      </form>
    </div>
  </AdminLayout>
</template>
