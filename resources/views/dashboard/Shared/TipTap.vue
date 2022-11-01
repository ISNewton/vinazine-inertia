<template>
  <editor api-key="jdkd50w1oki4lpzrz14jno3sj88rn5km7puylq6xlh9i8wto"
    :init="{
      height: 500,
      plugins: 'lists link image emoticons',
      toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image emoticons'
    }"
   />
</template>

<script>
import Editor from '@tinymce/tinymce-vue'

export default {
  components: {
    Editor,
  },
}
</script>
