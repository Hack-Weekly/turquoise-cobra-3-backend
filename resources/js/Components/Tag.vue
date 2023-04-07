<!-- Your Java Script Here -->
<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { router } from '@inertiajs/vue3';

const props = defineProps(["tag"]);
const toast = useToast();

// - Edit Tag
const form = useForm({
  tag: props.tag.tag,
});
const editModalOpen = ref(false);
const editTag = function () {
  form.patch(route("tags.update", props.tag.id), {
    onSuccess: () => (editModalOpen.value = false),
    onError: (e) => toast.error(e[0]),
  });
};

// - Delete Tag
const deleteModalOpen = ref(false);
const deleteTag = function () {
  router.delete(route("tags.destroy", props.tag.id), {
    onSuccess: () => (deleteModalOpen.value = false),
    onError: (e) => toast.error(e[0]),
  });
};
</script>

<template>
  <div class="badge badge-primary p-4 text-lg rounded-md mr-2">
    {{ tag.tag }}
    <i-mdi-edit class="text-md ml-3 mr-1 cursor-pointer" @click="editModalOpen = true" />
    <i-mdi-close class="text-md cursor-pointer" @click="deleteModalOpen = true" />
  </div>

  <!-- Edit Modal -->
  <div class="modal" :class="{ 'modal-open': editModalOpen }">
    <div class="modal-box">
      <h3 class="font-bold text-xl text-base-content text-center mb-8">Edit Tag</h3>
      <form @submit.prevent="editTag">
        <div>
          <InputLabel for="tag" value="Tag" />
          <TextInput
            id="tag"
            type="text"
            v-model="form.tag"
            required
            autofocus
            autocomplete="tag"
          />

          <InputError class="mt-2" :message="form.errors.tag" />
        </div>
        <div class="modal-action">
          <button class="btn btn-info" @click="editModalOpen = false">Cancel</button>
          <button class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal" :class="{ 'modal-open': deleteModalOpen }">
    <div class="modal-box">
      <h3 class="font-bold text-xl text-base-content text-center mb-8">
        Delete tag - {{ tag.tag }}?
      </h3>
      <div class="modal-action">
        <button class="btn btn-info" @click="deleteModalOpen = false">Cancel</button>
        <button class="btn btn-error" @click="deleteTag(tag.id)">Delete</button>
      </div>
    </div>
  </div>
</template>

<!-- Your Styles Here -->
<style scoped></style>
