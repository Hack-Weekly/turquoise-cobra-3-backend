<template>
  <div class="drawer">
    <input id="my-drawer" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content">
      <slot/>
    </div>
    <div class="drawer-side">
      <label for="my-drawer" class="drawer-overlay"></label>
      <ul class="menu px-4 pb-4 w-80 bg-base-100 text-base-content child:mb-2  h-full">
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
        <DrawerLink displayName="Dashboard" routeName="dashboard"/>
        <DrawerLink displayName="New Blog" routeName="posts.create"/>
        <DrawerLink displayName="All Blogs" routeName="posts.index"/>
        <NestedDrawerLink
          :routes="{'Events':'events.index', 'Locations' : 'locations.index', 'Schemes / Plans':'scheme-plans.index'}"
          title="Manage Tags"/>
      </ul>
    </div>
  </div>
</template>
<script setup>
import DrawerLink from "@/Components/DrawerLink.vue";
import NestedDrawerLink from "@/Components/NestedDrawerLink.vue";
</script>
