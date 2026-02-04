<template>
  <div class="font-sans">


    <!-- Hero Section -->
    <section class="bg-gray-50 py-16 px-6 text-center">
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-heading font-bold text-primary leading-tight">
        Welcome to BazarBD
      </h1>
      <p class="text-lg sm:text-xl md:text-2xl text-gray-600 mt-4 max-w-2xl mx-auto">
        আপনার ডিজিটাল বাজার - সবকিছু এক জায়গায়, সহজে এবং নিরাপদে
      </p>
      <router-link to="/register"
        class="inline-block mt-6 bg-accent text-white font-semibold px-8 py-3 rounded-md shadow hover:bg-secondary transition duration-300">
        Get Started
      </router-link>
    </section>

    <!-- Features Section -->
    <section class="py-16 px-6 max-w-6xl mx-auto grid gap-8 sm:grid-cols-2 md:grid-cols-3">
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-heading text-primary mb-2">Multi-Vendor</h3>
        <p class="text-gray-600 text-sm">বাজারের সকল বিক্রেতা এক জায়গায়</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-heading text-primary mb-2">Secure Payments</h3>
        <p class="text-gray-600 text-sm">নিরাপদ পেমেন্ট গেটওয়ে</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-heading text-primary mb-2">Fast Delivery</h3>
        <p class="text-gray-600 text-sm">দ্রুত ডেলিভারি এবং সঠিক সময়ে পণ্য</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-heading text-primary mb-2">Trusted Vendors</h3>
        <p class="text-gray-600 text-sm">উচ্চ মানের বিক্রেতা যাচাইকৃত</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-heading text-primary mb-2">Mobile Friendly</h3>
        <p class="text-gray-600 text-sm">মোবাইল-প্রথম ডিজাইন</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="text-xl font-heading text-primary mb-2">Local Feel</h3>
        <p class="text-gray-600 text-sm">বাংলাদেশি বাজারের স্থানীয় অভিজ্ঞতা</p>
      </div>
    </section>

  </div>
</template>


