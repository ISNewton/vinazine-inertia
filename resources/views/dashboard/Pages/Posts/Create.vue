<template>
  <div>
    <Head title="Create Post" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/panel/posts"
        >Posts/
      </Link>
      <span class="text-gray-700 font-medium">Create</span>
    </h1>
    <form @submit.prevent="store">
      <div class="flex content-between">
        <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <text-input
              v-model="form.title"
              :error="form.errors.title"
              class="pb-8 pr-6 w-full lg:w-1/2"
              label="Title" />
            <select-input
              v-model="form.category_id"
              :error="form.errors.category_id"
              class="pb-8 pr-6 w-full lg:w-1/2"
              label="Category">
                <option v-for="(name, id) in categories" :key="id" :value="id">
                  {{ name }}
                </option>
            </select-input>
            <select-input
              v-model="form.is_active"
              :error="form.errors.is_active"
              class="pb-8 pr-6 w-full lg:w-1/2"
              label="Status">
              <option
                v-for="(id, value) in status"
                :key="id"
                :value="value">
                {{ id }}
              </option>
            </select-input>
            <file-input
              v-model="form.thumbnail"
              :errors="form.errors.thumbnail"
              class="pb-8 pr-6 w-full lg:w-1/2"
              type="file"
              accept="image/*"
              label="Thumbnail" />
          </div>
          <div
            class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
            <loading-button
              :loading="form.processing"
              class="btn-indigo"
              type="submit"
              >Create Post</loading-button
            >
          </div>
        </div>
        <div class="w-1/2 h-full bg-white rounded-md shadow overflow-hidden ml-3">
          <div class="mb-8 mr-6 p-8">
            <h2 class="text-gray-700 font-medium my-6">Content</h2>
            <p v-if="form.errors.content" class="form-error my-3">{{ form.errors.content }}</p> 
            <tip-tap v-model="form.content" :error="form.errors.content"  />
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Layout from "../../Shared/Layout.vue";
import FileInput from "../../Shared/FileInput.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import LoadingButton from "../../Shared/LoadingButton.vue";
import pickBy from "lodash.pickby";
import TipTap from "../../Shared/TipTap.vue";

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TipTap,
  },
  layout: Layout,
  remember: "form",
  props: {
    categories: Object,
    status: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        title: "",
        category_id: "",
        is_active: "",
        content: "",
        thumbnail: null,
      }),
    };
  },
  methods: {
    store() {
      this.form.post("/panel/posts", pickBy(this.form), {
        preserveState: true,
      });
    },
  },
};
</script>
