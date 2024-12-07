<template>
    <nav class="breadcrumb">
      <ol>
        <li><a href="/">Home</a></li>
        <li><a href="/dashboard">Dashboard</a></li>
        <li v-if="parent">
          <a :href="parent.link">{{ parent.name }}</a>
        </li>
        <li class="active">{{ title }}</li>
      </ol>
    </nav>
  </template>
  
  <script>
  export default {
    name: 'Breadcrumb',
    props: {
      title: {
        type: String,
        required: true
      },
      parent: {
        type: Object,
        default: null
      }
    },
    mounted() {
      console.log("Breadcrumb component mounted!");
    }
  };
  </script>
  
  
  <style scoped>
  .breadcrumb {
    background-color: #f8f9fa;
    padding: 10px 0;
  }
  
  .breadcrumb ol {
    list-style: none;
    display: flex;
    gap: 5px;
  }
  
  .breadcrumb li {
    display: inline;
  }
  
  .breadcrumb a {
    text-decoration: none;
    color: #007bff;
  }
  
  .breadcrumb .active {
    color: #6c757d;
  }
  </style>
  