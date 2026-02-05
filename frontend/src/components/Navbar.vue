<script setup>
defineOptions({ name: "AppNavbar" });

import { ref, computed } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const menuOpen = ref(false);

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};

const closeMenu = () => {
  menuOpen.value = false;
};

/* -------------------------
   Auth State
-------------------------- */
const isLoggedIn = computed(() => {
  return !!localStorage.getItem("token");
});

const logout = () => {
  localStorage.removeItem("token");
  localStorage.removeItem("user");
  closeMenu();
  router.push("/login");
};
</script>

<template>
  <nav
    class="bg-primary text-white px-6 py-4 flex justify-between items-center shadow-md sticky top-0 z-50"
  >
    <!-- Logo -->
    <div class="text-2xl font-heading font-bold">
      <router-link to="/" @click="closeMenu">BazarBD</router-link>
    </div>

    <!-- Desktop Menu -->
    <ul class="hidden md:flex space-x-6 font-sans items-center">
      <li>
        <router-link
          to="/"
          class="hover:text-accent transition"
          active-class="text-accent font-semibold"
        >
          Home
        </router-link>
      </li>

      <li>
        <router-link
          to="/about"
          class="hover:text-accent transition"
          active-class="text-accent font-semibold"
        >
          About
        </router-link>
      </li>

      <li v-if="!isLoggedIn">
        <router-link
          to="/register"
          class="hover:text-accent transition"
        >
          Register
        </router-link>
      </li>

      <li v-if="!isLoggedIn">
        <router-link
          to="/login"
          class="hover:text-accent transition"
        >
          Login
        </router-link>
      </li>

      <li v-else>
        <button
          @click="logout"
          class="hover:text-accent transition font-medium"
        >
          Logout
        </button>
      </li>
    </ul>

    <!-- Mobile Hamburger -->
    <button class="md:hidden focus:outline-none" @click="toggleMenu">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path
          v-if="!menuOpen"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"
        />
        <path
          v-else
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M6 18L18 6M6 6l12 12"
        />
      </svg>
    </button>
  </nav>

  <!-- Mobile Menu -->
  <div
    v-if="menuOpen"
    class="bg-primary text-white md:hidden flex flex-col space-y-3 px-6 py-4"
  >
    <router-link to="/" @click="closeMenu" class="hover:text-accent">
      Home
    </router-link>

    <router-link to="/about" @click="closeMenu" class="hover:text-accent">
      About
    </router-link>

    <router-link
      v-if="!isLoggedIn"
      to="/register"
      @click="closeMenu"
      class="hover:text-accent"
    >
      Register
    </router-link>

    <router-link
      v-if="!isLoggedIn"
      to="/login"
      @click="closeMenu"
      class="hover:text-accent"
    >
      Login
    </router-link>

    <button
      v-else
      @click="logout"
      class="text-left hover:text-accent font-medium"
    >
      Logout
    </button>
  </div>
</template>
