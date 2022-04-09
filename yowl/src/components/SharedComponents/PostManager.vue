<template>
SEARCHRESULT §§§{{searchResult}}§§§<br>
FILTERRESULT §§§{{filterResult}}§§§<br>
BOTHRESULT §§§{{searchAndFilterResult}}§§§<br>
  <div class="postManager">
    <EachPost v-for="post in posts" :key="post.id" :post="post" />
  </div>
</template>

<script>
// @ is an alias to /src
import EachPost from '@/components/SharedComponents/EachPost.vue'

export default {
  props: ['searchResult', 'filterResult', 'searchAndFilterResult', 'posts'],
  name: 'IndexView',
  components: {
    EachPost
  }
}
</script>

<style>
.postManager {
  background-color: aquamarine;
  width: 80%;
}
</style>
