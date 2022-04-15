<template>
    <tr v-if="userEditForm === false">
        <td>{{user.id}}</td>
        <td>{{userNewName}}</td>
        <td>{{userNewEmail}}</td>
        <!-- <td v-if="userNewRole === 0">User</td>
        <td v-else>Admin</td> -->
        <td>{{ userNewRole }} </td>
        <td>{{postsOfOneUser.length}}</td>
        <td>
            <button class='buttonEdit' @click="ChangeUserEditForm(); ChangeRoleOption()">Edit</button>
            <button class='buttonDelete' v-if="userEditForm === false" @click="$emit('deleteUser', userId)">Delete</button>
        </td>
    </tr>
    <tr v-else>
            <td>{{user.id}}</td>
            <td>
                <input class='input' v-model='userNewName' />
            </td>
            <td>
                <input class='input' v-model='userNewEmail' />
            </td>
            <!-- <td v-if="userNewRole === 0">
                <select name="is_admin" class="is_admin">
                  <option v-for="adminChoice in adminChoices" :value="adminChoice.role" :key="adminChoice.role">{{ adminChoice.role }}</option>
                </select>
            </td> -->
            <td>
                <select name='is_admin' class='roles' v-model='userNewRole'>
                    <option value='User'>User</option>
                    <option value='Admin'>Admin</option>
                </select>
            </td>
            <td>{{postsOfOneUser.length}}</td>
            <td>
                <button class='button' @click="$emit('updateUser', userId, userNewName, userNewEmail, userNewRole); ChangeUserEditForm()">Confirm</button>
                <button class='button' @click="CloseUserEditForm()">X</button>
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
      userNewName: this.user.pseudo,
      userNewEmail: this.user.email,
      userNewRole: this.user.is_admin
    }
  },
  //   components: {
  //     DropDownMenu
  //   },
  methods: {
    ChangeRoleFormat () {
      if (this.userNewRole === 1) {
        this.userNewRole = 'Admin'
      } else {
        this.userNewRole = 'User'
      }
    },
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
    CloseUserEditForm () {
      this.userEditForm = !this.userEditForm
      this.userNewName = this.user.pseudo
      this.userNewEmail = this.user.email
      this.userNewRole = this.user.is_admin
    },
    ChangeRoleOption () {
      // console.log('in change option function user new role is ', this.userNewRole)
      if (this.userNewRole === 1 || this.userNewRole === 'Admin') {
        this.userNewRole = 'Admin'
      } else {
        this.userNewRole = 'User'
      }
    }
  },
  created () {
    this.getPostsByUser(this.userId)
    this.ChangeRoleFormat()
  }
}
</script>

<style>
#firstTable{
  margin-left: auto;
  margin-right: auto;
}
.buttonEdit{
  background-color: white;
  border-radius: 3px;
  border-color: blue;
  margin-left: 3px;
}
.buttonDelete{
  background-color: white;
  border-radius: 3px;
  border-color: red;
}
</style>
