<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router, useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Editor from "@/Components/Editor.vue";
import { reactive, computed } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps(["tags", "post", "mode"]);
// console.log(props.post);
const form = useForm({
  mode: props.mode,
  title: null,
  hero: null,
  content: null,
  meta_data: [],
  tags: [],
  is_published: null,
});
if (props.mode == "edit") {
  form.title = props.post.title;
  form.content = props.post.content;
  form.meta_data = JSON.parse(props.post.meta_data);
  form.is_published = props.post.is_published;
  console.log(props.post);
  props.post.tags.forEach((tag) => {
    form.tags.push(tag.id);
  });
  console.log(form.tags);
}

const heroURL = computed(() => {
  if (form.hero != null) {
    return URL.createObjectURL(form.hero);
  }
  return null;
});

const savePost = function () {
  form.post(route("posts.store"), {
    onError: (e) => {
      if (e[0]) toast.error(e[0]);
    },
    onSuccess: () => {
      toast.success("Blog Saved Successfully");
      form.reset();
    },
  });
};

const updatePost = function () {
  form.put(route("posts.update", props.post.id), {
    onError: (e) => {
      if (e[0]) toast.error(e[0]);
    },
    onSuccess: () => {
      toast.success("Blog Saved Successfully");
      form.reset();
    },
  });
};

// Meta Data
const meta = reactive({
  attribute: null,
  value: null,
  errors: {
    attribute: null,
    value: null,
  },
});

const addMetaData = function () {
  if (meta.attribute == null || meta.attribute == "") {
    meta.errors.attribute = "Please Enter An Attribute";
    return;
  }
  if (meta.value == null || meta.value == "") {
    meta.errors.value = "Please Enter A Value";
    return;
  }
  const exists = form.meta_data.find((data) => data.attribute == meta.attribute);
  if (!exists?.value) {
    form.meta_data.push({ attribute: meta.attribute, value: meta.attribute });
    return;
  }
  toast.error("Meta Data Already Exists For This Blog");
};

// Content Tag
const tag = reactive({
  id: null,
  error: null,
});

const addTag = function () {
  if (tag.id == null || tag.id == "") {
    tag.error = "Please Input A Tag";
    return;
  }
  const exists = form.tags.find((t) => t == tag.id);
  console.log(exists);
  if (!exists) {
    form.tags.push(tag.id);
    tag.id = null;
    tag.error = null;
    return;
  }
  toast.error("Tag Already Exists For This Blog");
};
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
          <TextInput v-model="form.title" placeholder="Blog Title" />
          <InputError :message="form.errors.title" />
        </div>
        <div class="mt-6">
          <InputLabel
            value="Blog Banner / Hero Image"
            class="text-xl underline underline-offset-8"
          />
          <input
            id="new_avatar"
            type="file"
            class="file-input file-input-bordered file-input-primary w-full focus:outline-none focus:border-2"
            @input="form.hero = $event.target.files[0]"
          />
          <InputError :message="form.errors.hero" />
          <img v-if="heroURL" :src="heroURL" class="my-6" />
        </div>
        <div class="mt-6">
          <InputLabel value="Blog Content" class="text-xl underline underline-offset-8" />
          <Editor v-model="form.content" />
          <InputError :message="form.errors.content" />
        </div>
      </div>
      <div class="w-3/12">
        <div class="content-card">
          <InputLabel value="Meta Data" class="text-xl underline underline-offset-8" />
          <TextInput v-model="meta.attribute" placeholder="Attribute" />
          <InputError :message="meta.errors.attribute" />
          <TextInput v-model="meta.value" placeholder="Value" class="mt-4" />
          <InputError :message="meta.errors.value" />
          <button class="btn btn-primary w-full mt-4 btn-sm" @click="addMetaData">
            Add Meta Data
          </button>
          <!-- <hr class="border-primary mt-4 mb-2 p-0"/> -->
          <InputLabel
            value="Existing Meta Tags"
            class="text-xl underline underline-offset-8 mt-4 mb-6"
          />
          <ol>
            <li v-for="(data, index) in form.meta_data" :key="`tag${index}`">
              <div class="pl-2 mb-3">
                <p>Attribute : {{ data.attribute }}</p>
                <p>Value : {{ data.value }}</p>
              </div>
            </li>
          </ol>
          <InputError :message="form.errors.meta_data" />
        </div>
        <div class="content-card">
          <InputLabel value="Topic Tags" class="text-xl underline underline-offset-8" />
          <select v-model="tag.id" class="select select-primary w-full">
            <option value="" selected disabled hidden>Select</option>
            <option v-for="tag in tags" :key="`tag-option${tag.id}`" :value="tag.id">
              {{ tag.tag }}
            </option>
          </select>
          <InputError :message="tag.error" />
          <button class="btn btn-primary w-full mt-4 btn-sm" @click="addTag">
            Add Tag
          </button>
          <!-- <hr class="border-primary mt-4 mb-2 p-0"/> -->
          <InputLabel
            value="Existing Topic Tags"
            class="text-xl underline underline-offset-8 mt-4 mb-6"
          />
          <ol>
            <li v-for="(tag, index) in form.tags" :key="`tag${index}`" class="pl-2 mb-2">
              {{ tags.find((t) => t.id == tag).tag }}
            </li>
          </ol>
          <InputError :message="form.errors.tags" />
        </div>
      </div>
    </div>
    <button v-if="mode == 'create'" class="btn btn-primary w-full" @click="savePost">
      Save Post
    </button>
    <button v-else class="btn btn-primary w-full" @click="updatePost">Update Post</button>
  </AuthenticatedLayout>
</template>
