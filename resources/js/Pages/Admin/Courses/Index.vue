<template>
  <AdminLayout>
    <!-- Page Header -->
    <template #header>
      <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
        <i class="fas fa-cog mr-2"></i> Admin Courses Management
      </h2>
    </template>

    <Head title="Courses" />
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="shadow-cg p-6 text-gray-900">
            <div class="bg-white overflow-hidden shadow-sg sm:rounded-lg"></div>
    <!-- Add New Course Button -->
    <div class="mb-6 float-end">
      <Link
        v-if="permissions.can_add_only"
        :href="route('admin.courses.create')"
        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded shadow-md hover:bg-green-700 transition duration-150 ease-in-out"
      >
        <i class="fas fa-plus-circle mr-2"></i> Add New Course
      </Link>
    </div>

    <!-- Filters Section -->
    <div class="mb-6">
      <input
        v-model="filters.search"
        type="text"
        placeholder="Search by title"
        class="filter-input"
      />
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="shadow-lg p-6 text-gray-900">
    <!-- Empty State -->
    <div v-if="filteredCourses.length === 0" class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg">
      <p class="font-semibold">No courses available. Click the "Add New Course" button to create one.</p>
    </div>

    <!-- Courses Table -->
    <div v-else class="overflow-hidden shadow-lg rounded-lg bg-white">
      <table class="min-w-full table-auto divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Title</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <!-- Loop through filtered courses -->
          <tr v-for="course in filteredCourses" :key="course.id" class="hover:bg-gray-50 transition-colors duration-200">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ course.title }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <div class="flex space-x-4">
                <!-- Edit Button -->
                <Link
                  v-if="permissions.can_edit_delete"
                  :href="route('admin.courses.edit', course.id)"
                  class="text-blue-600 hover:text-blue-800 transition duration-150"
                >
                  <i class="fas fa-edit"></i> Edit
                </Link>
                <!-- Delete Button -->
                <button
                  v-if="permissions.can_edit_delete"
                  @click="deleteCourse(course.id)"
                  class="text-red-600 hover:text-red-800 transition duration-150"
                >
                  <i class="fas fa-trash"></i> Delete
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    </div></div></div></div></div>
  </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import '/public/css/style.css';

import { useCourseManagement } from '/public/Pages/Course_index.js';

const props = defineProps({
  courses: {
    type: Array,
    default: () => [],
  },
  permissions: {
    type: Object,
    default: () => ({
      can_edit_delete: true,
      can_add_only: true,
    }),
  },
});

const { filters, filteredCourses, deleteCourse } = useCourseManagement(props.courses, props.permissions);
</script>


