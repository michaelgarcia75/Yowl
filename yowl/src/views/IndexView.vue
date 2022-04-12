<template>
  <div class="index">
    <p v-if="searchContent"> Research : {{searchContent}}</p>
    <CreatePostButton @save="save" @filesChange="filesChange"/>
    <PostManager :postsFiltered="postsFiltered"/>
    <TopCommunities/>
        <router-link to="/communities">Communities</router-link>

  </div>
</template>

<script>
import axios from 'axios'
import CreatePostButton from '@/components/SharedComponents/CreatePostButton.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'
import TopCommunities from '@/components/SharedComponents/TopCommunities.vue'

export default {
  name: 'IndexView',
  props: ['postsFiltered', 'searchContent'],
  components: {
    CreatePostButton,
    PostManager,
    TopCommunities
  },
  data () {
    return {
      posts: [],
      categories: [],
      communities: []
    }
  },
  methods: {
    // save (formData) {
    //   // upload data to the server
    //   this.currentStatus = 1

    //   upload(formData)
    //     .then(x => {
    //       this.uploadedFiles = [].concat(x)
    //       this.currentStatus = 2
    //     })
    //     .catch(err => {
    //       this.uploadError = err.response
    //       this.currentStatus = 3
    //     })
    // },
    // filesChange (fieldName, fileList) {
    //   // handle file changes
    //   const formData = new FormData()
    //   if (!fileList.length) return
    //   // append the files to FormData
    //   Array
    //     .from(Array(fileList.length).keys())
    //     .map((x) => {
    //       return formData.append(fieldName, fileList[x], fileList[x].name)
    //     })
    //   // save it
    //   this.save(formData)
    // }
  },
  created () {
    // },
    // mouted () {
    axios.get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        // console.log('posts is', response.data)
        this.posts = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/categories')
      .then((response) => {
        // console.log('categories is', response.data)
        this.categories = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/communities')
      .then((response) => {
        // console.log('communities is', response.data)
        this.communities = response.data
      })
      .catch(error => console.log(error))
  }
}
</script>
