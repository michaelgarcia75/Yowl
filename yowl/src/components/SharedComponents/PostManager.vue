<template>
SEARCHRESULT §§§{{searchResult}}§§§<br>
FILTERRESULT §§§{{filterResult}}§§§<br>
BOTHRESULT §§§{{searchAndFilterResult}}§§§<br>
  <div class="postManager">
    <EachPost v-for="post in posts" :key="post.id" :post="post" @upvote="upvote" @downvote="downvote"/>
  </div>
</template>

<script>
import EachPost from '@/components/SharedComponents/EachPost.vue'

export default {
  props: ['searchResult', 'filterResult', 'searchAndFilterResult', 'posts'],
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
