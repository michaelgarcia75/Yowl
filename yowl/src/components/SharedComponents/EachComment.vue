<template>
  <div class="eachComment">
    <h1>{{ this.userName }}</h1>
    <br />
    {{ comment.content }}
    <br />
  </div>
</template>

<script>
import axios from 'axios'
// @ is an alias to /src

export default {
  props: ['comment'],
  name: 'IndexView',
  data () {
    return {
      userName: ''
    }
  },
  components: {
  },
  created () {
    console.log(this.comment.user_id)
    axios
      .get('https://yowlteam.herokuapp.com/api/users/' + this.comment.user_id)
      .then((response) => {
        console.log('communities is', response.data)
        this.userName = response.data.pseudo
      })
      .catch((error) => console.log(error))
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
