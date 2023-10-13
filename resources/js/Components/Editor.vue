<template>
  <div class="h-auto p-0" v-if="editor">
    <div class="">
      <div
        class="menu-row text-left bg-primary text-primary-content rounded-t-md flex flex-row text-xl"
      >
        <!-- Bold -->
        <button
          @click="editor.chain().focus().toggleBold().run()"
          :disabled="!editor.can().chain().focus().toggleBold().run()"
          :class="{ 'is-active': editor.isActive('bold') }"
          class="menu-btn"
        >
          <i-fluent-text-bold-20-regular />
        </button>
        <!-- Italics -->
        <button
          @click="editor.chain().focus().toggleItalic().run()"
          :disabled="!editor.can().chain().focus().toggleItalic().run()"
          :class="{ 'is-active': editor.isActive('italic') }"
          class="menu-btn"
        >
          <i-fluent-text-italic-20-regular />
        </button>
        <!-- Strikethrough -->
        <button
          @click="editor.chain().focus().toggleStrike().run()"
          :disabled="!editor.can().chain().focus().toggleStrike().run()"
          :class="{ 'is-active': editor.isActive('strike') }"
          class="menu-btn"
        >
          <i-fluent-text-strikethrough-20-regular />
        </button>
        <!-- Clear Formatting -->
        <button @click="editor.chain().focus().unsetAllMarks().run()" class="menu-btn">
          <i-fluent-clear-formatting-20-regular />
        </button>
        <!-- ALign Left -->
        <button
          @click="editor.chain().focus().setTextAlign('left').run()"
          :class="{ 'is-active': editor.isActive({ textAlign: 'left' }) }"
          class="menu-btn border-l-2 border-l-base-100"
        >
          <i-humbleicons:align-objects-left />
        </button>
        <!-- ALign Center -->
        <button
          @click="editor.chain().focus().setTextAlign('center').run()"
          :class="{ 'is-active': editor.isActive({ textAlign: 'center' }) }"
          class="menu-btn"
        >
          <i-humbleicons:align-objects-center />
        </button>
        <!-- ALign Right -->
        <button
          @click="editor.chain().focus().setTextAlign('right').run()"
          :class="{ 'is-active': editor.isActive({ textAlign: 'right' }) }"
          class="menu-btn"
        >
          <i-humbleicons:align-objects-right />
        </button>
        <!-- Align Justify -->
        <button
          @click="editor.chain().focus().setTextAlign('justify').run()"
          :class="{ 'is-active': editor.isActive({ textAlign: 'justify' }) }"
          class="menu-btn"
        >
          <i-material-symbols:format-align-justify-rounded />
        </button>
        <button
          @click="editor.chain().focus().setParagraph().run()"
          :class="{ 'is-active': editor.isActive('paragraph') }"
          class="menu-btn border-l-2 border-l-base-100"
        >
          <i-material-symbols:format-paragraph-rounded />
        </button>
        <button
          @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
          :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
          class="menu-btn"
        >
          <i-lucide-heading-1 />
        </button>
        <button
          @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
          :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
          class="menu-btn"
        >
          <i-lucide-heading-2 />
        </button>
        <button
          @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
          :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
          class="menu-btn"
        >
          <i-lucide-heading-3 />
        </button>
        <button
          @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
          :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }"
          class="menu-btn"
        >
          <i-lucide-heading-4 />
        </button>
        <button
          @click="editor.chain().focus().toggleHeading({ level: 5 }).run()"
          :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }"
          class="menu-btn"
        >
          <i-lucide-heading-5 />
        </button>
        <button
          @click="editor.chain().focus().toggleHeading({ level: 6 }).run()"
          :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }"
          class="menu-btn"
        >
          <i-lucide-heading-6 />
        </button>
        <!-- Code -->
        <button
          @click="editor.chain().focus().toggleCode().run()"
          :disabled="!editor.can().chain().focus().toggleCode().run()"
          :class="{ 'is-active': editor.isActive('code') }"
          class="menu-btn border-l-2 border-l-base-100"
        >
          <i-fluent-code-20-regular />
        </button>
        <button
          @click="editor.chain().focus().toggleBulletList().run()"
          :class="{ 'is-active': editor.isActive('bulletList') }"
          class="menu-btn"
        >
          <i-fluent-text-bullet-list-ltr-20-regular />
        </button>
        <button
          @click="editor.chain().focus().toggleOrderedList().run()"
          :class="{ 'is-active': editor.isActive('orderedList') }"
          class="menu-btn"
        >
          <i-fluent-text-number-list-ltr-20-regular />
        </button>
        <button
          @click="editor.chain().focus().toggleBlockquote().run()"
          :class="{ 'is-active': editor.isActive('blockquote') }"
          class="menu-btn"
        >
          <i-fluent-text-quote-20-filled />
        </button>
        <button
          @click="editor.chain().focus().setHorizontalRule().run()"
          class="menu-btn"
        >
          <i-material-symbols-horizontal-rule-rounded />
        </button>
        <button @click="editor.chain().focus().setHardBreak().run()" class="menu-btn">
          <i-ci-line-break />
        </button>
        <button
          @click="openImageModal"
          type="button"
          class="menu-btn border-l-2 border-l-base-100"
        >
          <i-fluent:image-20-regular />
        </button>
        <button
          @click="editor.chain().focus().undo().run()"
          :disabled="!editor.can().chain().focus().undo().run()"
          class="menu-btn border-l-2 border-l-base-100"
        >
          <i-carbon-undo />
        </button>
        <button
          @click="editor.chain().focus().redo().run()"
          :disabled="!editor.can().chain().focus().redo().run()"
          class="menu-btn"
        >
          <i-carbon-redo />
        </button>
      </div>
    </div>
    <EditorContent :editor="editor"/>

    <!-- Image Upload Modal -->
    <div class="modal" :class="{ 'modal-open': imageModalOpen }">
      <div class="modal-box">
        <h3 class="font-bold text-xl text-base-content text-center mb-8">Upload Image</h3>
        <form @submit.prevent="uploadImage">
          <input
            type="file"
            class="file-input file-input-bordered file-input-primary w-full"
            @input="form.image = $event.target.files[0]"
          />
          <progress
            class="progress progress-primary w-56"
            v-if="form.progress"
            :value="form.progress.percentage"
            max="100"
          >
            {{ form.progress.percentage }}%
          </progress>
          <p v-if="formError" class="mt-2 py-1 rounded-md alert alert-error">
            {{ formError }}
          </p>
          <div class="modal-action">
            <button
              type="button"
              class="btn btn-info"
              @click="
                imageModalOpen = false;
                formError = null;
              "
            >
              Cancel
            </button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useToast } from "vue-toastification";
import Image from "@tiptap/extension-image";
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import TextAlign from "@tiptap/extension-text-align";
import Placeholder from "@tiptap/extension-placeholder";
import { onMounted, ref } from "vue";

const props = defineProps(["modelValue"]);
const emits = defineEmits(["update:modelValue"]);
const toast = useToast();

onMounted(() => {});
const editor = useEditor({
  content: props.modelValue,
  onUpdate: ({ editor }) => {
    emits("update:modelValue", editor.getHTML());
  },
  extensions: [
    StarterKit,
    TextAlign.configure({
      types: ["heading", "paragraph"],
    }),
    History,
    Image,
    Placeholder.configure({
      placeholder: "This is the start of an awesome Blog Post!!",
    }),
  ],
  editorProps: {
    attributes: {
      class: "pb-4 pt-6 px-4 focus:outline-none border border-primary border-t-0 rounded-b-md",
    },
  },
});
//- Image Upload
const form = {
  image: null,
};
const formError = ref("");
const imageModalOpen = ref(false);
const openImageModal = function () {
  form.image = null;
  imageModalOpen.value = true;
};
const uploadImage = async function () {
  const response = await axios.post(route("posts.saveImage"), form, {
    headers: {
      "Content-Type": "multipart/form-data",
    },
  });
  if (response.data.url) {
    editor.value?.commands.setImage({ src: response.data.url });
    imageModalOpen.value = false;
    form.image = null;
  } else {
    formError.value = response.data.error;
  }
};
</script>

<style lang="postcss">
.menu-btn {
  @apply flex justify-center items-center hover:bg-base-100  hover:text-primary px-1 py-2 duration-300 transition-colors;
}
.menu-btn .is-active {
  @apply bg-base-100 text-primary;
}
.menu-btn:first-child {
  @apply rounded-tl-md;
}
/* .menu-btn:last-child {
    @apply rounded-tr-md
} */
ol,
ul {
  list-style: revert;
  padding-left: 16px;
}
h1 {
  @apply text-5xl;
}
h2 {
  @apply text-4xl;
}
h3 {
  @apply text-3xl;
}
h4 {
  @apply text-2xl;
}
h5 {
  @apply text-xl font-bold;
}
h6 {
  @apply text-lg font-bold;
}
.ProseMirror
{
    @apply min-h-[50vh];
}

/* Placeholder Plugin */
.ProseMirror p.is-editor-empty:first-child::before {
  color: #6B7280;
  content: attr(data-placeholder);
  float: left;
  font-weight:semi-bold;
  height: 0;
  pointer-events: none;
}
</style>
