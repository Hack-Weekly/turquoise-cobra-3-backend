<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import Tag from "@/Components/Tag.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useToast } from "vue-toastification";
import SelectInputGroup from "@/Components/SelectInputGroup.vue";

const props = defineProps({
  tags: {
    required: true,
    type:String
  },
  type:{
    required:true,
    type:String
  }
});

const ucWords = (sentence) => {
  const words=sentence.split(" ");
  for (let i = 0; i < words.length; i++) {
    words[i] = words[i][0].toUpperCase() + words[i].substr(1);
  }
  return words.join(" ");
}
const typeDisplay=ucWords(props.type);

// - Add Tag Form
const toast = useToast();
const form = useForm({
  tag: "",
  type:props.type
});



const submit = function () {
  form.post(route("tags.store"), {
    onError: (e) => {
        if (e[0]) toast.error(e[0]);
    },
    onSuccess: () =>
    {
      toast.success("")
      form.reset("tag")
    },
  });
};
</script>

<template>
  <Head :title="typeDisplay"></Head>

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <li><a :href="route('home')">Home</a></li>
      <li><Link :href="route('tags.index')">Tags</Link></li>
    </template>
    <div>
      <!-- Current Tags (Edit And Delete) -->
      <div class="content-card">
        <h4 class="title">Current {{typeDisplay}} tags</h4>
        <div class="text-primary-content">
          <Tag v-for="tag in tags" :tag="tag" />
        </div>
      </div>
      <!-- Add New Tags -->
      <div class="content-card">
        <h4 class="title">Add {{ typeDisplay }} Tag</h4>
        <form @submit.prevent="submit" class="mt-6 space-y-6">
          <div>
            <InputLabel for="tag" :value="typeDisplay+' Tag'" />
            <TextInput
              id="tag"
              type="text"
              v-model="form.tag"
              required
              autocomplete="tag"
            />
            <InputError class="mt-2" :message="form.errors.tag" />
            <PrimaryButton :disabled="form.processing" class="mt-4">Add</PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
