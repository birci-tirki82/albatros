<script setup>
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm, usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {computed, reactive} from "vue";
import FormValidationErrors from '@/components/FormValidationErrors.vue'

const User = computed(() => usePage().props.value.auth.user)
let user = User.value;

const form = useForm({
  email: '',
  password: '',
  remember: []
})

function submit() {
  Inertia.post(route('login'), form)
}

const title = 'Giriş';
const description = 'giris';

</script>

<template>

  <FrontendLayout >

    <Head>
      <title>{{ title }}</title>
      <meta type="description" :content=description head-key="description">
    </Head>
  <!-- login -->
  <div class="contain py-16">
    <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
      <h2 class="text-2xl font-medium mb-1">Giriş</h2>
      <p class="text-gray-600 mb-6 text-sm">
        Hoşgeldiniz..
      </p>



      <form  @submit.prevent="submit" autocomplete="off" class="mt-8">

        <FormValidationErrors />
        <div class="space-y-2">
          <div>
            <label for="email" class="text-gray-600 mb-2 block">Email Adres</label>
            <input type="email" v-model="form.email" id="email"
                   class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                   placeholder="E-mail adresiniz..">
          </div>
          <div>
            <label for="password" class="text-gray-600 mb-2 block">Şifre</label>
            <input type="password" v-model="form.password" id="password"
                   class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400"
                   placeholder="*******">
          </div>
        </div>
        <div class="flex items-center justify-between mt-6">
          <div class="flex items-center">
            <input type="checkbox" v-model="form.remember" id="remember"
                   class="text-red-500 focus:ring-0 rounded-sm cursor-pointer">
            <label for="remember" class="text-gray-600 ml-3 cursor-pointer">Beni Hatırla</label>
          </div>
          <a href="#" class="text-red-500">Şifremi Unuttum</a>
        </div>
        <div class="mt-4">
          <button type="submit" class="block w-full py-2 text-center text-white bg-red-500 border border-red-500 rounded hover:bg-transparent hover:text-red-500 transition uppercase font-roboto font-medium">
            GİRİŞ
          </button>
        </div>
      </form>

<!--      &lt;!&ndash; login with &ndash;&gt;-->
<!--      <div class="mt-6 flex justify-center relative">-->
<!--        <div class="text-gray-600 uppercase px-3 bg-white z-10 relative">Or login with</div>-->
<!--        <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>-->
<!--      </div>-->
<!--      <div class="mt-4 flex gap-4">-->
<!--        <a href="#"-->
<!--           class="w-1/2 py-2 text-center text-white bg-blue-800 rounded uppercase font-roboto font-medium text-sm hover:bg-blue-700">facebook</a>-->
<!--        <a href="#"-->
<!--           class="w-1/2 py-2 text-center text-white bg-red-600 rounded uppercase font-roboto font-medium text-sm hover:bg-red-500">google</a>-->
<!--      </div>-->
<!--      &lt;!&ndash; ./login with &ndash;&gt;-->

      <p class="mt-4 text-center text-gray-600">Hesabınız yok mu? <Link :href="route('user-register')" class="text-red-500">Şimdi kayıt ol..</Link></p>
    </div>
  </div>
  <!-- ./login -->
  </FrontendLayout>

</template>
