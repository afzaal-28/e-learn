<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import '/public/css/style.css';
</script>

<template>
  <AdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fas fa-user-circle"></i> Admin Profile
      </h2>
    </template>

    <div v-if="profile" class="edit-form">
      <h1 class="page-title">
        <i class="fas fa-user"></i> Admin Profile
      </h1>

      <form @submit.prevent="updateProfile">
        <!-- Name -->
        <div class="form-group">
          <label for="name">
            <i class="fas fa-user"></i> Name:
          </label>
          <input v-model="profile.name" id="name" type="text" class="form-input" required />
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="email">
            <i class="fas fa-envelope"></i> Email:
          </label>
          <input v-model="profile.email" id="email" type="email" class="form-input" required />
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password">
            <i class="fas fa-lock"></i> New Password:
          </label>
          <input v-model="password" id="password" type="password" class="form-input" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
          <label for="password_confirmation">
            <i class="fas fa-lock"></i> Confirm Password:
          </label>
          <input v-model="passwordConfirmation" id="password_confirmation" type="password" class="form-input" />
        </div>

        <!-- Update Button -->
        <div class="form-actions">
          <button type="submit" class="save-button">
            <i class="fas fa-save"></i> Update Profile
          </button>
        </div>
      </form>

      <!-- Delete Account -->
      <div class="delete-actions">
        <form @submit.prevent="deleteAccount" method="POST">
          <button type="submit" class="delete-button">
            <i class="fas fa-trash"></i> Delete Account
          </button>
        </form>
      </div>
    </div>

    <div v-else>
      <p>Loading...</p>
    </div>
  </AdminLayout>
</template>

<script>
export default {
  props: {
    profile: {
      type: Object,
      default: () => ({
        name: '',
        email: ''
      })
    }
  },
  data() {
    return {
      password: '',
      passwordConfirmation: '',
    };
  },
  methods: {
    async updateProfile() {
      if (this.password && this.password !== this.passwordConfirmation) {
        alert('Passwords do not match.');
        return;
      }

      await this.$inertia.patch('/admin/profile', {
        ...this.profile,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
      });
    },
    async deleteAccount() {
      if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        await this.$inertia.delete('/admin/profile');
      }
    }
  }
}
</script>


