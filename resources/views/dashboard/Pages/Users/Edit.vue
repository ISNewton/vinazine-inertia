<template>
  <div>
    <Head :title="`${form.name}`" />
    <div class="flex justify-between mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/panel/users">Users/</Link>
        <span class="text-gray-700 font-medium">{{ form.name }}</span>
        
      </h1>
      <img :src="user.data.avatar" class="block ml-4 w-10 h-10   rounded-full"  />
    </div>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Full name" />
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.password" :error="form.errors.password" class="pb-8 pr-6 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Password" />
          <text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="pb-8 pr-6 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Password confirmation" />
          <select-input v-model="form.user_type" :error="form.errors.user_type" class="pb-8 pr-6 w-full lg:w-1/2" label="Role">
            <option v-for="(value,role) in roles" :key="role" :value="value">{{role}}</option>
          </select-input>
          <file-input v-model="form.avatar" :error="form.errors.avatar" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*" label="Avatar" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!user.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete User</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update User</loading-button>
        </div>
      </form>
    </div>
    
      <h2 class="text-3xl font-bold mt-16">
        <Link class="text-gray-700 hover:text-gray-600" href="/panel/posts">Posts</Link>        
      </h2>
    <div class="bg-white rounded-md shadow overflow-x-auto my-7 p-4">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Title</th>
          <th class="pb-4 pt-6 px-6" colspan="2">created at</th>
        </tr>
        <tr
          v-for="post in user.data.posts"
          :key="post.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4 focus:text-indigo-500"
              :href="`/panel/posts/${post.id}/edit`">
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
              :href="`/panel/posts/${post.id}/edit`"
              tabindex="-1">
              {{ post.created_at }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link
              class="flex items-center px-4"
              :href="`/panel/posts/${post.id}/edit`"
              tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="posts?.length === 0">
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
    user: Object,
    roles: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.$props.user.data.name,
        email: this.$props.user.data.email,
        user_type: this.$props.roles[this.$props.user.data.user_type],
        password: null,
        password_confirmation: null,
        avatar: null,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/panel/users/${this.$props.user.data.id}`, {
        onSuccess: () => this.form.reset('password', 'avatar'),
      })
    },
    destroy() {
      if (confirm('Are you sure you want to delete this user?')) {
        this.$inertia.delete(`/panel/users/${this.$props.user.data.id}`)
      }
    },
  },
}
</script>
