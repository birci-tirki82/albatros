import {
  mdiAccountCircle,
  mdiMonitor,
  mdiGithub,
  mdiLock,
  mdiAlertCircle,
  mdiTypewriter,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList,
  mdiTelevisionGuide,
  mdiResponsive,
  mdiPalette, mdiBookAlert, mdiPublish, mdiHome, mdiHomeVariantOutline, mdiBorderAll,
} from "@mdi/js";

export default [
  {
    route: "admin",
    icon: mdiHome,
    label: "Anasayfa",
  },
  {

    label: "Kategoriler",
    icon: mdiTable,
    menu: [
      {
        route: "category.index",
        label: "Kategoriler",
      },
      {
        route: "category.create",
        label: "Kategori Ekle",
      },
      // {
      //   route: "journal-category.index",
      //   label: "Dergi Kategorileri",
      // },
      // {
      //   route: "journal-category.create",
      //   label: "Dergi Kategorisi Ekle",
      // },
    ],
  },
  {

    label: "Kitaplar",
    icon: mdiBookAlert,
    menu: [
      {
        route: "book.index",
        label: "Kitap Listesi",
      },
      {
        route: "book.create",
        label: "Kitap Ekle",
      },
    ],
  },
  {
    label: "Dergiler",
    icon: mdiTelevisionGuide,
    menu: [
      {
        route: "journal.index",
        label: "Dergi Listesi",
      },
      {
        route: "journal.create",
        label: "Dergi Ekle",
      },
    ],
  },
  {
    route: "writer.index",
    label: "Yazarlar",
    icon: mdiTypewriter,
  },
  {
    route: "publisher.index",
    label: "Yayın Evleri",
    icon: mdiHomeVariantOutline,
  },
  {
    route: "user.index",
    label: "Kullanıcılar",
    icon: mdiAccountCircle,
  },
  {
    route: "siparisler",
    label: "Siparişler",
    icon: mdiBorderAll,
  },
  // {
  //   route: "dashboard",
  //   label: "Login",
  //   icon: mdiLock,
  // },
  // {
  //   route: "dashboard",
  //   label: "Error",
  //   icon: mdiAlertCircle,
  // },
  // {
  //   label: "Dropdown",
  //   icon: mdiViewList,
  //   menu: [
  //     {
  //       label: "Item One",
  //     },
  //     {
  //       label: "Item Two",
  //     },
  //   ],
  // },
  // {
  //   href: "https://github.com/justboil/admin-one-vue-tailwind",
  //   label: "GitHub",
  //   icon: mdiGithub,
  //   target: "_blank",
  // },
];
