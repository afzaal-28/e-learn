<template>
  <div class="admin-layout">
    <!-- Header Section -->
    <Header />
    
    <div class="main-content">
      <!-- Sidebar Section -->
      <Sidebar />
      
      <div class="content">
        <!-- Main Content -->
        <main>
          <slot />
        </main>
      </div>
    </div>
    
    <!-- Footer Section -->
    <Footer />
  </div>
</template>

<script>
import Header from '../components/common/Admin/Header.vue';
import Footer from '../components/common/Admin/Footer.vue';
import Sidebar from '../components/common/Admin/Sidebar.vue';

export default {
  components: {
    Header,
    Footer,
    Sidebar
  }
};
</script>

<style scoped>
/* Layout Structure */
.admin-layout {
  display: flex;
  flex-direction: column;
  height: 100vh; /* Ensure full viewport height */
}

.main-content {
  display: flex;
  flex-grow: 1;
  overflow: hidden;
}

.content {
  flex-grow: 1;
  padding: 50px;
  background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1)); /* Light background color */
  overflow-y: auto; /* Allow scrolling if content overflows */
  margin-left: 60px; /* Add margin to push content to the right of the sidebar */
}

@media (max-width: 768px) {
  .main-content {
    flex-direction: column;
  }

  .content {
    padding: 20px; /* Reduced padding on smaller screens */
  }
}
</style>
