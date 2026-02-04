<script setup>
defineOptions({ name: "AppNavbar" });
import { ref } from "vue";
const menuOpen = ref(false);
const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};
</script>

<template>
  <nav class="bg-primary text-white px-6 py-4 flex justify-between items-center shadow-md sticky top-0 z-50">
    <div class="text-2xl font-heading font-bold">
      <router-link to="/">BazarBD</router-link>
    </div>
    <ul class="hidden md:flex space-x-6 font-sans">
      <li><router-link class="hover:text-accent transition" to="/">Home</router-link></li>
      <li><router-link class="hover:text-accent transition" to="/about">About</router-link></li>
      <li><router-link class="hover:text-accent transition" to="/register">Register</router-link></li>
      <li><router-link class="hover:text-accent transition" to="/login">Login</router-link></li>
    </ul>

    <!-- Mobile hamburger menu -->
    <button class="md:hidden focus:outline-none" @click="toggleMenu">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path v-if="!menuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
        <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </nav>

  <!-- Mobile Menu -->
  <div v-if="menuOpen" class="bg-primary text-white md:hidden flex flex-col space-y-2 px-6 py-4">
    <router-link class="hover:text-accent" to="/">Home</router-link>
    <router-link class="hover:text-accent" to="/about">About</router-link>
    <router-link class="hover:text-accent" to="/register">Register</router-link>
    <router-link class="hover:text-accent" to="/login">Login</router-link>
  </div>
</template>


