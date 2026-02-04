<template>
  <div class="min-h-screen bg-gray-50">

    <section class="flex justify-center px-4 pt-10 pb-16">
      <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-heading font-bold text-primary text-center mb-6">
          Create Account
        </h2>

        <!-- ERROR MESSAGE -->
        <div v-if="errorMessage" class="mb-4 text-sm text-red-600 bg-red-50 p-3 rounded">
          {{ errorMessage }}
        </div>

        <form @submit.prevent="handleRegister" class="space-y-4">

          <!-- Name -->
          <div>
            <label class="label">Name</label>
            <input v-model="form.name" type="text" class="input" />
          </div>

          <!-- Email -->
          <div>
            <label class="label">Email</label>
            <input v-model="form.email" type="email" class="input" />
          </div>

          <!-- Password -->
          <div>
            <label class="label">Password</label>

            <div class="relative">
              <input :type="showPassword ? 'text' : 'password'" v-model="form.password" class="input pr-10" />

              <!-- Show / Hide -->
              <button type="button" @click="showPassword = !showPassword"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                {{ showPassword ? 'Hide' : 'Show' }}
              </button>
            </div>

            <!-- Password Strength -->
            <div class="mt-2 text-sm">
              <span :class="strengthColor">{{ passwordStrength }}</span>
            </div>
          </div>

          <!-- Confirm Password -->
          <div>
            <label class="label">Confirm Password</label>
            <input :type="showPassword ? 'text' : 'password'" v-model="form.password_confirmation" class="input" />
          </div>

          <!-- Submit -->
          <button type="submit"
            class="w-full flex justify-center items-center gap-2 bg-primary text-white py-3 rounded-md font-semibold hover:bg-emerald-700 transition disabled:opacity-60"
            :disabled="loading">
            <span v-if="loading"
              class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></span>
            <span>{{ loading ? 'Registering...' : 'Register' }}</span>
          </button>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
          Already have an account?
          <router-link to="/login" class="text-primary font-medium">
            Login
          </router-link>
        </p>
      </div>
    </section>


  </div>
</template>

<script setup>
import { reactive, ref, computed } from "vue";
import api from "@/services/api";


// form state
const form = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const loading = ref(false);
const errorMessage = ref("");
const showPassword = ref(false);

/* ------------------------
   Password Strength
------------------------- */
const passwordStrength = computed(() => {
  if (form.password.length === 0) return "";
  if (form.password.length < 6) return "Weak password";
  if (form.password.length < 10) return "Medium strength";
  return "Strong password";
});

const strengthColor = computed(() => {
  if (passwordStrength.value.includes("Weak")) return "text-red-500";
  if (passwordStrength.value.includes("Medium")) return "text-yellow-500";
  return "text-green-600";
});

/* ------------------------
   Submit Handler
------------------------- */
const handleRegister = async () => {
  errorMessage.value = "";
  loading.value = true;

  try {
    const response = await api.post("/register", {
      name: form.name,
      email: form.email,
      password: form.password,
      password_confirmation: form.password_confirmation,
      platform: "web",
    });

    // save token & user
    localStorage.setItem("token", response.data.data.token);
    localStorage.setItem("user", JSON.stringify(response.data.data.user));

    // redirect to home
    window.location.href = "/";
  } catch (error) {
    if (error.response?.status === 422) {
      errorMessage.value =
        Object.values(error.response.data.errors)[0][0];
    } else {
      errorMessage.value = "Registration failed. Please try again.";
    }
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
.label {
  display: block;
  font-size: 0.875rem;
  font-weight: 500;
  color: #374151;
  margin-bottom: 0.25rem;
}

.input {
  width: 100%;
  border-radius: 0.375rem;
  border: 1px solid #d1d5db;
}
.input:focus {
  border-color: #059669;
  outline: none;
  box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.25);
}
</style>
