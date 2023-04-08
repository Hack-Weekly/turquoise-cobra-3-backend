<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useToast } from "vue-toastification";
import { ref } from "vue";
import UserAvatar from "@/Components/UserAvatar.vue";
const toast = useToast();

const user = usePage().props.auth.user;
const avatar = ref(user.avatar ?? null);

console.log(avatar.value);
const form = useForm({
  image: null,
});

const uploadImage = async function () {
  const response = await axios.post(route("profile.saveAvatar", user.id), form, {
    headers: {
      "Content-Type": "multipart/form-data",
    },
  });
  console.log(response.data.url);
  if (response.data.url) {
    form.image = null;
    avatar.value = response.data.url;
    toast.success("Avatar Updated Successfully");
  } else {
    toast.error(response.data.error);
    console.log(response.data.error);
  }
};
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium">Profile Avatar</h2>

      <p class="mt-1 text-sm">Update your account's Avatar Image.</p>
    </header>

    <div class="w-full flex justify-center">
      <div v-if="avatar === null">
        <i-radix-icons-avatar class="text-[100px]" />
      </div>
      <div v-else>
        <UserAvatar :src="avatar" size="200"/>
      </div>
    </div>
    <form @submit.prevent="uploadImage" class="mt-6 space-y-6">
      <div class="">
        <InputLabel value="New Avatar" />
        <input
          id="new_avatar"
          type="file"
          class="file-input file-input-bordered file-input-primary w-full focus:outline-none focus:border-2"
          @input="form.image = $event.target.files[0]"
        />
      </div>
      <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
    </form>
  </section>
</template>
