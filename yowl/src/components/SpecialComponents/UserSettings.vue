<template>
  <div class="userSetting">
    <div class="settingTitle">
      <h1>Account Settings</h1>
      <button class="editButton" v-if="isOpen" @click="isOn=true, isOpen=false">Edit</button>
      <button class="returnButton" v-if="isOn" @click="isOn=false, isOpen=true">Return</button>
    </div>
    <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="(error,index) in errors" :key="index">{{ error }}</li>
    </ul>
  </p>
    <div class="settingContent" v-if="isOpen">
      <img id="userImage" src="./hamzabg.jpg" />
      <div class="userSettingInfo">
        <h1>Username</h1>
        <p>{{ newPseudo }}</p>
        <br>
        <h1>Email Adress</h1>
        <p>{{ newEmail }}</p>
        <br>
        <!-- <h1>Password</h1>
        <p>********</p> -->
      </div>
    </div>
    <div v-if="isOn"  class="settingContent">
      <img id="userImage" src="./hamzabg.jpg" />
      <div class="userSettingInfo">
        <h1>Username</h1>
        <input type="text" id="pseudo" v-model="newPseudo" placeholder="Michael le gros tocard" >
        <h1>Email Adress</h1>
        <input type="email" id="email" v-model="newEmail" placeholder="michael@toc.ard">
        <h1>Password</h1>
        <input type="password" id="password" v-model="newPassword">
        <h1>Confirmation</h1>
        <input type="password" id="confirmation" v-model="confirmation">
        <br>
        <button class="submitButton" @click="editUser(user.id, newPseudo, newEmail, newPassword, confirmation)">Submit</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters, mapMutations } from 'vuex'
const character = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
export default {
  data () {
    return {
      isOn: false,
      isOpen: true,
      errors: [],
      user: {},
      pseudo: '',
      email: '',
      newPseudo: '',
      newEmail: '',
      newPassword: '',
      confirmation: ''
    }
  },
  computed: {
    ...mapGetters(['isLoggedIn', 'getToken', 'getUser'])
  },
  methods: {
    ...mapMutations(['setUser', 'setToken']),
    editUser (userId, newPseudo, newEmail, newPassword, confirmation) {
      if (newPseudo === undefined && newPassword === undefined) {
        this.errors.push('Fields Empty')
      }
      if (newPseudo === undefined || newPseudo.length === 0) {
        this.errors.push('Username Field Empty')
      }
      if (newPassword === undefined || newPassword.length === 0) {
        this.errors.push('Password Field Empty')
      }
      if (newPseudo.length < 2 && newPseudo.length > 0) {
        this.errors.push('Username Minimum 8 characters')
      }
      if (!character.test(newEmail)) {
        this.errors.push('Please enter a valid email address')
      }
      if (newPassword !== confirmation) {
        this.errors.push('Password and Confirmation are not identical')
      }
      if (!this.errors.length) {
        axios.put('https://yowlteam.herokuapp.com/api/users/' + userId, {
          pseudo: newPseudo,
          email: newEmail,
          password: newPassword
        })
        this.user.pseudo = newPseudo
        this.user.email = newEmail
        this.isOn = false
        this.isOpen = true
      }
    }
  },
  beforeCreate () {
    // axios.get('https://yowlteam.herokuapp.com/api/users')
    //   .then((response) => {
    //     console.log(response.data)
    //     this.user = response.data
    //     this.newPseudo = this.user[0].pseudo
    //     this.newEmail = this.user[0].email
    //   })
    //   .catch()
  },
  created () {
    this.user = this.getUser
    console.log(this.user)
    this.newPseudo = this.user.pseudo
    this.newEmail = this.user.email
  }
}
</script>

<style scoped>
.userSetting{
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    width: 600px;
    height: auto;
}
.settingTitle{
    display: inline-block;
    flex-direction: row;
    width: 500px;
}
.settingTitle h1{
    display: inline-block;
    flex-direction: row;
    justify-content: flex-start;
    width: 200px;
    font-size: 20px;
    padding: 0;
    margin-right: 0;
}
.editButton{
    display: inline-block;
    flex-direction: row;
    border-radius: 5px;
    background-color: lightgreen;
    color: black;
    width: 50px;
    height: fit-content;
    position: relative;
}
.settingContent{
    display: inline-flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: flex-start;
    height: 200px;
    width: 100%;
    border: 5px solid aquamarine;
    border-radius: 5px;
    margin: 0;
    background-color: antiquewhite;
}

#userImage{
    flex-direction: row;
    height: 100%;
    width: 30%;
    float: left;
}

.userSettingInfo{
    justify-content: center;
    text-align: left;
    height: 100%;
    width: 70%;
    margin: 0;
}
.userSettingInfo h1{
    display: inline-block;
    flex-direction: column;
    justify-content: flex-start;
    width: 150px;
    font-size: 20px;
    margin-bottom: 5px;
}
.userSettingInfo p{
    align-items: center;
    display: inline-block;
    flex-direction: column;
    justify-content: flex-end;
    color: grey;
    margin-bottom: 5px;
    width: 100px;
}
.submitButton{
    float: right;
    margin-top: 5px;
    margin-right: 30px;
    border-radius: 5px;
    background-color: rgba(160, 238, 160, 0.788);
    color: black;
    width: 60px;
    height: fit-content;
}
.returnButton{
    display: inline-block;
    flex-direction: row;
    border-radius: 5px;
    background-color: red;
    color: black;
    width: 60px;
    height: fit-content;
    position: relative;
}
</style>
