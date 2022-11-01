<template>
  <div>
    <Head title="Categories" />
    <h1 class="mb-8 text-3xl font-bold text-gray-700 ">Categories</h1>
    <div class="flex items-center justify-between mb-6">
      <!-- Search filters -->
      <Link class="btn-indigo" href="categories/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Category</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6" >Posts</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Created at</th>
        </tr>
        <tr
          v-for="category in categories.data"
          :key="category.name"
          class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4 focus:text-indigo-500"
              :href="`/panel/categories/${category.name}/edit`">
              <img
                v-if="category.avatar"
                class="block -my-2 mr-2 w-10 h-10 rounded-full"
                :src="category.avatar" />
              {{ category.name }}
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4"
              :href="`/panel/categories/${category.name}/edit`"
              tabindex="-1">
              {{ category.posts_count }}
            </Link>
          </td>
           <td class="border-t">
            <Link
              class="flex items-center px-6 py-4"
              :href="`/panel/categories/${category.name}/edit`"
              tabindex="-1">
              {{ category.created_at }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link
              class="flex items-center px-4"
              :href="`/panel/categories/${category.name}/edit`"
              tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="categories.data?.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No categories found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="categories.meta.links" />
  </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import Icon from "../../Shared/Icon.vue";
import pickBy from "lodash.pickby";
import Layout from "../../Shared/Layout.vue";
import throttle from "lodash.pickby";
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
    filters: Object,
    categories: Array,
  },
  data() {
    return {
      form: {
        // search: this.filters.search,
        // role: this.filters.role,
        // trashed: this.filters.trashed,
      },
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get("/categories", pickBy(this.form), {preserveState: true});
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
  },
};
</script>
