<template>
  <AdminNavButtons></AdminNavButtons>
  <table id="firstTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Posts</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>
        <AdminEachUser
        v-for='user in users' :key='user.id' :user="user"
        @updateUser='updateUser'
        :userName='userName' :userEmail='userEmail' :userRole='userRole'
        @deleteUser='deleteUser'
        ></AdminEachUser>
        <!-- <td>{{user.id}}</td>
        <td>{{user.pseudo}}</td>
        <td>{{user.email}}</td>
        <td v-if="user.is_admin === 0">User</td>
        <td v-else>Admin</td>
        <td>{{this.postsOfOneUser.length}}</td> -->
    </tbody>
  </table>
</template>

<script>
import axios from 'axios'
import AdminEachUser from './AdminEachUser.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
      users: [],
      posts: []
      // postsOfOneUser: []
    }
  },
  components: {
    AdminEachUser,
    AdminNavButtons
  },
  methods: {
    updateUser (userId, userName, userEmail, userRole) {
      if (userRole === 'Admin') {
        userRole = 1
      } else {
        userRole = 0
      }
      console.log('changed user role is ', userRole)
      axios.put('https://yowlteam.herokuapp.com/api/users/' + userId,
        {
          pseudo: userName,
          email: userEmail,
          is_admin: userRole
        })
    },
    deleteUser (userId) {
      axios.delete('https://yowlteam.herokuapp.com/api/users/' + userId)
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/users')
      .then((response) => {
        console.log('users is', response.data)
        this.users = response.data
      })
      .catch(error => console.log(error))
    // axios.get('https://yowlteam.herokuapp.com/api/posts/user/' + this.userId)
    //   .then((response) => {
    //     // console.log('posts is', response.data)
    //     this.postsOfOneUser = response.data
    //     // this.postsOfOneUser = [...this.posts.filter((element) => element.user_id !== this.user.id)]
    //   })
    //   .catch(error => console.log(error))
  }
}
</script>
