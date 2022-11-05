<script setup>

import FrontendLayout from "@/layouts/FrontendLayout.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {reactive} from "vue";
import BaseButton from "@/components/BaseButton.vue";
import FormField from "@/components/FormField.vue";
import FormControl from "@/components/FormControl.vue";
import FormCheckRadioGroup from "@/components/FormCheckRadioGroup.vue";
import FormValidationErrors from '@/components/FormValidationErrors.vue';

const props = defineProps({
  user: Array,
  totalPrice: Number,
  carts: Array,
  addresses: Array,
  // detail: Array,
  // type: String
})

let address_list = [];
let is_default_index = 0;

props.addresses.forEach((addr, index) => {
  // console.log(addr)
  address_list.push({
    id: addr.id,
    label: addr.city + ' / ' + addr.district + ' / ' + addr.zipcode + ' / ' + addr.phone + ' / ' + addr.address,
  });
  // if (addr.is_default === 1) {
  //   is_default_index = 1;
  // }
});
// console.log(address_list)

// const yeniadres = useForm({
//   user_id: props.user.id,
//   name: "",
//   cardname: "",
//   cardno: "",
//   month: "",
//   year: "",
//   cvc: "",
//   surname: "",
//   country: "",
//   city: "", //il
//   district: "", //ilçe
//   phone: "",
//   email: "",
//   zipcode: "",
//   not: "",
//   address_choice: 'mevcut_adres',
// });


const form = useForm({
  user_id: props.user.id,
  name: "",
  surname: "",
  country: "",
  city: "", //il
  district: "", //ilçe
  phone: "",
  email: "",
  address: address_list[is_default_index],
  new_address: "",
  zipcode: "",
  not: "",
  address_choice: address_list.length > 0 ? 'mevcut_adres' : 'yeni_adres',
  cardname: "",
  cardno: "5890040000000016",
  month: "",
  year: "",
  cvc: "",
  sartkosul: false,
});

// const mevcutadres = useForm({
//   address: address_list[is_default_index],
//   user_id: props.user.id,
//   // odemeForm
//   cardname: odemeForm.cardname,
//   cardno: odemeForm.cardno,
//   month: odemeForm.month,
//   year: odemeForm.year,
//   cvc: odemeForm.cvc,
// });


function submit() {
  if (form.address_choice === 'mevcut_adres') {
    Inertia.post(route('siparisi-tamamla'), {
      address: form.address,
      new_adress: form.new_address,
      user_id: props.user.id,
      cardname: form.cardname,
      cardno: form.cardno,
      month: form.month,
      year: form.year,
      cvc: form.cvc,
      sartkosul: form.sartkosul,
    });
  } else {
    Inertia.post(route('siparisi-tamamla'), form);
  }

}


// function onChange(event) {
//   // console.log(event)
//   form.address_choice = event.target.value;
//
// }

// console.log(props.totalPrice)
function assetsPath() {
  return "../../../assets/images/";
}

function productPath() {
  return "../../../storage/images/products/";
}
const title = 'Ödeme';
const description = 'odeme';

</script>

<template>

  <FrontendLayout>
    <Head>
      <title>{{ title }}</title>
      <meta type="description" :content=description head-key="description">
    </Head>

    <div class="container lg:mx-auto mx-3">
      <!-- breadcrumb -->
      <div class="container py-4 flex items-center gap-3 mx-auto">
        <Link :href="route('/')" class="text-red-500 text-base">
          <i class="fa-solid fa-house"></i>
        </Link>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Ödeme</p>
      </div>
      <!-- ./breadcrumb -->

      <!-- wrapper -->
      <!--      <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16 mx-auto">-->
      <div v-if="carts.length > 0">
        <form @submit.prevent="submit" class="mt-8">
          <FormValidationErrors />
          <div class="container grid grid-cols-12 items-start pb-16 pt-4 gap-6">

            <div class="lg:col-span-8 col-span-12 border border-gray-200 p-4 rounded">
              <h3 class="text-lg font-medium capitalize mb-4 text-red-500 font-semibold border-b">Sipariş Bilgileri</h3>

              <div v-if="address_list.length > 0" class="space-y-4">

                <FormField label="Adres Tercihi" wrap-body class="border-b">
                  <FormCheckRadioGroup
                    v-model="form.address_choice"
                    :value="form.address_choice"
                    type="radio"
                    :options="{  yeni_adres: 'Yeni Adres', mevcut_adres: 'Mevcut Adres' }"
                  />
                </FormField>

                <FormField v-if="form.address_choice === 'mevcut_adres'" label="Adres Seçiniz">
                  <FormControl v-model="form.address" :options="address_list"/>
                </FormField>


                <FormField v-else>
                  <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                      <label for="first-name" class="text-gray-600">İsim <span
                        class="text-red-500">*</span></label>
                      <input type="text" v-model="form.name" id="first-name"
                             class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                    </div>
                    <div>
                      <label for="last-name" class="text-gray-600">Soyisim <span
                        class="text-red-500">*</span></label>
                      <input type="text" v-model="form.surname" id="last-name"
                             class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                    </div>
                  </div>

                  <div class="mt-4">
                    <label for="company" class="text-gray-600">Ülke</label>
                    <input type="text" v-model="form.country" id="company"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="city" class="text-gray-600">İl</label>
                    <input type="text" v-model="form.city" id="city"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="district" class="text-gray-600">İlçe</label>
                    <input type="text" v-model="form.district" id="district"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="address" class="text-gray-600">Adres</label>
                    <input type="text" v-model="form.new_address" id="address"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="phone" class="text-gray-600">Telefon</label>
                    <input type="tel" v-model="form.phone" id="phone"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="zipcode" class="text-gray-600">Zipkod</label>
                    <input type="text" v-model="form.zipcode" id="zipcode"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="not" class="text-gray-600">Sipariş Notu</label>
                    <input type="text" v-model="form.not" id="not"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>
                </FormField>
              </div>

              <div v-else class="space-y-4">

                <FormField>

<!--                  <FormCheckRadioGroup-->
<!--                    v-model="form.address_choice"-->
<!--                    :value="yeni_adres"-->
<!--                    type="radio"-->
<!--                    :options="{  yeni_adres: 'Yeni Adres', mevcut_adres: 'Mevcut Adres' }"-->
<!--                  />-->

                  <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                      <label for="firstname" class="text-gray-600">İsim <span
                        class="text-red-500">*</span></label>
                      <input type="text" v-model="form.name" id="firstname"
                             class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                    </div>
                    <div>
                      <label for="lastname" class="text-gray-600">Soyisim <span
                        class="text-red-500">*</span></label>
                      <input type="text" v-model="form.surname" id="lastname"
                             class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                    </div>
                  </div>

                  <div class="mt-4">
                    <label for="company2" class="text-gray-600">Ülke</label>
                    <input type="text" v-model="form.country" id="company2"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="city2" class="text-gray-600">İl</label>
                    <input type="text" v-model="form.city" id="city2"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="district2" class="text-gray-600">İlçe</label>
                    <input type="text" v-model="form.district" id="district2"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="address2" class="text-gray-600">Adres</label>
                    <input type="text" v-model="form.new_address" id="address2"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="phone2" class="text-gray-600">Telefon</label>
                    <input type="tel" v-model="form.phone" id="phone2"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="zipcode2" class="text-gray-600">Zipkod</label>
                    <input type="text" v-model="form.zipcode" id="zipcode2"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>

                  <div class="mt-4">
                    <label for="not2" class="text-gray-600">Sipariş Notu</label>
                    <input type="text" v-model="form.not" id="not2"
                           class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
                  </div>
                </FormField>
              </div>

            </div>

            <div class="lg:col-span-4 col-span-12 border border-gray-200 p-4 rounded">
              <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">SİPARİŞ ÖZETİ</h4>

              <div v-for="cart in carts" class="space-y-2">

                <div class="flex justify-between">
                  <div>
                    <h5 class="text-gray-800 text-xs font-medium">{{ cart.product.name }}</h5>
                    <!--              <p class="text-sm text-gray-600">Size: M</p>-->
                  </div>
                  <p class="text-gray-600  text-xs ">
                    {{ cart.count }}
                  </p>
                  <p v-if="cart.product.price !== null" class="text-gray-600  text-xs ">
                    x {{ cart.product.price }}
                  </p>
                  <p v-else class="text-gray-600  text-xs ">
                    x {{ cart.product.old_price }}
                  </p>

                  <p v-if="cart.product.price !== null" class="text-gray-800  text-xs  font-medium">₺{{
                      cart.sum_prod
                    }}</p>
                  <p v-else class="text-gray-800  text-xs  font-medium">₺{{ cart.sum_prod }}</p>
                </div>

              </div>

              <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
                <p>Ürün Toplam:</p>
                <p>₺{{ props.totalPrice }}</p>
              </div>

              <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
                <p>Kargo:</p>
                <p class="text-green-500">Bedava</p>
              </div>

              <div class="flex justify-between text-gray-800 font-medium py-3 uppercas">
                <p class="font-semibold">Toplam</p>
                <p> ₺{{ props.totalPrice }}</p>
              </div>

              <div class="flex items-center mb-4 mt-2">
                <input type="checkbox" name="aggrement" id="aggrement"
                       v-model="form.sartkosul"
                       class="text-red-500 focus:ring-0 rounded-sm cursor-pointer w-3 h-3">
                <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer text-sm">
                  <Link :href="route('sartlar-kosullar')" class="text-red-500">Şartlar & koşulları</Link>
                  kabul ediyorum.
                </label>
              </div>


              <div v-if="$page.props.flash.message" class="alert">
                {{ $page.props.flash.message }}
              </div>

              <div class="mt-4">
                <label for="name" class="text-gray-600 ">Kart Üzerindeki İsim</label>
                <input type="text" v-model="form.cardname" id="name" required
                       class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
              </div>


              <div class="mt-4">
                <label for="cartNumber" class="text-gray-600 ">Kart Numarası</label>
                <input type="text" v-model="form.cardno" id="cartNumber" required
                       class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
              </div>

              <div class="mt-4 grid grid-cols-2 gap-2 ">
                <div class="inline-block">
                  <label for="mounth" class="text-gray-600 ">Ay</label>
                  <input type="text" v-model="form.month" id="mounth" required
                         class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400 inline-block">
                </div>
                <div class="inline-block">
                  <label for="year" class="text-gray-600">Yıl</label>
                  <input type="text" v-model="form.year" id="year" required
                         class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400 inline-block">
                </div>

              </div>


              <div class="mt-4 w-1/2">
                <label for="cvc" class="text-gray-600 ">cvc</label>
                <input type="text" v-model="form.cvc" id="cvc" required
                       class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-red-500 placeholder-gray-400">
              </div>


              <button type="submit"
                      class="mt-4 block w-full py-3 px-4 text-center text-white bg-red-500 border border-red-500 rounded-md hover:bg-transparent hover:text-red-500 transition font-medium">
                Ödemeyi Tamamla
              </button>

            </div>


          </div>
        </form>
      </div>

      <div v-else class="contain py-16">
        <div class="text-center max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">

          <!--        <span class="text-6xl text-red-500">Sepetiniz Boş</span>-->
          <p class="mt-12 text-2xl md:text-3xl font-light leading-normal"
          >Üzgünüz, sepetinizde ürün yok... </p>
          <p class="mt-4 mb-8">Alışverişe devam edin..</p>

          <Link :href="route('/')" type="submit"
                class="mt-4 block w-full py-2 text-center text-white bg-red-500 border border-red-500 rounded hover:bg-transparent hover:text-red-500 transition uppercase font-roboto font-medium">
            Anasayfa
          </Link>
        </div>
      </div>
    </div>
    <!-- ./wrapper -->
    <!--    </div>-->

  </FrontendLayout>


</template>
