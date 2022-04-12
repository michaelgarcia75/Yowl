<template>
<div class="userSetting">
<div class="settingTitle">
    <h1>Account Settings</h1>
    <button class="editButton" @click="isOn=true, isOpen=false">Edit</button>
    </div>
<div class="settingContent" v-if="isOpen">
    <img id="userImage" src="./bg.png" />
    <div class="userSettingInfo">
        <h1>Username</h1>
         <p>{{ users[0]?.pseudo }}</p>
         <br>
        <h1>Email Adress</h1>
         <p>{{ users[0]?.email }}</p>
         <br>
        <h1>Password</h1>
        <p>********</p>
    </div>
</div>
<div v-if="isOn"  class="settingContent">
    <img id="userImage" src="./bg.png" />
    <div class="userSettingInfo">
        <h1>Username</h1>
         <input type="text" id="pseudo" v-model="newPseudo" :placeholder="users[0]?.pseudo" >
        <h1>Email Adress</h1>
         <input type="email" id="email" v-model="newEmail" :placeholder="users[0]?.email">
        <h1>Password</h1>
        <input type="password" placeholder="********">
         <h1>Confirmation</h1>
        <input type="password" placeholder="********">
        <br>
        <button class="submitButton" @click="editUser(users[0].id, newPseudo, newEmail), isOn=false, isOpen=true">Submit</button>
    </div>
</div>
</div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const isOn = ref(false)
const isOpen = ref(true)
</script>

<script>
export default {
  data () {
    return {
      users: [],
      pseudo: '',
      email: ''
    }
  },
  methods: {
    editUser (userId, newPseudo, newEmail) {
      if (this.newPseudo.length < 8 && this.newPseudo.length > 0) {
        alert('Minimum 8 characters.')
        this.errors.push()
      }
      if (this.newEmail.length < 2) {
        alert('Please enter a valid email address')
        this.errors.push()
      }
      axios.put('https://yowlteam.herokuapp.com/api/users/' + userId, {
        pseudo: newPseudo,
        email: newEmail
      })
      this.users[0].pseudo = this.newPseudo
      this.users[0].email = this.newEmail
    }
  },
  beforeCreate () {
    axios.get('https://yowlteam.herokuapp.com/api/users')
      .then((response) => {
        this.users = response.data
      })
      .catch()
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
    height: 220px;
    width: 100%;
    border: 2px solid blue;
    border-radius: 5px;
    margin: 0;
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
</style>
