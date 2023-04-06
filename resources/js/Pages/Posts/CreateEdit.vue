<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router, useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Editor from "@/Components/Editor.vue";
import { reactive } from "vue";

const form = useForm({
  title: null,
  content: null,
  meta_data: {},
});

const meta = reactive({
  attribute: null,
  value: null,
  errors: {
    attribute: null,
    value: null,
  },
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <li><a :href="route('home')">Home</a></li>
      <li><Link :href="route('dashboard')">Dashboard</Link></li>
    </template>

    <h1 class="text-3xl underline underline-offset-8 text-center mb-8">
      Create A New Blog Post
    </h1>
    <div class="flex justify-between w-full gap-x-4">
      <div class="w-9/12 content-card">
        <div>
          <InputLabel value="Blog Title" class="text-xl underline underline-offset-8" />
          <TextInput :modalValue="form.title" placeholder="Blog Title"/>
          <InputError :message="form.errors.title" />
        </div>
        <div class="mt-6">
          <InputLabel value="Blog Content" class="text-xl underline underline-offset-8" />
          <Editor v-model="form.content" />
          <InputError :message="form.errors.content" />
        </div>
        <pre>
            {{ form.title }}
            {{ form.content }}
            {{ form.meta }}
        </pre>
      </div>
      <div class="w-3/12">
        <div class="content-card">
          <InputLabel
            value="Meta Tags"
            class="text-xl underline underline-offset-8 mb-8 text-center"
          />
          <TextInput :modalValue="meta.attribute" placeholder="Attribute" />
          <InputError :message="meta.errors.attribute" />
          <TextInput :modalValue="meta.value" placeholder="Value" />
          <InputError :message="meta.errors.value" />
        </div>
        <div class="content-card"></div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>