import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';

// Logic for managing courses
export function useCourseManagement(courses, permissions) {
  // Create a form using useForm for deletion
  const form = useForm({});

  // Define filters
  const filters = ref({
    search: '',
  });

  // Computed property for filtered courses
  const filteredCourses = computed(() => {
    return courses.filter(course =>
      course.title.toLowerCase().includes(filters.value.search.toLowerCase())
    );
  });

  // Method to handle course deletion
  const deleteCourse = (courseId) => {
    if (confirm('Are you sure you want to delete this course? This action cannot be undone.')) {
      form.delete(route('admin.courses.destroy', courseId), {
        onSuccess: () => {
          alert('Course deleted successfully.');
        },
        onError: (errors) => {
          alert('An error occurred while deleting the course.');
          console.error(errors);
        },
      });
    }
  };

  return {
    filters,
    filteredCourses,
    deleteCourse,
  };
}
