<template>
  <div>
    <Head :title="`${form.name}`" />
    <div class="flex justify-between mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/panel/categories">Categories/</Link>
        <span class="text-gray-700 font-medium">{{ form.name }}</span>
      </h1>
      <img :src="category.data.avatar" class="block ml-4 w-10 h-10   rounded-full"  />
    </div>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Category</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Category</loading-button>
        </div>
      </form>
    </div>
    
      <h2 class="text-3xl font-bold mt-16">
        <Link class="text-gray-700 hover:text-gray-600" href="/panel/categories">Posts</Link>        
      </h2>
    <div class="bg-white rounded-md shadow overflow-x-auto my-7 p-4">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Title</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Created at</th>
        </tr>
        <tr
          v-for="post in category.data.posts"
          :key="post.slug"
          class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4 focus:text-indigo-500"
              :href="`/panel/categories/${post.slug}/edit`">
              <img
                v-if="post.thumbnail"
                class="block my-2 mr-2 w-10 h-10 rounded-full"
                :src="post.thumbnail" />
              {{ post.title }}
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4"
              :href="`/panel/categories/${post.slug}/edit`"
              tabindex="-1">
              {{ post.created_at }}
            </Link>
          </td>
        </tr>
        <tr v-if="category.posts?.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No posts found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '../../Shared/Layout.vue'
import TextInput from '../../Shared/TextInput.vue'
import FileInput from '../../Shared/FileInput.vue'
import SelectInput from '../../Shared/SelectInput.vue'
import LoadingButton from '../../Shared/LoadingButton.vue'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  props: {
    category: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.$props.category.data.name,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/panel/categories/${this.$props.category.data.name}`, {
        onSuccess: () => this.form.reset('password', 'avatar'),
      })
    },
    destroy() {
      if (confirm('Are you sure you want to delete this category?')) {
        this.$inertia.delete(`/panel/categories/${this.$props.category.data.name}`)
      }
    },
  },
}
</script>
