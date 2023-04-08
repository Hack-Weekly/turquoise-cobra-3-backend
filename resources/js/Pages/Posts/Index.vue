<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";

const props = defineProps(["posts"]);
const toast = useToast();

const editBlog = function (id) {
  router.get(route("posts.edit", id));
};

const flipPublishStatus = function (id) {
  router.put(route("posts.flipPublishStatus", id));
};

// - Delete Post
const deleteModalOpen = ref(false);
const postToDelete = ref(null);
const deletePost = function () {
  if (postToDelete.value.is_published) {
    toast.warning("Please Unpublish The Post Before Deleting");
  } else {
    router.delete(route("posts.destroy", postToDelete.value.id), {
      onSuccess: () => {
        toast.success("Post Deleted Successfully");
      },
      onError: (e) => toast.error(e[0]),
    });
  }
  postToDelete.value = null;
  deleteModalOpen.value = false;
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <li><a :href="route('home')">Home</a></li>
      <li><Link :href="route('dashboard')">Dashboard</Link></li>
    </template>
    <div class="content-card">
      <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
          <!-- head -->
          <thead>
            <tr class="w-full">
              <th class="w-1/12">User</th>
              <th class="w-9/12">Title</th>
              <th class="w-1/12">Status</th>
              <th class="w-1/12">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- row 1 -->
            <tr v-for="post in posts" :key="`post-${post.id}`">
              <th>{{ post.user_id }}</th>
              <td>{{ post.title }}</td>
              <td>
                <button
                  @click="flipPublishStatus(post.id)"
                  class="btn btn-sm"
                  :class="[post.is_published ? 'btn-success' : 'btn-error']"
                >
                  {{ post.is_published ? "Published" : "Unpublished" }}
                </button>
              </td>
              <td class="">
                <button
                  class="btn btn-primary btn-xs w-full mb-2"
                  @click="editBlog(post.id)"
                >
                  Edit
                </button>
                <br />
                <button
                  class="btn btn-error btn-xs w-full"
                  @click="
                    postToDelete = post;
                    deleteModalOpen = true;
                  "
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal" :class="{ 'modal-open': deleteModalOpen }">
      <div class="modal-box">
        <h3 class="font-bold text-xl text-base-content text-center mb-8">
          Delete Post?<br />{{ postToDelete?.title }}
        </h3>
        <div class="modal-action">
          <button
            class="btn btn-info"
            @click="
              deleteModalOpen = false;
              postToDelete = null;
            "
          >
            Cancel
          </button>
          <button class="btn btn-error" @click="deletePost(postToDelete)">Delete</button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
