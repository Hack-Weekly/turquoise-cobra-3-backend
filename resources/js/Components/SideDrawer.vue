<template>
  <div class="drawer">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
      <slot />
    </div>
    <div class="drawer-side">
      <label for="my-drawer" class="drawer-overlay"></label>
      <ul class="menu px-4 pb-4 w-80 bg-base-100 text-base-content child:mb-2">
        <!-- Sidebar content here -->
        <li class="h-16 hover:!bg-base-100 mb-8">
          <label
            for="my-drawer"
            class="text-3xl hover:bg-base-100 cursor-pointer flex justify-end items-center"
          >
            <i-mdi-hamburger-menu-back
              class="hover:scale-110 transition-all duration-300"
            />
          </label>
        </li>
        <DrawerLink displayName="Dashboard" routeName="dashboard" />
        <NestedDrawerLink :routes="{'All Blogs':'posts.index', 'Add Blog' : 'posts.create'}" title="Blogs"/>
        <DrawerLink displayName="Tag Management" routeName="tags.index" />

        <!-- Settings -->
        <!-- <NestedDrawerLink :routes="{'Tags':'tags.index','Course Info Sections':'course-info-sections.index'}" title="Settings"/> -->


        <!-- <DrawerLink routeName="settings"/> -->
      </ul>
    </div>
  </div>
</template>
<script setup>
import DrawerLink from "@/Components/DrawerLink.vue";
import NestedDrawerLink from "@/Components/NestedDrawerLink.vue";

</script>
