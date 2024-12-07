<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

// Sample chat data
const chats = ref([
  { id: 1, user: 'User 1', message: 'Hello, I need help with my course!', timestamp: '2024-12-03 10:30 AM' },
  { id: 2, user: 'User 2', message: 'I have a question about the semester schedule.', timestamp: '2024-12-03 11:00 AM' },
  { id: 3, user: 'User 3', message: 'Can you help me with the assignment deadline?', timestamp: '2024-12-02 02:15 PM' },
]);

// Function to send a new message (for demonstration purposes)
const sendMessage = (message) => {
  if (message) {
    chats.value.push({
      id: chats.value.length + 1,
      user: 'Admin',
      message,
      timestamp: new Date().toLocaleString(),
    });
  }
};

// Ref for the new message input
const newMessage = ref('');
</script>

<template>
  <AdminLayout>
    <!-- Page Header -->
    <template #header>
      <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
        <i class="fas fa-comments mr-2"></i> Chat Management
      </h2>
    </template>

    <!-- Chat List Section -->
    <div class="chat-list mb-6">
      <div class="chat-box bg-white p-4 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold mb-3">Recent Chats</h3>
        
        <!-- Chat Items -->
        <div class="chat-messages">
          <div v-for="chat in chats" :key="chat.id" class="chat-item mb-4">
            <div class="flex justify-between items-center">
              <span class="font-semibold">{{ chat.user }}</span>
              <span class="text-sm text-gray-500">{{ chat.timestamp }}</span>
            </div>
            <p class="text-gray-700 mt-1">{{ chat.message }}</p>
          </div>
        </div>

        <!-- New Message Section -->
        <div class="mt-4">
          <input
            v-model="newMessage"
            type="text"
            placeholder="Type a message..."
            class="border border-gray-300 p-2 w-full rounded-lg"
          />
          <button @click="sendMessage(newMessage)" class="mt-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Send Message
          </button>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<style scoped>
/* Chat Box Styling */
.chat-box {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.chat-item {
  padding: 12px;
  border-bottom: 1px solid #eee;
}

.chat-item:last-child {
  border-bottom: none;
}

.chat-messages {
  max-height: 400px;
  overflow-y: auto;
}

input {
  border: 1px solid #ccc;
  padding: 10px;
  width: calc(100% - 20px);
  border-radius: 5px;
}

button {
  padding: 10px 15px;
  background-color: #1d4ed8;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: 100%;
}

button:hover {
  background-color: #2563eb;
}
</style>
