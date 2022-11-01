<template>
  <div>
    <Head title="Create User" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/panel/users">Users/ </Link>
      <span class="text-gray-700 font-medium">Create</span> 
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
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
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create User</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '../../Shared/Layout.vue'
import FileInput from '../../Shared/FileInput.vue'
import TextInput from '../../Shared/TextInput.vue'
import SelectInput from '../../Shared/SelectInput.vue'
import LoadingButton from '../../Shared/LoadingButton.vue'
import pickBy from "lodash.pickby";

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
  remember: 'form',
  props: {
    roles: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        user_type: 2,
        avatar: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/panel/users',pickBy(this.form), {preserveState: true})
    },
  },
}
</script>
