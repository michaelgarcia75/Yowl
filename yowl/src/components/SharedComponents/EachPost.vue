<template>
POOOOOST {{post}} ==================
  <div class="eachPost">
    <h1>{{ post.title }}</h1>
    <br />
    {{ post.content }}
    <br />
    <br />
    <VoteButtons :post="post" />
  </div>
</template>

<script>
// @ is an alias to /src
import VoteButtons from '@/components/SharedComponents/VoteButtons.vue'

export default {
  props: ['post'],
  name: 'IndexView',
  components: {
    VoteButtons
  }
}
</script>

<style scoped>
.eachPost {
  background-color: antiquewhite;
  padding: 10px;
  margin: 20px;
}
</style>
