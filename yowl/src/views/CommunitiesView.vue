<template>
<p><b><u>Communities</u></b></p>
  <div class="communities">
    <CommunitiesManager
    v-for="community in communities"
      :key="community.id"
      :community_id="community.id"
      :category_id="category.id"
      :name="community.name"
      :title="community.title"
      :content="community.content"
      :picture="community.picture"
    />
    <CategoriesFilter></CategoriesFilter>
  </div>
  <button @click="isOpen = true" class="tc-note-open">
      Create a Community
    </button>
    <div class="modal" v-if="isOpen">
    <div class="tc-note">
       <span @click="isOpen = false" class="tc-note-close">
                ↩️
    </span>
    <div class="tc-note-header">
    <input v-model="communityTitle" type="text" placeholder="community Title" ref="communityTitle">
    </div>
    <div class="tc-note-body">
    <textarea v-model="communityDescription" type="text" placeholder="community Description" ref="communityDescription"/>
    </div>
      <div class="tc-note-footer">
 <img class="communitypicture" :src="this.image" />
  <br>
<button class="btn btn-info" @click="onPickFile">Upload community picture</button>
<input
  type="file"
  style="display: none"
  ref="fileInput"
  accept="image/*"
  @change="onFilePicked"/>
  <br>
  <select v-model="communityCategory">
  </select>
  <br>
  <button class="create" @click="createCommunity" type=button>
    Create
  </button>
</div>
  </div>
  </div>
  <router-view/>
</template>
<script setup>

import { ref } from 'vue'
import CommunitiesManager from '@/components/SharedComponents/CommunitiesManager.vue'
import CategoriesFilter from '@/components/SharedComponents/CategoriesFilter.vue'

const isOpen = ref(false)
</script>

<script>

export default {
  name: 'AdminView',
  components: {
    CommunitiesManager,
    CategoriesFilter
  },

  props: [
    'community_id',
    'title',
    'content',
    'picture'
  ],
  data () {
    return {
      image: null,
      tempTitle: this.title,
      tempContent: this.content,
      tempPicure: this.image
    }
  },
  methods: {
    createCommunity () {
      this.$emit('createCommunity')
    },
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
      this.image = files[0]
    }
  }
}
</script>
<style lang=scss scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.1);
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
      font-family: 'Caveat', cursive;}

      .tc-note-header {
        padding: 10px 16px 0;}

        .tc-note-close {
          display: inline-block;
          width: 24px;
          height: 24px;
          border-radius: 50%;
          line-height: 24px;
          text-align: center;
          transition: all 0.3s;}

      .tc-note-body {
        outline: 0;
      }

      .tc-note-body {
        font-size: 20px;
        padding: 10px 16px 16px;
      }
      .tc-note-open {

          border-radius: 5%;
          color: black
      }
      .communitypicture{
      width: 100px;
      height: 100px;
      }
</style>
