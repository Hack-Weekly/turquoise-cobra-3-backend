<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router } from '@inertiajs/vue3';
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import Editor from "@/Components/Editor.vue";

const test = function()
{
    router.delete(route("course-info-sections.destroy", 4),{});
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <li><a :href="route('home')">Home</a></li>
      <li><Link :href="route('dashboard')">Dashboard</Link></li>
    </template>
    <div>
      <div class="content-card">We are here!</div>
    </div>
  </AuthenticatedLayout>
</template>
