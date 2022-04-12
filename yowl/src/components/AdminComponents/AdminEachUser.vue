<template>
    <tr v-if="userEditForm === false">
        <td>{{user.id}}</td>
        <td>{{user.pseudo}}</td>
        <td>{{user.email}}</td>
        <td v-if="user.is_admin === 0">User</td>
        <td v-else>Admin</td>
        <td>{{postsOfOneUser.length}}</td>
        <td>
            <button class='button' @click="ChangeUserEditForm(); ChangeRoleOption()">Edit</button>
            <button class='button' v-if="userEditForm === false" @click="$emit('deleteUser', userId)">Delete</button>
        </td>
    </tr>
    <tr v-else>
            <td>{{user.id}}</td>
            <td>
                <input class='input' v-model='userName' />
            </td>
            <td>
                <input class='input' v-model='userEmail' />
            </td>
            <!-- <td v-if="user.is_admin === 0">
                <select name="is_admin" class="is_admin">
                  <option v-for="adminChoice in adminChoices" :value="adminChoice.role" :key="adminChoice.role">{{ adminChoice.role }}</option>
                </select>
            </td> -->
            <td>
                <select name='is_admin' class='roles' v-model='userRole'>
                    <option value='User'>User</option>
                    <option value='Admin'>Admin</option>
                </select>
            </td>
            <td>{{postsOfOneUser.length}}</td>
            <td>
                <button class='button' @click="$emit('updateUser', userId, userName, userEmail, userRole); ChangeUserEditForm()">Confirm</button>
                <button class='button' @click="ChangeUserEditForm()">X</button>
            </td>
    </tr>
</template>

<script>
import axios from 'axios'
// import DropDownMenu from '@/components/SharedComponents/DropDownMenu.vue'
export default {
  props: ['user'],
  data () {
    return {
      userId: this.user.id,
      postsOfOneUser: [],
      userEditForm: false,
      userName: this.user.pseudo,
      userEmail: this.user.email,
      userRole: 'User'
    }
  },
  //   components: {
  //     DropDownMenu
  //   },
  methods: {
    getPostsByUser (userId) {
    //   console.log('this user id ', userId)
      axios.get('https://yowlteam.herokuapp.com/api/posts/user/' + userId)
        .then((response) => {
          this.postsOfOneUser = response.data
          // console.log('posts of one user is ', this.postsOfOneUser)
        //   console.log('my user id is ', userId, 'posts of one user is ', this.postsOfOneUser)
        })
        .catch(error => console.log(error))
    },
    ChangeUserEditForm () {
      this.userEditForm = !this.userEditForm
    },
    ChangeRoleOption () {
      if (this.user.is_admin === 1) {
        this.userRole = 'Admin'
      }
    }
  },
  created () {
    this.getPostsByUser(this.userId)
  }
}
</script>
