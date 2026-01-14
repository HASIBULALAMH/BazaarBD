<template>
  <div class="min-h-screen bg-gray-50">
    <nav class="bg-primary text-white shadow-lg">
      <div class="container mx-auto px-4 py-4">
        <h1 class="text-2xl font-bold">🛒 BazarBD</h1>
      </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
      <RouterView />
    </main>

  </div>
</template>

<script>
  import { RouterView } from 'vue-router';
</script>
