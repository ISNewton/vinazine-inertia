<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold text-gray-700">Dashboard</h1>
    <div class="flex content-between my-4">
      <!-- Stats -->
      <stats title="Posts" :value="postsCount"/>
      <stats title="Users" :value="usersCount"/>
      <stats title="Authors" :value="authorsCount"/>
      <stats title="Admins" :value="adminsCount"/>
    </div>
      <div class="my-4">
          <h1 class="font-bold my-4 text-bold text-2xl text-gray-700">Latest Posts</h1>
        <div class="bg-white rounded-md shadow overflow-x-auto">
          <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
              <th class="pb-4 pt-6 px-6">Title</th>
              <th class="pb-4 pt-6 px-6" >User</th>
              <th class="pb-4 pt-6 px-6" >Views</th>
            </tr>
            <tr
              v-for="post in latestPosts.data"
              :key="post.id"
              class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="border-t">
                <Link
                  class="flex items-center px-6 py-4 focus:text-indigo-500"
                  :href="`/panel/categories/${post.slug}/edit`">
                  <img
                    v-if="post.thubmnail"
                    class="block -my-2 mr-2 w-10 h-10 rounded-full"
                    :src="post.thubmnail" />
                  {{ post.title }}
                </Link>
              </td>
              <td class="border-t">
                <Link
                  class="flex items-center px-6 py-4"
                  :href="`/panel/categories/${post.user.id}/edit`"
                  tabindex="-1">
                  {{ post.user.name }}
                </Link>
              </td>
              <td class="border-t">
                <Link
                  class="flex items-center px-6 py-4"
                  :href="`/panel/categories/${post.slug}/edit`"
                  tabindex="-1">
                  {{ post.title }}
                </Link>
              </td>
            </tr>
            <tr v-if="latestPosts.data?.length === 0">
              <td class="px-6 py-4 border-t" colspan="4">No Posts found.</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="flex content-between">
        <div class="my-10 bg-white p-4 w-1/2">
            <h1 class="font-bold my-4 text-bold text-2xl text-gray-700 inline">Posts views</h1>
          <bar-chart :styles="{position: relative}" :data="traffic"/>
        </div>
        <div class="my-10 bg-white w-1/2 inline-block ml-3 p-4">
            <h1 class="font-bold my-4 text-bold text-2xl text-gray-700 inline">Most Active Authors</h1>
          <div class="bg-white rounded-md shadow overflow-x-auto">
              <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                  <th class="pb-4 pt-6 px-6">Name</th>
                  <th class="pb-4 pt-6 px-6" >Email</th>
                  <th class="pb-4 pt-6 px-6" >Posts</th>
                </tr>
                <tr
                  v-for="user in activeAuthors.data"
                  :key="user.id"
                  class="hover:bg-gray-100 focus-within:bg-gray-100">
                  <td class="border-t">
                    <Link
                      class="flex items-center px-6 py-4 focus:text-indigo-500"
                      :href="`/panel/categories/${user.id}/edit`">
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
                      :href="`/panel/categories/${user.id}/edit`"
                      tabindex="-1">
                      {{ user.email }}
                    </Link>
                  </td>
                  <td class="border-t">
                    <Link
                      class="flex items-center px-6 py-4"
                      :href="`/panel/categories/${user.id}/edit`"
                      tabindex="-1">
                      {{ user.posts_count }}
                    </Link>
                  </td>
                </tr>
                <tr v-if="activeAuthors?.length === 0">
                  <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
                </tr>
              </table>
            </div>
        </div>
    </div>
  </div>
</template>

<script>

import { Head } from '@inertiajs/inertia-vue3'
import Layout from '../Shared/Layout.vue'
import BarChart from '../Charts/BarChart.vue'
import Stats from '../Shared/Stats.vue'
export default {
  components: {
    Head,
    BarChart,
    Stats,
  },
  layout: Layout,
  props: {
    traffic: Object,
    latestPosts: Array,
    activeAuthors: Object,
    postsCount: Number,
    usersCount: Number,
    AuthorsCount: Number,
    AdminsCount: Number,
  }
}
</script>
