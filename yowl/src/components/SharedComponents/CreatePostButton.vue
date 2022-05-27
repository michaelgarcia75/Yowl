<template>
  <div v-if="user" @click="isOpen = true" class="divModal">
    <input class="divModalBar" :readonly="readonly" placeholder="New post ..."/>
  </div>
  <div class="Posts">
    <CommunitiesManager
    />
  </div>
  <!-- <button @click="isOpen = true" class="tc-note-open">
    Create a Community !
  </button> -->
  <div class="modal" v-if="isOpen">
    <div class="tc-note">
      <span @click="isOpen = false" class="tc-note-close"> ↩️ </span>
      <div class="tc-note-header">
        <input
          v-model="postTitle"
          type="text"
          placeholder="Post Title"
          ref="postTitle"
        />
      </div>
      <div class="tc-note-body">
        <textarea
          v-model="postContent"
          type="text"
          placeholder="Post Content"
          ref="postContent"
        />
      </div>
      <div class="tc-note-footer">
        <img class="postPicture" :src="this.image" />
        <br />
        <button class="btn btn-info" @click="onPickFile">
          Upload community picture
        </button>
        <input
          type="file"
          style="display: none"
          ref="fileInput"
          accept="image/*"
          @change="onFilePicked"
        />
        <br />
        <CommunityFilter id="filterComu" :community="community" @getPostBycommunityFilter="getPostBycommunityFilter"/>
        <br />
        <button class="create" @click="createPost(postTitle, postContent, communityId)" type="submit">
          Create
        </button>
      </div>
    </div>
  </div>
  <router-view />
</template>
<script setup>
import { ref } from 'vue'
import CommunityFilter from '@/components/SharedComponents/CommunityFilter.vue'
import axios from 'axios'

const isOpen = ref(false)
</script>
<script>
export default {
  components: {
    CommunityFilter
  },

  props: ['user'],
  data () {
    return {
      image: null,
      postTitle: '',
      postContent: '',
      imagePath: this.image,
      posts: []
    }
  },
  methods: {
    onPickFile () {
      this.$refs.fileInput.click()
    },
    onFilePicked (event) {
      const files = event.target.files
      // const filename = files[0].name
      const fileReader = new FileReader()
      fileReader.addEventListener('load', () => {
        this.image = fileReader.result
      })
      fileReader.readAsDataURL(files[0])
      this.imageUrl = files[0]
    },
    createPost (title, content, communityId) {
      console.log('title is ', title)
      console.log('description is ', content)
      console.log('communityId is ', communityId)
      console.log('image path is ', this.imageUrl.name)
      if (this.postTitle !== '') {
        const picture = this.imageUrl.name
        axios.post('https://yowlteam.herokuapp.com/api/posts',
          {
            title: title,
            content: content,
            media: picture,
            user_id: this.user.id,
            community_id: this.communityId
          }).then((response) => {
          axios.get('https://yowlteam.herokuapp.com/api/posts')
            .then((response) => {
              this.posts = response.data
            })
        })
        this.postTitle = title
      }
    },
    getPostBycommunityFilter (communityId) {
      this.communityId = communityId
    }
  },
  created () {
    // },
    // mouted () {
    axios.get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        this.posts = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/categories')
      .then((response) => {
        this.categories = response.data
      })
      .catch(error => console.log(error))
  }
}
</script>

<style  scoped>
#filterComu{
  margin-left: 41.5%;
  margin-bottom: 5px;
}
button{
  border: solid 2px #01a0f9;
  border-radius: 3%;
  background-color: white;
}
input{
  border: solid 2px #01a0f9;
  border-radius: 3%;
}
textarea{
  border: solid 2px #15c8cb;
  border-radius: 3%;
  height: 130px;
  width: 250px;
}
.divModalBar {
  border: solid 2px #01a0f9;
  border-radius: 3%;
  width: 20%;
  height: 20px
}
.divModalBar:focus {
  outline: none;
}
.divModal {
  width: 100%;
  height: 60px;
}
.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.3);
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 10000000;
}

.modal > div {
  padding: 50px;
  width: 50%;
  height: 50%;
  border-color: 3px black;
  display: center;
}
.tc-note {
  background-color: white;
  width: 280px;
  height: 280px;
  margin: 30px 10px 20px;
  box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.2);
  transition: all 0.5s;
  font-family: "Caveat", cursive;
}

.tc-note-header {
  padding: 10px 16px 0;
}

.tc-note-close {
  display: inline-block;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  line-height: 24px;
  text-align: center;
  transition: all 0.3s;
  cursor: pointer;
}

.tc-note-body {
  outline: 0;
}

.tc-note-body {
  font-size: 20px;
  padding: 10px 16px 16px;
}
.tc-note-open {
  border-radius: 5%;
  color: black;
}
.postPicture {
  width: 100px;
  height: 100px;
}
</style>
