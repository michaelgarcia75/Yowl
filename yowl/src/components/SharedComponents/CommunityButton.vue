<template>
  <button @click="isOpen = true" class="tc-note-open">
    Create a Community
  </button>
  <!-- <button @click="isOpen = true" class="tc-note-open">
    Create a Community
  </button> -->
  <div class="modal" v-if="isOpen">
    <div class="tc-note">
      <span @click="isOpen = false" class="tc-note-close"> ↩️ </span>
      <div class="tc-note-header">
        <input
          v-model="communityTitle"
          type="text"
          placeholder="community Title"
          ref="communityTitle"
        />
      </div>
      <div class="tc-note-body">
        <textarea
          v-model="communityDescription"
          type="text"
          placeholder="community Description"
          ref="communityDescription"
        />
      </div>
      <div class="tc-note-footer">
        <img class="communitypicture" :src="this.image" />
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
        <CategoriesFilter :categories="categories" @getPostByCategoryFilter="getPostByCategoryFilter" v-model="categoryId"/>
        <br />
        <button class="create" @click="createCommunity(communityTitle, communityDescription, categoryId)" type="submit">
          Create
        </button>
      </div>
    </div>
  </div>
  <router-view />
</template>
<script setup>
import { ref } from 'vue'
import CategoriesFilter from '@/components/SharedComponents/CategoriesFilter.vue'
import axios from 'axios'
const isOpen = ref(false)
</script>
<script>
export default {
  name: 'AdminView',
  components: {
    CategoriesFilter
  },
  props: [],
  data () {
    return {
      image: null,
      communityTitle: '',
      communityDescription: '',
      categories: [],
      imagePath: this.image,
      categoryId: ''
    }
  },
  unmounted () {
    console.log('DESTROY')
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
    createCommunity (title, description) {
      console.log('title is ', title)
      console.log('description is ', description)
      console.log('image path is ', this.imageUrl.name)
      console.log('categoryId is ', this.categoryId)
      if (this.communityTitle !== '') {
        const picture = this.imageUrl.name
        axios.post('https://yowlteam.herokuapp.com/api/communities',
          {
            name: title,
            description: description,
            image: picture,
            category_id: this.categoryId
          }).then((data) => {
          console.log(data)
          window.location.reload()
        })
        this.communityTitle = title
      }
    },
    getPostByCategoryFilter (categoryId) {
      this.categoryId = categoryId
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
.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.1);
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
  cursor: pointer;
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
.communitypicture {
  width: 100px;
  height: 100px;
}
</style>
