<template>
  <div class="font-sans">
    <Navbar />

    <main class="min-h-screen">
      <router-view />
    </main>

    <Footer />
  </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";
</script>
