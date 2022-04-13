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
        :userNewName="useNewName" :userNewEmail="userNewEmail" :userNewRole="userNewRole"
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
      // console.log('changed user role is ', userRole)
      axios.put('https://yowlteam.herokuapp.com/api/users/' + userId,
        {
          pseudo: userName,
          email: userEmail,
          is_admin: userRole
        })
      this.userNewName = userName
      this.userNewEmail = userEmail
      this.userNewRole = userRole
      // console.log('in function userName is ', this.userNewName, 'userEmail is ', this.userNewEmail, 'userRole is ', this.userNewRole)
    },
    deleteUser (userId) {
      axios.delete('https://yowlteam.herokuapp.com/api/users/' + userId)
        .then((response) => {
          // console.log('in side response')
          // console.log('response is ', response)
          this.users = [...this.users.filter((element) => element.id !== userId)]
        })
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/users')
      .then((response) => {
        // console.log('users is', response.data)
        this.users = response.data
      })
      .catch(error => console.log(error))
  }
}
</script>
