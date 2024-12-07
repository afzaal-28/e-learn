<template>
  <body class="bg-gray-300">
    <!-- Sidebar Start -->
    <div class="flex flex-col items-center w-16 h-screen fixed top-0 left-0 overflow-hidden text-gray-400 bg-gray-900 ">
      <a class="flex items-center justify-center mt-3" href="#">
        <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
        </svg>
      </a>

      <!-- Menu Items Start -->
      <div class="flex flex-col items-center mt-3 border-t border-gray-700">
        <Link :href="route('admin.index')" :active="route().current('admin.index')" class="menu-item" title="Dashboard">
          <font-awesome-icon :icon="['fas', 'home']" />
        </Link>
        <Link :href="route('student.index')" :active="route().current('student.index')" class="menu-item" title="Users">
          <font-awesome-icon :icon="['fas', 'users']" />
        </Link>
        <Link :href="route('admin.courses.index')" :active="route().current('admin.courses.index')" class="menu-item" title="Settings">
          <font-awesome-icon :icon="['fas', 'cogs']" />
        </Link>
        <Link :href="route('admin.chats.index')" :active="route().current('admin.chats.index')" class="menu-item" title="Reports">
          <font-awesome-icon :icon="['fas', 'chart-bar']" />
        </Link>
      </div>

      <!-- Footer Start -->
      <Link class="flex items-center justify-center w-16 h-16 mt-auto bg-gray-800 hover:bg-gray-700 hover:text-gray-300" href="/admin/profile">
        <svg class="w-6 h-6 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </Link>
    </div>
    <!-- Sidebar End -->
  </body>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faHome, faUsers, faCogs, faChartBar } from '@fortawesome/free-solid-svg-icons';

library.add(faHome, faUsers, faCogs, faChartBar);

export default {
  name: 'Sidebar',
  components: {
    FontAwesomeIcon,
    Link
  }
};
</script>

<style scoped>
/* Sidebar Container */
.sidebar {
  position: fixed; /* Fix the sidebar at the top */
  top: 0; /* Align it to the top */
  left: 0; /* Align it to the left corner */
  width: 80px; /* Increased width for better spacing */
  height: 100vh; /* Full height */
  background-color: #343a40; /* Sidebar background */
  color: white;
  padding-top: 20px;
}

/* Sidebar Menu List */
.sidebar ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 20px; /* Reduced gap for better spacing */
}

.sidebar li {
  position: relative;
}

/* Menu Item Styling */
.menu-item {
  color: white;
  text-decoration: none;
  font-size: 24px; /* Adjusted size */
  display: block;
  padding: 15px;
  text-align: center;
  border-radius: 8px;
}

.menu-item.active {
  background-color: #007bff;
}

.menu-item::after {
  content: attr(title);
  position: absolute;
  top: 50%;
  left: 100%;
  transform: translateY(-50%);
  background-color: #222;
  color: white;
  padding: 5px 10px;
  font-size: 12px;
  border-radius: 5px;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}

.menu-item:hover::after {
  opacity: 1;
  visibility: visible;
}

/* Footer Section */
footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  display: flex;
  justify-content: center;
  padding: 10px;
}

</style>
