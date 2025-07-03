<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Mini Order Management System - GEMGEM</h1>

    <!-- 🆕 Order Creation Form -->
    <form @submit.prevent="createOrder" class="space-y-4 bg-gray-50 p-4 rounded">
      <div>
        <label>Customer Name:</label>
        <input v-model="form.customer_name" class="input" required />
      </div>
      <div>
        <label>Item Name:</label>
        <input v-model="form.item_name" class="input" required />
      </div>
      <div>
        <label>Price:</label>
        <input type="number" v-model="form.price" class="input" required />
      </div>
      <div>
        <label>Status:</label>
        <select v-model="form.status" class="input">
          <option value="pending">Pending</option>
          <option value="paid">Paid</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create Order</button>
    </form>

    <!-- 📋 Orders Table -->
    <table class="w-full mt-8 border text-left">
      <thead>
        <tr class="bg-gray-100">
          <th class="p-2">Customer</th>
          <th>Item</th>
          <th>Price</th>
          <th>Status</th>
          <th>Update Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="order in orders" :key="order.id" class="border-b">
          <td class="p-2">{{ order.customer_name }}</td>
          <td>{{ order.item_name }}</td>
          <td>{{ order.price }}</td>
          <td>
            <span :class="statusColor(order.status)">
              {{ order.status }}
            </span>
          </td>
          <td>
            <select v-model="order.status" @change="updateStatus(order)" class="input">
              <option value="paid">Paid</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const orders = ref([]);
const form = ref({
  customer_name: '',
  item_name: '',
  price: '',
  status: 'pending',
});

const fetchOrders = async () => {
  const res = await axios.get('/api/orders');
  orders.value = res.data;
};

const createOrder = async () => {
  await axios.post('/api/orders', form.value);
  form.value = { customer_name: '', item_name: '', price: '', status: 'pending' };
  fetchOrders();
};

const updateStatus = async (order) => {
  await axios.patch(`/api/orders/${order.id}`, { status: order.status });
  fetchOrders();
};

const statusColor = (status) => {
  return {
    'text-yellow-500': status === 'pending',
    'text-green-600': status === 'paid',
    'text-red-600': status === 'cancelled',
  };
};

onMounted(() => {
  fetchOrders();
});
</script>

<style scoped>
.input {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 6px;
  width: 100%;
  max-width: 100%;
}
</style>
