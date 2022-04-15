<template>
  <div class="eachComment">
    <p>Posted by {{ commentUser.pseudo }} {{moment(date).fromNow()}}</p>
    <br />
    {{ comment.content }}
    <br />
  </div>
</template>

<script>
import moment from 'moment'

export default {
  props: ['comment'],
  name: 'IndexView',
  data () {
    return {
      commentUser: []
    }
  },
  created () {
    this.moment = moment
    this.commentUser = this.users.filter(user => user.id === this.comment.user_id)
    // axios.get('https://yowlteam.herokuapp.com/api/users/' + this.comment.user_id)
    //   .then((response) => {
    //     this.commentUser = response.data
    //     console.log('comment user id', response.data)
    //   })
    //   .catch(error => console.log(error))
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
