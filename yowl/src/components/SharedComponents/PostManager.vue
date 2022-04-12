<template>
SEARCHRESULT §§§{{searchResult}}§§§<br>
FILTERRESULT §§§{{filterResult}}§§§<br>
BOTHRESULT §§§{{searchAndFilterResult}}§§§<br>
  <div class="postManager">
    <EachPost v-for="post in postsFiltered" :key="post.id" :post="post"/>
  </div>
</template>

<script>
import EachPost from '@/components/SharedComponents/EachPost.vue'

export default {
  props: ['postsFiltered'],
  name: 'IndexView',
  components: {
    EachPost
  },
  methods: {
  }
}
</script>

<style>
.postManager {
  background-color: aquamarine;
  width: 80%;
}
</style>
