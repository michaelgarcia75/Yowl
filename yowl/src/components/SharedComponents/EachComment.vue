<template>
  <div class="eachComment">
    <h1>{{ comment.user_id }}</h1>
    <br />
    {{ comment.content }}
    <br />
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  props: ['comment'],
  name: 'IndexView',
  components: {
  }
}
</script>

<style scoped>
.eachComment {
  background-color: antiquewhite;
  width: 50%;
  padding: 10px;
  margin: 20px;
  margin-left: 25%;
  margin-right: 25%;
}
</style>
