<template>
    <header class="admin-header">
      <nav>
        <ul>
          <li><Link :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</Link></li>
          <li><Link :href="route('dashboard')" :active="route().current('profile')">Profile</Link></li>
          <li><Link :href="route('dashboard')" :active="route().current('settings')">Settings</Link></li>
        </ul>
        <div class="search-bar">
          <input type="text" placeholder="Search..." />
        </div>
      </nav>
    </header>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3';
  
  export default {
    name: 'Header',
    components: {
      Link
    }
  };
  </script>
  
  <style scoped>
  .admin-header {
    background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1));
    color: #fff;
    padding: 15px 20px;
    position: fixed;
    height: 56px;
    top: 0;
    margin-left: 64px;
    margin-right: -1px;
    width: 100%;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding-right: 84px;
  }
  
  nav {
    background-color: rgb(17 24 39 / var(--tw-bg-opacity, 1));
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: -15px;
    height: 56px;
    width: 100%;
  }
  
  nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 20px;
    align-items: center;
  }
  
  nav li {
    position: relative;
  }
  
  nav a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 2px 12px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  
  nav a:hover {
    background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1));
    color: #f0f0f0;
  }
  
  .search-bar {
    display: flex;
    align-items: center;
  }
  
  .search-bar input {
    padding: 8px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ddd;
    outline: none;
    margin-top: 20px;
    height: 30px;
  }
  
  .search-bar input:focus {
    border-color: rgb(31 41 55 / var(--tw-bg-opacity, 1));
  }
  
  /* Ensure header doesn't overlap content */
  body {
    padding-top: 70px; /* This pushes the body content below the header */
  }
  
  @media (max-width: 768px) {
    nav ul {
      gap: 10px;
    }
  
    nav a {
      font-size: 14px;
    }
  
    .search-bar input {
      font-size: 12px;
    }
  }
  @media (max-width: 480px) {
  .admin-header {
    padding: 10px;
    height: auto;
  }

  nav ul {
    gap: 8px;
  }

  nav a {
    font-size: 14px;
  }

  .search-bar input {
    font-size: 12px;
    padding: 6px;
  }
}
@media (max-width: 1024px) {
  .search-bar input {
    width: 200px;
    font-size: 13px;
  }

  nav ul {
    gap: 15px;
  }
}

@media (max-width: 768px) {
  nav {
    flex-direction: column;
    align-items: flex-start;
    padding: 10px 0;
  }

  nav ul {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    width: 100%;
  }

  .search-bar {
    margin-top: 10px;
    width: 100%;
    justify-content: flex-end;
  }

  .search-bar input {
    width: 100%;
    font-size: 12px;
  }
}

  </style>
  