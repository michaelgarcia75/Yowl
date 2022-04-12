<template>
    users in total : {{this.users.length}}
    <br>
    posts in total : {{this.posts.length}}
    <br>
    communities in total : {{this.communities.length}}
    <br>
    new users today : {{ this.filteredUsers.length }}
</template>

<script>
import axios from 'axios'
import moment from 'moment'
export default {
  data () {
    return {
      users: [],
      posts: [],
      communities: [],
      filteredUsers: []
    }
  },
  methods: {
    getCurrentDate () {
      const localTime = moment().format('YYYY-MM-DD')
      return localTime
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/users')
      .then((response) => {
        console.log('users is', response.data)
        this.users = response.data
        this.filteredUsers = this.users.filter((user) => user.created_at.substring(0, 10) === this.getCurrentDate())
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        // console.log('posts is', response.data)
        this.posts = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/communities')
      .then((response) => {
        // console.log('communities is', response.data)
        this.communities = response.data
      })
      .catch(error => console.log(error))
  }
}
</script>
