<template>
    users in total : {{this.users.length}}
    <br>
    posts in total : {{this.posts.length}}
    <br>
    communities in total : {{this.communities.length}}
    <br>
    new users today : {{ this.NewUsersToday.length }}
    <br>
    average new users daily : {{ this.AVGUsers }}
    <br>
    average new posts daily : {{ this.AVGPosts }}
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
      NewUsersToday: [],
      AVGUsers: 0,
      AVGPosts: 0
    }
  },
  methods: {
    getCurrentDate () {
      const localTime = moment().format('YYYY-MM-DD')
      return localTime
    },
    daysSinceStart () {
      const start = moment('2022-04-08', 'YYYY-MM-DD')
      const current = moment().startOf('day')
      const diffDays = moment.duration(current.diff(start)).asDays() + 1
      return diffDays
    },
    averageUsersAndPosts () {
      const totalUsers = this.users.length
      const totalPosts = this.posts.length
      const diffDays = this.daysSinceStart()
      this.AVGUsers = totalUsers / diffDays
      this.AVGPosts = totalPosts / diffDays
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/users')
      .then((response) => {
        console.log('users is', response.data)
        this.users = response.data
        this.NewUsersToday = this.users.filter((user) => user.created_at.substring(0, 10) === this.getCurrentDate())
        this.averageUsersAndPosts()
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        // console.log('posts is', response.data)
        this.posts = response.data
        this.averageUsersAndPosts()
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
