<template>
  <AdminLayout>
    <template #header>
      <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
        <i class="fas fa-home mr-2"></i> Admin Home
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="shadow-cg p-6 text-gray-900">
            <h1 class="text-3xl font-bold mb-6 flex items-center">
               Welcome to the Admin Home Page!
            </h1>

            <!-- Game Section -->
            <!-- <div class="grid grid-cols-1 gap-6 mb-6">
              <div class="bg-gray-50 p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                  <i class="fas fa-gamepad i-2xl text-purple-600 mr-2"></i> Mini Game
                </h3>
                <GameComponent />
              </div>
            </div> -->
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <!-- User Statistics -->
              <div class="bg-gray-50 p-6 rounded-lg shadow-lg flex items-center">
                <i class="fas fa-users i-3xl text-green-600 mr-4"></i>
                <div>
                  <h3 class="text-lg font-semibold mb-4">User Statistics</h3>
                  <UserStats />
                </div>
              </div>

              <!-- Course Statistics -->
              <div class="bg-gray-50 p-6 rounded-lg shadow-lg flex items-center">
                <i class="fas fa-book i-3xl text-red-600 mr-4"></i>
                <div>
                  <h3 class="text-lg font-semibold mb-4">Course Statistics</h3>
                  <CourseStats />
                </div>
              </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-lg mb-6">
              <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-info-circle i-2xl text-yellow-600 mr-2"></i> Additional Information
              </h3>
              <p class="text-gray-700">Here you can add more widgets or information relevant to the admin dashboard.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Clock from '@/Components/Clock.vue';
import UserStats from '@/Components/UserStats.vue';
import CourseStats from '@/Components/CourseStats.vue';
import GameComponent from '@/Components/GameComponent.vue'; 
import '/public/css/style.css';
</script>


