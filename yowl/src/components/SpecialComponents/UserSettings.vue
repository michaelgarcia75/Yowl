<template>
  <div class="userSetting">
    <div class="settingTitle">
      <h1>Account Settings</h1>
      <button class="editButton" v-if="isOpen" @click="isOpen=false">Edit</button>
      <button class="returnButton" v-if="!isOpen" @click="isOpen=true">Return</button>
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
    <div v-if="!isOpen"  class="settingContent">
      <img id="userImage" src="./hamzabg.jpg" />
      <div class="userSettingInfo">
        <h1>Username</h1>
        <input type="text" id="pseudo" v-model="newPseudo" placeholder="MichaelTocard75" >
        <h1>Email Adress</h1>
        <input type="email" id="email" v-model="newEmail" placeholder="michael@toc.ard">
        <h1>Birth Date</h1>
        <input type="text" id="birth_date" v-model="newBirthDate" placeholder="YYYY-MM-DD">
        <h1>Password</h1>
        <input type="password" id="password" v-model="newPassword">
        <h1>Confirmation</h1>
        <input type="password" id="confirmation" v-model="confirmation">
        <br>
        <button class="submitButton" @click="editUser(user.id, newPseudo, newEmail, newPassword, newBirthDate, confirmation)">Submit</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters, mapMutations } from 'vuex'
// const regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
// const regexDate = /^\d{4}-\d{2}-\d{2}$/
export default {
  data () {
    return {
      isOpen: true,
      errors: [],
      user: {},
      newPseudo: '',
      newEmail: '',
      newBirthDate: '',
      newPassword: '',
      confirmation: ''
    }
  },
  computed: {
    ...mapGetters(['isLoggedIn', 'getUser'])
  },
  methods: {
    ...mapMutations(['setUser']),
    editUser (userId, newPseudo, newEmail, newPassword, newBirthDate, confirmation) {
      this.errors = []
      // if (newPseudo === undefined || newPseudo.length === 0) {
      //   this.errors.push('Username Field Empty')
      // }
      // if (newPassword === undefined || newPassword.length === 0) {
      //   this.errors.push('Password Field Empty')
      // }
      // if (!regexEmail.test(newEmail)) {
      //   this.errors.push('Please enter a valid email address')
      // }
      // if (!regexDate.test(this.newBirthDate)) {
      //   this.errors.push('Please enter a valid birth date')
      // }
      // if (newPassword !== confirmation) {
      //   this.errors.push('Password and Confirmation are not identical')
      // }
      // if (!this.errors.length) {
      axios.put('https://yowlteam.herokuapp.com/api/users/' + userId, {
        pseudo: newPseudo,
        email: newEmail,
        password: newPassword,
        password_confirmation: confirmation,
        birth_date: newBirthDate
      })
        .then((data) => {
          console.log(data)
          console.log('User updated')
          this.user.pseudo = newPseudo
          this.user.email = newEmail
          this.user.birth_date = newBirthDate
          this.isOpen = true
          this.setUser(this.user)
        })
        .catch((error) => {
          const json = JSON.parse(error.response.data)
          for (const property in json) {
            this.errors.push(json[property])
          }
          console.log(this.errors)
        })
    }
  },
  created () {
    this.user = this.getUser
    this.newPseudo = this.user.pseudo
    this.newEmail = this.user.email
    this.newBirthDate = this.user.birth_date ?? ''
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
