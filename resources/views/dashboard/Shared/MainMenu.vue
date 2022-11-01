<template>
  <div>
    <div v-if="isAdmin" class="mb-4">
      <Link class="group flex items-center py-3" href="/panel">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </Link>
    </div>
     <div class="mb-4">
      <Link class="group flex items-center py-3" href="/panel/posts">
        <icon name="office" class="mr-2 w-4 h-4" :class="isUrl('panel/posts') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('panel/posts') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Posts</div>
      </Link>
    </div>
    <div v-if="isAdmin" class="mb-4">
      <Link class="group flex items-center py-3" href="/panel/categories">
        <icon name="office" class="mr-2 w-4 h-4" :class="isUrl('panel/categories') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('panel/categories') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Categories</div>
      </Link>
    </div>
    <div v-if="isAdmin" class="mb-4">
      <Link class="group flex items-center py-3" href="/panel/users">
        <icon name="office" class="mr-2 w-4 h-4" :class="isUrl('panel/users') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('panel/users') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Users</div>
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from './Icon.vue'

export default {
  components: {
    Icon,
    Link,
  },
  computed: {
    isAdmin() {
      return this.$page.props.user.data.user_type === 'Admin'
    }
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)

      if(currentUrl == 'panel' && urls[0] == '') {
        return true;
      }
      
      if (urls[0] === '') {
        return currentUrl == ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
