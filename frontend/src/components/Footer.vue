<template>
  <footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
      <p class="font-sans text-sm">&copy; 2026 BazarBD. All rights reserved.</p>
      <div class="flex space-x-4 mt-2 md:mt-0">
        <span class="px-2 py-1 bg-success rounded text-white text-xs">Trusted Vendors</span>
        <span class="px-2 py-1 bg-accent rounded text-white text-xs">Secure Payments</span>
        <span class="px-2 py-1 bg-info rounded text-white text-xs">Fast Delivery</span>
      </div>
    </div>
  </footer>
</template>

<script setup>
defineOptions({ name: "AppFooter" });
</script>
