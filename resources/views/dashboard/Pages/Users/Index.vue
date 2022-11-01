<template>
  <div>
    <Head title="Users" />
    <h1 class="mb-8 text-3xl font-bold text-gray-700 ">Users</h1>
    <div class="flex items-center justify-between mb-6">
     <!-- Search filters -->
      <search-filter v-model="form.q" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Role:</label>
        <select v-model="form.user_type" class="form-select mt-1 w-full">
          <option :value="all">All</option>
          <option
            v-for="(id, value) in roles"
            :key="id"
            :value="id">
            {{ value }}
          </option>
        </select>
         <label class="block text-gray-700">Status:</label>
        <select v-model="form.is_blocked" class="form-select mt-1 w-full">
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
      <Link class="btn-indigo" href="users/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;User</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6">Email</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Role</th>
        </tr>
        <tr
          v-for="user in users.data"
          :key="user.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4 focus:text-indigo-500"
              :href="`/panel/users/${user.id}/edit`">
              <img
                v-if="user.avatar"
                class="block -my-2 mr-2 w-10 h-10 rounded-full"
                :src="user.avatar" />
              {{ user.name }}
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4"
              :href="`/panel/users/${user.id}/edit`"
              tabindex="-1">
              {{ user.email }}
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4"
              :href="`/panel/users/${user.id}/edit`"
              tabindex="-1">
              {{ user.owner ? "Owner" : "User" }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link
              class="flex items-center px-4"
              :href="`/panel/users/${user.id}/edit`"
              tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="users?.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="users.meta.links" />
  </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import Icon from "../../Shared/Icon.vue";
import pickBy from "lodash.pickby";
import Layout from "../../Shared/Layout.vue";
import mapValues from "lodash.pickby";
import SearchFilter from "../../Shared/SearchFilter.vue";
import Pagination from "../../Shared/Pagination.vue";

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
    users: Array,
    roles: Object,
    status: Object,
  },
  data() {
    return {
      form: {
        q: '',
        user_type: null,
        is_blocked: null,
      },
    };
  },
  watch: {
    form: {
      deep: true,
      handler: function () {
        this.$inertia.get("/panel/users", pickBy(this.form), {preserveState: true});
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
