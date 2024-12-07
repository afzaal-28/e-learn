<template>
    <footer class="admin-footer">
      <div class="card">
        <p className="" >&copy; 2024 E-Learning. All Rights Reserved.</p>
      </div>
    </footer>
  </template>
  
  <script>
  export default {
    name: 'Footer'
  };
  </script>
  
  <style scoped>
  .admin-footer {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000; /* Ensures it appears on top of other elements */
  }
  
  .card {
    background-color: rgb(17 24 39 / var(--tw-bg-opacity, 1));
    color: #fff;
    padding: 10px;
    border-radius: 12px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow effect */
    text-align: center;
    font-size: 14px;
    margin-bottom: -10px;
  }
  @media (max-width: 768px) {
  .footer {
    font-size: 12px;
  }
  .footer-copyright {
    font-size: 14px; /* Slightly bigger text for mobile */
  }
}
  </style>
  