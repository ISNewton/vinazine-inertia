<template>
  <div>
    <Head :title="`${form.title}`" />
    <div class="flex justify-between mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/panel/posts">Posts/</Link>
        <span class="text-gray-700 font-medium">{{ form.title }}</span>
        
      </h1>
      <img :src="post.data.thumbnail" class="block ml-4 w-16 h-16 rounded-full"  />
    </div>
    <form @submit.prevent="update">
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
              :error="form.errors.thumbnail"
              class="pb-8 pr-6 w-full lg:w-1/2"
              type="file"
              accept="image/*"
              label="Thumbnail" />
          </div>
          <div
            class="flex items-center justify-between px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Post</button>
            <loading-button
              :loading="form.processing"
              class="btn-indigo"
              type="submit"
              >Update Post</loading-button
            >
          </div>
        </div>
        <div class="w-1/2 h-full bg-white rounded-md shadow overflow-hidden ml-3">
          <div class="mb-8 mr-6 p-8">
            <h2 class="text-gray-700 font-medium my-6">Content</h2>
            <p v-if="form.errors.content" class="form-error my-3">{{ form.errors.content }}</p> 
            <tip-tap v-model="form.content"  />
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '../../Shared/Layout.vue'
import TextInput from '../../Shared/TextInput.vue'
import FileInput from '../../Shared/FileInput.vue'
import SelectInput from '../../Shared/SelectInput.vue'
import LoadingButton from '../../Shared/LoadingButton.vue'
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
  props: {
    post: Object,
    categories: Object,
    status: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        title: this.$props.post.data.title,
        category_id: this.$props.post.data.category_id,
        is_active: this.$props.post.data.is_active,
        content: this.$props.post.data.content,
        thumbnail: null,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/panel/posts/${this.$props.post.data.slug}`, {
        onSuccess: () => this.form.reset('password', 'avatar'),
      })
    },
    destroy() {
      if (confirm('Are you sure you want to delete this post?')) {
        this.$inertia.delete(`/panel/posts/${this.$props.post.data.slug}`)
      }
    },
  },
}
</script>
