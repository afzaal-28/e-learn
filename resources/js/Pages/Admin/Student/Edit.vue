<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import '/public/css/style.css';
const props = defineProps({
  student: {
    type: Object,
    required: true,
  },
  semesters: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({
  name: props.student.name || '',
  email: props.student.email || '',
  id: null,
  level: '',
});

const getStudentIdFromUrl = () => {
  const url = window.location.href;
  const parts = url.split('/');
  return parts[parts.length - 2]; 
};

const updateSemesterLevel = () => {
  const studentId = getStudentIdFromUrl(); 

  if (!studentId) {
    alert('Student ID not found.');
    return;
  }

  form.put(`/admin/student/${studentId}`, {
    onSuccess: () => {
      alert('Semester level updated successfully.');
    },
    onError: () => {
      alert('An error occurred while updating the semester level.');
    },
  });
};

const updateStudent = () => {
  form.put(route('student.update', props.student.id), {
    onSuccess: () => {
      alert('Student details updated successfully.');
    },
    onError: (errors) => {
      alert('An error occurred while updating the student details.');
      console.error(errors);
    },
  });
};
</script>

<template>
  <AdminLayout>
    <template #header>
      <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
        <i class="fas fa-user-edit mr-2"></i> Edit Student
      </h2>
    </template>

    <div class="bg-white p-6 rounded-lg shadow-md">
      <div class="edit-form">
        <h2 class="text-xl font-bold mb-4 flex items-center">
          <i class="fas fa-info-circle mr-2"></i> User Info
        </h2>
        <form @submit.prevent="updateStudent">
          <!-- Student Name -->
          <div class="form-group">
            <label for="name" class="form-label">
              <i class="fas fa-user mr-2"></i> Name
            </label>
            <input
              v-model="form.name"
              type="text"
              id="name"
              class="form-input"
              required
            />
          </div>

          <!-- Student Email -->
          <div class="form-group">
            <label for="email" class="form-label">
              <i class="fas fa-envelope mr-2"></i> Email
            </label>
            <input
              v-model="form.email"
              type="email"
              id="email"
              class="form-input"
              required
            />
          </div>

          <!-- Semester Level Management -->
          <h2 class="text-xl font-bold mb-4 flex items-center">
            <i class="fas fa-book mr-2"></i> Semester Level
          </h2>
          <div class="form-group">
            <label for="semester-level" class="form-label">
              <i class="fas fa-calendar-alt mr-2"></i> Semester Level
            </label>
            <input
              id="semester-level"
              v-model="form.level"
              type="number"
              min="1"
              max="8"
              placeholder="Enter Semester Level"
              class="form-input"
            />
          </div>

          <button
            type="submit"
            class="save-button"
          >
            <i class="fas fa-save mr-2"></i> Save Changes
          </button>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

