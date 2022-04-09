<template>
  <div class="index">
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <CreatePostButton @save="save" @filesChange="filesChange"/>
    <PostManager/>
    <TopCommunities/>
        <router-link to="/communities">Communities</router-link>

  </div>
</template>

<script>
// @ is an alias to /src
import CreatePostButton from '@/components/SharedComponents/CreatePostButton.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'
import TopCommunities from '@/components/SharedComponents/TopCommunities.vue'

export default {
  name: 'IndexView',
  components: {
    CreatePostButton,
    PostManager,
    TopCommunities
  },
  methods: {
    save (formData) {
      // upload data to the server
      this.currentStatus = 1

      upload(formData)
        .then(x => {
          this.uploadedFiles = [].concat(x)
          this.currentStatus = 2
        })
        .catch(err => {
          this.uploadError = err.response
          this.currentStatus = 3
        })
    },
    filesChange (fieldName, fileList) {
      // handle file changes
      const formData = new FormData()
      if (!fileList.length) return
      // append the files to FormData
      Array
        .from(Array(fileList.length).keys())
        .map((x) => {
          return formData.append(fieldName, fileList[x], fileList[x].name)
        })
      // save it
      this.save(formData)
    }
  }
}
</script>
