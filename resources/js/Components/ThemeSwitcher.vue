<template>
  <div class="dropdown dropdown-end">
    <label tabindex="0" class="m-1">
      <i-gridicons-themes class="text-primary text-lg m-0 ml-4 p-0" />
    </label>
    <ul
      tabindex="0"
      class="dropdown-content menu shadow bg-primary text-primary-content rounded-md h-96 w-[40rem] overflow-auto "
    >
      <li
      v-for="theme in themes"
      :key="theme+'_theme'"
      class="transition-all duration-200 pr-8 " @click="changeTheme(theme)"><a class="capitalize">{{theme}}</a></li>
    </ul>
  </div>
</template>

<script setup>
const changeTheme = function (theme) {
  const body = document.querySelector("html");
  body.dataset.theme = theme;
};
const themes = [
  "light",
  "dark",
  "cupcake",
  "bumblebee",
  "emerald",
  "corporate",
  "synthwave",
  "retro",
  "cyberpunk",
  "valentine",
  "halloween",
  "garden",
  "forest",
  "aqua",
  "lofi",
  "pastel",
  "fantasy",
  "wireframe",
  "black",
  "luxury",
  "dracula",
  "cmyk",
  "autumn",
  "business",
  "acid",
  "lemonade",
  "night",
  "coffee",
  "winter",
];
</script>
