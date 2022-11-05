<script setup>
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, usePage} from "@inertiajs/inertia-vue3";
import {computed, reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import FormValidationErrors from '@/components/FormValidationErrors.vue'


const User = computed(() => usePage().props.value.auth.user)
let user = User.value;

const form = reactive({
  name: "",
  surname: "",
  email: "",
  password: "",
  password_confirmation: "",
  is_active: 1,
});

function submit() {
  Inertia.post(route('register'), form)
}

</script>

<template>

  <FrontendLayout >
    <!-- login -->
    <div class="contain py-16">
      <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
        <h2 class="text-2xl font-medium mb-4 text-center">Hesap Oluştur</h2>



        <form @submit.prevent="submit" class="mt-8">

          <FormValidationErrors />
          <div class="space-y-2">
            <div>
              <label for="name" class="text-gray-600 mb-2 block">Ad</label>
              <input type="text" v-model="form.name" id="name"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="Adınızı giriniz..">
            </div>
            <div>
              <label for="lastname" class="text-gray-600 mb-2 block">Soyad</label>
              <input type="text" v-model="form.surname" id="lastname"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="Soyadınızı giriniz..">
            </div>
            <div>
              <label for="email" class="text-gray-600 mb-2 block">Email Adres</label>
              <input type="email" v-model="form.email" id="email"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="E-mail adresinizi giriniz..">
            </div>
            <div>
              <label for="password" class="text-gray-600 mb-2 block">Şifre</label>
              <input type="password" v-model="form.password" id="password"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="*******">
            </div>
            <div>
              <label for="password2" class="text-gray-600 mb-2 block">Şifre Tekarı</label>
              <input type="password" v-model="form.password_confirmation" id="password2"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="*******">
            </div>
            <div>
              <input type="hidden" v-model="form.is_active"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                     placeholder="*******">
            </div>
<!--            <div>-->
<!--              <label for="confirm" class="text-gray-600 mb-2 block">Confirm password</label>-->
<!--              <input type="password" name="confirm" id="confirm"-->
<!--                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"-->
<!--                     placeholder="*******">-->
<!--            </div>-->
          </div>

<!--          <div class="mt-6">-->
<!--            <div class="flex items-center">-->
<!--              <input type="checkbox" name="aggrement" id="aggrement"-->
<!--                     class="text-red-500 focus:ring-0 rounded-sm cursor-pointer">-->
<!--              <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer"> <a-->
<!--                href="#" class="text-red-500">Şartlar & koşulları</a> okudum ve kabul ediyorum</label>-->
<!--            </div>-->
<!--          </div>-->

          <div class="mt-4">
            <button type="submit" class="block w-full py-2 text-center text-white bg-red-500 border border-red-500 rounded hover:bg-transparent hover:text-red-500 transition uppercase font-roboto font-medium">
              Hesabı Oluştur
            </button>
          </div>
        </form>


        <p class="mt-4 text-center text-gray-600">Zaten hesabınız var mı? <Link :href="route('user-login')" class="text-red-500">Şimdi Giriş Yap</Link></p>
      </div>
    </div>
    <!-- ./login -->
  </FrontendLayout>

</template>
