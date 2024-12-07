<script setup>
import { ref, computed } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import '/public/css/style.css';
// Initialize form and props
const form = useForm({
  id: null,
  level: '',
});
const props = defineProps({
  students: {
    type: Array,
    default: () => [],
  },
  semesters: {
    type: Array,
    default: () => [],
  },
});
const selectedStudent = ref(null);
const filters = ref({
  search: '',
});

// Functions to handle deletion and update
const deleteStudent = (studentId) => {
  if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
    form.delete(`/admin/student/${studentId}`, {
      onSuccess: () => {
        alert('User deleted successfully.');
      },
      onError: () => {
        alert('An error occurred while deleting the user.');
      },
    });
  }
};

const updateSemesterLevel = (student) => {
  form.put(`/admin/student/${student.id}`, {
    data: {
      level: form.level,
    },
    onSuccess: () => {
      alert('Semester level updated successfully.');
    },
    onError: () => {
      alert('An error occurred while updating the semester level.');
    },
  });
};

const deleteSemesterLevel = (studentId) => {
  if (confirm('Are you sure you want to delete this semester level?')) {
    form.delete(`/admin/student/${studentId}/delete-semester`, {
      onSuccess: () => {
        alert('Semester level deleted successfully.');
      },
      onError: () => {
        alert('An error occurred while deleting the semester level.');
      },
    });
  }
};

// Computed property for filtered students (without semester filter)
const filteredStudents = computed(() => {
  return props.students.filter(student => {
    const matchesSearch = student.name.toLowerCase().includes(filters.value.search.toLowerCase()) ||
                          student.email.toLowerCase().includes(filters.value.search.toLowerCase());
    return matchesSearch;
  });
});
</script>

<template>
  <AdminLayout>
    <!-- Page Header -->
    <template #header>
      <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
        <i class="fas fa-users mr-2"></i> User Management
      </h2>
    </template>

    <!-- Filters Section -->
    <div class="filters-container mb-6">
      <input
        v-model="filters.search"
        type="text"
        placeholder="Search by name or email"
        class="filter-input"
      />
    </div>

    <!-- User List -->
    <div class="user-list">
      <table class="styled-table">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Semester Level</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Filtered students list -->
          <tr v-for="student in filteredStudents" :key="student.id">
            <td>{{ student.id }}</td>
            <td>{{ student.name }}</td>
            <td>{{ student.email }}</td>
            <td>{{ semesters.find(s => s.user_id === student.id)?.level || 'N/A' }}</td>
            <td>
              <!-- Delete Button with Icon -->
              <button @click="deleteStudent(student.id)" class="text-red-600 hover:text-red-800 transition duration-150">
                <i class="fas fa-trash-alt mr-1"></i> Delete
              </button>
              <!-- Edit Button with Icon -->
              <Link :href="route('student.edit', { student: student.id })" class="text-blue-600 hover:text-blue-800 transition duration-150 ml-3">
                <i class="fas fa-edit mr-1"></i> Edit
              </Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>


<style scoped>
/* General page background */
body {
  background-color: rgb(31, 41, 55); /* Dark gray */
  color: white; /* Light text for contrast */
  font-family: 'Inter', sans-serif;
}

/* Table Styling */
.styled-table {
  width: 100%;
  border-collapse: collapse;
  background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1)); /* Table background */
  border-radius: 8px;
  overflow: hidden;
}

.styled-table thead {
  background-color: rgb(55, 65, 81); /* Table header */
}

.styled-table th {
  color: white; /* Header text color */
  padding: 10px 15px;
  text-align: left;
}

.styled-table td {
  padding: 10px 15px;
  border-bottom: 0px solid rgb(75, 85, 99);/* Divider */
  color: rgb(229, 231, 235); /* Light gray text */
}


button:hover {
  color: rgb(239, 68, 68); /* Red on hover */
}

a {
  text-decoration: none;
  color: rgb(59, 130, 246); /* Blue links */
  transition: color 0.3s;
}

a:hover {
  color: rgb(37, 99, 235); /* Brighter blue */
}

/* Page Header */
h2 {
  color: white;
  display: flex;
  align-items: center;
}

h2 i {
  margin-right: 10px;
}

@media (max-width: 768px) {
  .styled-table th, .styled-table td {
    padding: 8px;
    font-size: 14px;
  }

  .filter-input {
    font-size: 14px;
  }
}
</style>
