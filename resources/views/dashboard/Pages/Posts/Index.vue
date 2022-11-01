<template>
  <div>
    <Head title="Posts" />
    <h1 class="mb-8 text-3xl font-bold text-gray-700 ">Posts</h1>
    <div class="flex items-center justify-between mb-6">
      <!-- Search filters -->
      <search-filter v-model="form.q" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Category:</label>
        <select v-model="form.category_id" class="form-select mt-1 w-full">
          <option :value="all">All</option>
          <option
            v-for="(id, value) in categories"
            :key="id"
            :value="value">
            {{ id }}
          </option>
        </select>
         <label class="block text-gray-700">Status:</label>
        <select v-model="form.is_active" class="form-select mt-1 w-full">
          <option :value="all">All</option>
          <option
            v-for="(id, value) in status"
            :key="id"
            :value="value">
            {{ id }}
          </option>
        </select>
      </search-filter>
      <!-- End Search filters -->
      <Link class="btn-indigo" href="posts/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Post</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Title</th>
          <th class="pb-4 pt-6 px-6">Status</th>
          <th v-if="isAdmin" class="pb-4 pt-6 px-6">User</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Created at</th>
        </tr>
        <tr
          v-for="post in posts.data"
          :key="post.slug"
          class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4 focus:text-indigo-500"
              :href="`/panel/posts/${post.slug}/edit`">
              <img
                v-if="post.thumbnail"
                class="block -my-2 mr-2 w-10 h-10 rounded-full"
                :src="post.thumbnail" />
              {{ post.title }}
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="flex content-center items-center px-6 py-4"
              :href="`/panel/posts/${post.slug}/edit`"
              tabindex="-1">
              <span class="h-5 w-5 rounded-full" :class="post.status == 'Active' ? 'bg-green-500' : 'bg-red-600'"></span>
            </Link>
          </td>
          <td v-if="isAdmin" class="border-t">
            <Link
              class="flex items-center px-6 py-4"
              :href="`/panel/posts/${post.slug}/edit`"
              tabindex="-1">
              {{ post.user?.name }}
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4"
              :href="`/panel/posts/${post.slug}/edit`"
              tabindex="-1">
              {{ post.created_at }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link
              class="flex items-center px-4"
              :href="`/panel/posts/${post.slug}/edit`"
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
    <pagination class="mt-6" :links="posts.meta.links" />
  </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import Icon from "../../Shared/Icon.vue";
import pickBy from "lodash.pickby";
import Layout from "../../Shared/Layout.vue";
import mapValues from "lodash.pickby";
import SearchFilter from "../../Shared/SearchFilter.vue";
import Pagination from '../../Shared/Pagination.vue'
export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
    Pagination,
  },
  layout: Layout,
  props: {
    posts: Array,
    categories: Object,
    status: Object,
  },
  computed: {
    isAdmin() {
      return this.$page.props.user.data.user_type === 'Admin'
    },
  },
  data() {
    return {
      form: {
        q: '',
        category_id: null,
        is_active: null,
      },
    };
  },
  watch: {
    form: {
      deep: true,
      handler: function () {
        this.$inertia.get("/panel/posts", pickBy(this.form), {preserveState: true});
      },
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
  },
};
</script>
