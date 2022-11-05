import {
  mdiMenu,
  mdiClockOutline,
  mdiCloud,
  mdiCrop,
  mdiAccount,
  mdiCogOutline,
  mdiEmail,
  mdiLogout,
  mdiThemeLightDark,
  mdiGithub,
} from "@mdi/js";

export default [
  // {
  //   icon: mdiMenu,
  //   label: "  Sample menu",
  //   menu: [
  //     {
  //       icon: mdiClockOutline,
  //       label: "Item One",
  //     },
  //     {
  //       icon: mdiCloud,
  //       label: "Item Two",
  //     },
  //     {
  //       isDivider: true,
  //     },
  //     {
  //       icon: mdiCrop,
  //       label: "Item Last",
  //     },
  //   ],
  // },
  {
    isCurrentUser: true,
    menu: [
      {
        icon: mdiAccount,
        label: "Profilim",
        to: "/profile",
      },
      {
        icon: mdiCogOutline,
        label: "Şifre Değiştir",
        route: "sifre-degistir"
      },
      {
        isDivider: true,
      },
      {
        icon: mdiLogout,
        label: "Çıkış",
        isLogout: true,
      },
    ],
  },
  {
    icon: mdiThemeLightDark,
    label: "Light/Dark",
    isDesktopNoLabel: true,
    isToggleLightDark: true,
  },
  // {
  //   icon: mdiGithub,
  //   label: "GitHub",
  //   isDesktopNoLabel: true,
  //   href: "vmbilisim.com",
  // },
  {
    icon: mdiLogout,
    label: "Çıkış",
    isDesktopNoLabel: true,
    isLogout: true,
  },
];
