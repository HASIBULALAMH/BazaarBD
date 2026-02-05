<template>
  <div class="min-h-screen flex justify-center items-start pt-10 bg-gray-50">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">

      <h2 class="text-2xl font-heading font-bold text-primary text-center mb-6">
        Login
      </h2>

      <!-- Error -->
      <div v-if="errorMessage"
        class="mb-4 text-sm text-red-600 bg-red-50 p-3 rounded">
        {{ errorMessage }}
      </div>

      <form @submit.prevent="handleLogin" class="space-y-4">

        <div>
          <label class="label">Email</label>
          <input v-model="form.email" type="email" class="input" />
        </div>

        <div>
          <label class="label">Password</label>
          <div class="relative">
            <input
              :type="showPassword ? 'text' : 'password'"
              v-model="form.password"
              class="input pr-10"
            />
            <button
              type="button"
              @click="showPassword = !showPassword"
              class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">
              {{ showPassword ? 'Hide' : 'Show' }}
            </button>
          </div>
        </div>

        <button
          type="submit"
          class="w-full flex justify-center items-center gap-2 bg-primary text-white py-3 rounded-md font-semibold"
          :disabled="loading">

          <span v-if="loading"
            class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></span>

          <span>{{ loading ? 'Logging in...' : 'Login' }}</span>
        </button>
      </form>

    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import api from "@/services/api";
import { useRouter } from "vue-router";

const router = useRouter();

const form = reactive({
  email: "",
  password: "",
});

const loading = ref(false);
const errorMessage = ref("");
const showPassword = ref(false);

const handleLogin = async () => {
  errorMessage.value = "";
  loading.value = true;

  try {
    const res = await api.post("/login", form);

    // token save
    localStorage.setItem("token", res.data.token);
    localStorage.setItem("user", JSON.stringify(res.data.user));

    // redirect
    router.push("/");
  } catch (error) {
    errorMessage.value =
      error.response?.data?.message || "Invalid credentials";
  } finally {
    loading.value = false;
  }
};
</script>

