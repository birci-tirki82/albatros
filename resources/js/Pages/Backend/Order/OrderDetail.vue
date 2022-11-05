<script setup>
import LayoutAuthenticated from "@/layouts/LayoutAuthenticated.vue";
import {Head} from '@inertiajs/inertia-vue3';
import {
  mdiMonitorCellphone,
  mdiTableBorder,
  mdiTableOff,
  mdiGithub,
  mdiPlus
} from "@mdi/js";
import SectionMain from "@/components/SectionMain.vue";
import NotificationBar from "@/components/NotificationBar.vue";
import OrderTable from "@/components/OrderTables.vue";
import CardBox from "@/components/CardBox.vue";
import SectionTitleLineWithButton from "@/components/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/CardBoxComponentEmpty.vue";


const props = defineProps({
  order: Array,
  orderDetails: Array,
  user_total_pay: Number,
});



</script>

<template>
  <Head title="Books"/>

  <LayoutAuthenticated>

    <section class="p-6 xl:max-w-7xl xl:mx-auto">
      <section class="mb-6 flex items-center justify-between">
        <div class="flex items-center justify-start"><span
          class="inline-flex justify-center items-center w-12 h-12 rounded-full bg-white text-black dark:bg-slate-900/70 dark:text-white mr-3"><svg
          viewBox="0 0 24 24" width="24" height="24" class="inline-block"><path fill="currentColor"
                                                                                d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"></path></svg></span>
          <h1 class="text-3xl leading-tight">Profil</h1></div>
        <a
          class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded-full border-gray-800 dark:border-white ring-gray-300 dark:ring-gray-400 bg-gray-800 text-white dark:bg-white dark:text-black hover:bg-gray-700 hover:dark:bg-slate-100 text-sm px-3 py-1"
          href="#" disabled="false"><span
          class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24" width="16" height="16"
                                                                       class="inline-block"><path fill="currentColor"
                                                                                                  d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"></path></svg></span><span
          class="px-1">Fatura Oluştur</span></a></section>


      <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
        <div class="rounded-2xl flex-row dark:bg-slate-900/70 bg-white flex items-center">
          <div class="flex-1 p-6">
            <div class="flex justify-start items-start">
              <div class="relative w-24 h-24 md:w-36 md:h-36 mr-6"><img
                src="https://avatars.dicebear.com/api/avataaars/example.svg?options[top][]=shortHair&amp;options[accessoriesChance]=93"
                alt="John Doe" class="rounded-full block h-auto w-full max-w-full bg-gray-100 dark:bg-slate-800">
<!--                <div class="absolute right-0 bottom-0">-->
<!--                  <div class="flex items-stretch justify-start relative"><label class="inline-flex"><a-->
<!--                    class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded-full border-blue-600 dark:border-blue-500 ring-blue-300 dark:ring-blue-700 bg-blue-600 dark:bg-blue-500 text-white hover:bg-blue-700 hover:border-blue-700 hover:dark:bg-blue-600 hover:dark:border-blue-600 p-1 w-12 h-12"-->
<!--                    disabled="false"><span class="inline-flex justify-center items-center w-6 h-6"><svg-->
<!--                    viewBox="0 0 24 24" width="24" height="24" class="inline-block"><path fill="currentColor"-->
<!--                                                                                          d="M4,4H7L9,2H15L17,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4M12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17A5,5 0 0,0 17,12A5,5 0 0,0 12,7M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9Z"></path></svg></span>-->
<!--                    &lt;!&ndash;&ndash;&gt;</a><input type="file"-->
<!--                                      class="absolute top-0 left-0 w-full h-full opacity-0 outline-none cursor-pointer -z-1"></label>-->
<!--                    &lt;!&ndash;&ndash;&gt;</div>-->
<!--                </div>-->
              </div>
              <div class="flex-1">
                <div class="flex justify-between items-center">
                  <div class="flex justify-start items-center mb-3"><h1 class="text-2xl mr-1.5">
                    {{ order.user.name + ' ' + order.user.surname }}</h1><span
                    class="inline-flex justify-center items-center w-6 h-6 text-blue-400"><svg viewBox="0 0 24 24"
                                                                                               width="22" height="22"
                                                                                               class="inline-block"><path
                    fill="currentColor"
                    d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z"></path></svg></span>
                  </div>
                  <button
                    class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded-full border-gray-100 dark:border-slate-800 ring-gray-200 dark:ring-gray-500 bg-gray-100 text-black dark:bg-slate-800 dark:text-white hover:bg-gray-200 hover:dark:bg-slate-700 p-1"
                    type="button"><span class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24"
                                                                                                     width="16"
                                                                                                     height="16"
                                                                                                     class="inline-block"><path
                    fill="currentColor"
                    d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"></path></svg></span>
                    <!----></button>
                </div>
                <div class="flex items-center justify-start flex-wrap -mb-3 text-gray-500">
                  <div class="inline-flex items-center leading-none text-sm mr-3 last:mr-0 mb-3"><span
                    class="inline-flex justify-center items-center w-4 h-4 mr-2"><svg viewBox="0 0 24 24" width="16"
                                                                                      height="16" class="inline-block"><path
                    fill="currentColor"
                    d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z"></path></svg></span><span>
                    {{ order.user.email }}
                  </span>
                  </div>
                  <div class="inline-flex items-center capitalize leading-none text-sm mr-3 last:mr-0 mb-3"><span
                    class="inline-flex justify-center items-center w-4 h-4 mr-2"><svg viewBox="0 0 24 24" width="16"
                                                                                      height="16" class="inline-block"><path
                    fill="currentColor"
                    d="M18,15H16V17H18M18,11H16V13H18M20,19H12V17H14V15H12V13H14V11H12V9H20M10,7H8V5H10M10,11H8V9H10M10,15H8V13H10M10,19H8V17H10M6,7H4V5H6M6,11H4V9H6M6,15H4V13H6M6,19H4V17H6M12,7V3H2V21H22V7H12Z"></path></svg></span><span>
                    {{ order.address.district }}
                  </span>
                  </div>
                  <div class="inline-flex items-center capitalize leading-none text-sm mr-3 last:mr-0 mb-3"><span
                    class="inline-flex justify-center items-center w-4 h-4 mr-2"><svg viewBox="0 0 24 24" width="16"
                                                                                      height="16" class="inline-block"><path
                    fill="currentColor"
                    d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"></path></svg></span><span>{{
                      order.address.city
                    }}</span>
                  </div>
                </div>
                <div class="flex items-center justify-start flex-wrap -mb-3 mt-6">

                  <div class="text-center mr-9 last:mr-0 mb-3">
                    <h2 class="text-m font-medium">
                      <div>{{ orderDetails.length }}</div>
                    </h2>
                    <p class="text-xs ">Sipariş</p>
                  </div>

                  <div class="text-center mr-9 last:mr-0 mb-3">
                    <h2 class="text-m font-medium">
                      <div>₺{{ user_total_pay }}</div>
                    </h2>
                    <p class="text-xs ">Toplam Ödeme</p>
                  </div>

                  <div class="text-center mr-9 last:mr-0 mb-3">
                    <h2 class="text-m font-medium">
                      <div>2 saat önce</div>
                    </h2>
                    <p class="text-xs ">Son Ziyaret</p>
                  </div>

                  <div class="text-center mr-9 last:mr-0 mb-3">
                    <h2 class="text-m font-medium">
                      <div>3</div>
                    </h2>
                    <p class="text-xs ">Yorumlar</p>
                  </div>

                </div>
              </div>
            </div>
          </div><!----></div>
        <div
          class="rounded-2xl py-12 px-6 lg:px-12 text-center bg-gradient-to-tr from-cyan-400 via-violet-400 to-purple-500">
          <h1 class="text-3xl text-white mb-6"> Sipariş Adresi</h1>
          <div class="text-m text-white mb-6"> {{ order.address.name + ' ' + order.address.surname + ' ' + order.address.address + ' ' + order.address.district + ' ' + order.address.city + ' ' + order.address.zipcode + ' ' + order.address.country + ' ' + order.address.phone  }}</div>
          <div class="text-m text-white mb-6"> {{ order.address.created_at }}</div>
          <!--          <div><a-->
          <!--            class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded-full border-white ring-gray-200 dark:ring-gray-500 bg-white text-black hover:bg-gray-100 py-2 px-6"-->
          <!--            href="https://github.com/justboil/admin-one-vue-tailwind" target="_blank" disabled="false"><span-->
          <!--            class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24" width="16" height="16"-->
          <!--                                                                         class="inline-block"><path fill="currentColor"-->
          <!--                                                                                                    d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z"></path></svg></span><span-->
          <!--            class="px-2">GitHub</span></a></div>-->
        </div>
      </div>


      <section class="pt-6 mb-6 flex items-center justify-between">
        <div class="flex items-center justify-start"><span class="inline-flex justify-center items-center w-6 h-6 mr-2"><svg
          viewBox="0 0 24 24" width="20" height="20" class="inline-block"><path fill="currentColor"
                                                                                d="M7 12C9.2 12 11 10.2 11 8S9.2 4 7 4 3 5.8 3 8 4.8 12 7 12M11 20V14.7C9.9 14.3 8.5 14 7 14C3.1 14 0 15.8 0 18V20H11M22 4H15C13.9 4 13 4.9 13 6V18C13 19.1 13.9 20 15 20H22C23.1 20 24 19.1 24 18V6C24 4.9 23.1 4 22 4M18 18H16V6H18V18Z"></path></svg></span>
          <h1 class="text-2xl leading-tight">Sipariş Detayları</h1></div>
        <!--        <button-->
        <!--          class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-white dark:border-slate-900 ring-gray-200 dark:ring-gray-500 bg-white text-black dark:bg-slate-900 dark:text-white hover:bg-gray-100 hover:dark:bg-slate-800 p-1"-->
        <!--          type="button"><span class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24"-->
        <!--                                                                                           width="16" height="16"-->
        <!--                                                                                           class="inline-block"><path-->
        <!--          fill="currentColor"-->
        <!--          d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"></path></svg></span>-->
        <!--          &lt;!&ndash;&ndash;&gt;</button>-->
      </section>
      <div class="rounded-2xl flex-col dark:bg-slate-900/70 bg-white flex mb-6">
        <div class="flex-1 p-6">
          <!--          <div-->
          <!--            class="bg-blue-500 border-blue-500 text-white px-3 py-6 md:py-3 mb-6 last:mb-0 border rounded-lg transition-colors duration-150">-->
          <!--            <div class="justify-between items-center block md:flex">-->
          <!--              <div class="flex items-center justify-center mb-6 md:mb-0">-->
          <!--                <div class="flex flex-col md:flex-row items-center"><span-->
          <!--                  class="inline-flex justify-center items-center w-10 md:w-5 h-10 md:h-5 md:mr-2"><svg-->
          <!--                  viewBox="0 0 24 24" width="24" height="24" class="inline-block"><path fill="currentColor"-->
          <!--                                                                                        d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg></span><span-->
          <!--                  class="text-center md:text-left md:py-2"><b>Payment date</b> is approaching soon. </span></div>-->
          <!--              </div>-->
          <!--              <div class="flex items-center justify-center">-->
          <!--                <button-->
          <!--                  class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded-full border-white ring-gray-200 dark:ring-gray-500 bg-white text-black hover:bg-gray-100 text-sm px-3 py-1"-->
          <!--                  type="button">&lt;!&ndash;&ndash;&gt;<span class="px-2">See details</span></button>-->
          <!--              </div>-->
          <!--            </div>-->
          <!--          </div>-->
          <div class="md:flex md:justify-between md:items-center">
            <div class="md:flex md:items-center">
              <div class="mb-6 text-center md:mr-6 md:mb-0 md:text-left"><p class="text-gray-500">Sipariş No</p>
                <h1 class="text-xl font-semibold">{{ order.order_number }}</h1></div>
            </div>
            <button
              class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-gray-100 dark:border-slate-800 ring-gray-200 dark:ring-gray-500 bg-gray-100 text-black dark:bg-slate-800 dark:text-white hover:bg-gray-200 hover:dark:bg-slate-700 text-sm p-1 mr-3 last:mr-0 mb-3"
              type="button"><!----><span class="px-2">PDF</span></button>
            <div class="text-center md:text-right"><p class="text-gray-500">Toplam Sipariş Tutarı</p>
              <h1 class="text-2xl font-semibold">₺{{ order.total_price }}</h1></div>

          </div>
        </div>
      </div>


      <div v-for="(detail,index) in orderDetails" class="rounded-2xl flex-col dark:bg-slate-900/70 bg-white flex mb-6">
        <div class="flex-1 p-6">
          <div class="md:flex md:justify-between md:items-center">
            <div class="flex items-center justify-center md:justify-start flex-wrap -mb-3">
              <div class="mb-6 text-center md:mr-6 md:mb-0 md:text-left"><p class="text-gray-500">{{ index + 1 }}</p>
              </div>
              <div class="mb-6 text-center md:mr-6 md:mb-0 md:text-left"><p class="text-gray-500">Ürün İsmi</p>
                <h1 class="text-xl font-semibold">{{ detail.product.name }}</h1></div>
            </div>
            <div class="mt-6 md:mt-0 flex justify-between md:justify-end items-center">
<!--              <p v-if="detail.product.price !== null" class="text-gray-500 mr-6">{{ detail.count }} x-->
<!--                {{ detail.product.price }}</p>-->
              <p class="text-gray-500 mr-6">{{ detail.count }} x {{ detail.price }}</p>

              <div
                class="inline-flex items-center capitalize leading-none text-sm border rounded-full py-1.5 px-4 bg-blue-500 border-blue-500 text-white mr-6">
                <span>=</span>
              </div>
              <!--              <h2 v-if="detail.product.price !== null" class="text-2xl font-semibold">₺{{detail.product.price*detail.count}}</h2>-->
              <h2 class="text-2xl font-semibold">₺{{ detail.total_price }}</h2>
            </div>
          </div>
        </div>
      </div>


      <section class="pt-6 mb-6 flex items-center justify-between">
        <div class="flex items-center justify-start"><span class="inline-flex justify-center items-center w-6 h-6 mr-2"><svg
          viewBox="0 0 24 24" width="20" height="20" class="inline-block"><path fill="currentColor"
                                                                                d="M20 4H4A2 2 0 0 0 2 6V18A2 2 0 0 0 4 20H20A2 2 0 0 0 22 18V6A2 2 0 0 0 20 4M20 11H4V8H20Z"></path></svg></span>
          <h1 class="text-2xl leading-tight">Ödeme Yöntemi</h1></div>
        <!--        <button-->
        <!--          class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-blue-600 dark:border-blue-500 ring-blue-300 dark:ring-blue-700 bg-blue-600 dark:bg-blue-500 text-white hover:bg-blue-700 hover:border-blue-700 hover:dark:bg-blue-600 hover:dark:border-blue-600 text-sm p-1"-->
        <!--          type="button"><span class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24"-->
        <!--                                                                                           width="16" height="16"-->
        <!--                                                                                           class="inline-block"><path-->
        <!--          fill="currentColor"-->
        <!--          d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg></span><span-->
        <!--          class="px-1">Add card</span></button>-->
      </section>
      <div class="rounded-2xl flex-col dark:bg-slate-900/70 bg-white flex mb-6">
        <div class="flex-1 p-6">
          <div class="md:flex md:justify-between md:items-center">
            <div class="flex justify-start items-center mb-6 md:mb-0">
              <div class="flex items-center justify-center h-12 w-20 bg-gray-100 dark:bg-gray-800 rounded-lg mr-6"><img
                src="/assets/mc-light-bg.25bebdb1.svg" class="dark:grayscale h-8 md:h-10"></div>
              <div class="mr-6"><h2 class="text-xl font-semibold">MasterCard 4575</h2>
                <p class="text-gray-500 text-sm ">04/24 {{ order.user.name + ' ' + order.user.surname }}</p></div>
              <div
                class="inline-flex items-center capitalize leading-none text-xs border rounded-full py-1 px-3 bg-blue-500 border-blue-500 text-white">
                <span class="inline-flex justify-center items-center w-4 h-4 mr-1"><svg viewBox="0 0 24 24" width="14"
                                                                                        height="14"
                                                                                        class="inline-block"><path
                  fill="currentColor"
                  d="M20 4H4C2.9 4 2 4.89 2 6V18C2 19.11 2.9 20 4 20H13.09C13.03 19.67 13 19.34 13 19C13 15.69 15.69 13 19 13C20.06 13 21.09 13.28 22 13.81V6C22 4.89 21.11 4 20 4M20 11H4V8H20M17.75 22L15 19L16.16 17.84L17.75 19.43L21.34 15.84L22.5 17.25L17.75 22"></path></svg></span><span>Primary</span>
              </div>
            </div>
            <div class="flex items-center justify-end md:justify-start flex-wrap -mb-3">
              <button
                class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-gray-100 dark:border-slate-800 ring-gray-200 dark:ring-gray-500 bg-gray-100 text-black dark:bg-slate-800 dark:text-white hover:bg-gray-200 hover:dark:bg-slate-700 p-1 mr-3 last:mr-0 mb-3"
                type="button"><span class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24"
                                                                                                 width="16" height="16"
                                                                                                 class="inline-block"><path
                fill="currentColor"
                d="M20.6 11.3C20.7 11.2 20.8 11.1 21 11.1C21.1 11.1 21.3 11.2 21.4 11.3L22.6 12.5C22.8 12.7 22.8 13.1 22.6 13.3L21.6 14.3L19.6 12.3L20.6 11.3M13 18.9L19 12.8L21.1 14.9L15.1 21H13V18.9M11 19.1V18.1L11.6 17.5L18.1 11H4V8H20V9.1L22 7.1V6C22 4.9 21.1 4 20 4H4C3.5 4 3 4.2 2.6 4.6C2.2 5 2 5.5 2 6V18C2 18.5 2.2 19 2.6 19.4C3 19.8 3.5 20 4 20H11V19.1Z"></path></svg></span>
                <!----></button>
              <button
                class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-gray-100 dark:border-slate-800 ring-gray-200 dark:ring-gray-500 bg-gray-100 text-black dark:bg-slate-800 dark:text-white hover:bg-gray-200 hover:dark:bg-slate-700 p-1 mr-3 last:mr-0 mb-3"
                type="button"><span class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24"
                                                                                                 width="16" height="16"
                                                                                                 class="inline-block"><path
                fill="currentColor"
                d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M9,8H11V17H9V8M13,8H15V17H13V8Z"></path></svg></span>
              </button>
            </div>
          </div>
        </div>
      </div>


      <section class="pt-6 mb-6 flex items-center justify-between">
        <div class="flex items-center justify-start"><span class="inline-flex justify-center items-center w-6 h-6 mr-2"><svg
          viewBox="0 0 24 24" width="20" height="20" class="inline-block"><path fill="currentColor"
                                                                                d="M22 17C22.5 17 23 17.5 23 18V22C23 22.5 22.5 23 22 23H17C16.5 23 16 22.5 16 22V18C16 17.5 16.5 17 17 17V15.5C17 14.1 18.1 13 19.5 13C20.9 13 22 14.1 22 15.5V17M21 17V15.5C21 14.7 20.3 14 19.5 14C18.7 14 18 14.7 18 15.5V17H21M19.36 9.03C21.95 9.22 24 11.36 24 14L23.94 14.77C23.59 12.63 21.74 11 19.5 11C17 11 15 13 15 15.5L15 15.76C14.39 16.31 14 17.11 14 18V19H6C2.69 19 0 16.31 0 13C0 9.9 2.34 7.36 5.35 7.04C6.6 4.64 9.11 3 12 3C15.64 3 18.67 5.59 19.36 9.03Z"></path></svg></span>
          <h1 class="text-2xl leading-tight">Kargo Bilgileri</h1></div>
        <!--        <button-->
        <!--          class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-white dark:border-slate-900 ring-gray-200 dark:ring-gray-500 bg-white text-black dark:bg-slate-900 dark:text-white hover:bg-gray-100 hover:dark:bg-slate-800 p-1"-->
        <!--          type="button"><span class="inline-flex justify-center items-center w-6 h-6"><svg viewBox="0 0 24 24"-->
        <!--                                                                                           width="16" height="16"-->
        <!--                                                                                           class="inline-block"><path-->
        <!--          fill="currentColor"-->
        <!--          d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"></path></svg></span>-->
        <!--          &lt;!&ndash;&ndash;&gt;</button>-->
      </section>
      <!--      <div class="rounded-2xl flex-col dark:bg-slate-900/70 bg-white flex mb-6">-->
      <!--        <div class="flex-1 p-6">-->
      <!--          <div class="flex items-center justify-between"><p> Last login <b>Sat, Oct 1, 2022</b> from IP <b>192.168.100.99</b>-->
      <!--          </p>-->
      <!--            <button-->
      <!--              class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-gray-100 dark:border-slate-800 ring-gray-200 dark:ring-gray-500 bg-gray-100 text-black dark:bg-slate-800 dark:text-white hover:bg-gray-200 hover:dark:bg-slate-700 text-sm p-1"-->
      <!--              type="button">&lt;!&ndash;&ndash;&gt;<span class="px-2">Manage sessions</span></button>-->
      <!--          </div>-->
      <!--          <hr class="my-6 -mx-6 dark:border-slate-800 border-t border-gray-100">-->
      <!--          <div class="flex items-center justify-between"><p class="mr-3 leading-none"> API status <b>enabled</b></p>-->
      <!--            <label class="switch"><input type="checkbox" name="api-status" value="true"><span class="check"></span><span-->
      <!--              class="pl-2"></span></label></div>-->
      <!--          <hr class="my-6 -mx-6 dark:border-slate-800 border-t border-gray-100">-->
      <!--          <div class="flex items-center justify-between">-->
      <!--            <div class="flex items-center justify-start"><p class="mr-3 leading-none">2-factor authentication</p>-->
      <!--              <div-->
      <!--                class="inline-flex items-center capitalize leading-none text-xs border rounded-full py-1 px-3 bg-blue-500 border-blue-500 text-white">-->
      <!--                &lt;!&ndash;&ndash;&gt;<span>enabled</span></div>-->
      <!--            </div>-->
      <!--            <label class="switch"><input type="checkbox" name="two-factor" value="true"><span class="check"></span><span-->
      <!--              class="pl-2"></span></label></div>-->
      <!--          <hr class="my-6 -mx-6 dark:border-slate-800 border-t border-gray-100">-->
      <!--          <div class="flex items-center justify-between"><p> Password changed <b>long time ago</b></p>-->
      <!--            <button-->
      <!--              class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-gray-100 dark:border-slate-800 ring-gray-200 dark:ring-gray-500 bg-gray-100 text-black dark:bg-slate-800 dark:text-white hover:bg-gray-200 hover:dark:bg-slate-700 text-sm p-1"-->
      <!--              type="button">&lt;!&ndash;&ndash;&gt;<span class="px-2">Change password</span></button>-->
      <!--          </div>-->
      <!--        </div>-->
      <!--      </div>-->
    </section>


  </LayoutAuthenticated>
</template>
