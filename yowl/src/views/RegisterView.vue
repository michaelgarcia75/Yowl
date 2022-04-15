<template>
  <div>
    <h1>REGISTER</h1>
    <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="(error,index) in errors" :key="index">{{ error }}</li>
    </ul>
  </p>
    <form @submit.prevent="register">
      <input v-model="pseudo" placeholder="Pseudo" />
      <br>
      <br>
      <input v-model="email" placeholder="Email" />
      <br>
      <br>
      <input v-model="birth_date" placeholder="Birth Date : YYYY-MM-DD" />
      <br>
      <br>
      <input v-model="password" placeholder="Password" type="password" />
      <br>
      <br>
      <input v-model="password_confirmation" placeholder="Confirm Password" type="password" />
      <br>
      <br>
      <button type="submit">Register</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
// const regexDate = /^\d{4}-\d{2}-\d{2}$/

export default {
  name: 'RegisterView',
  data () {
    return {
      pseudo: '',
      email: '',
      birth_date: '',
      password: '',
      password_confirmation: '',
      user: {},
      errors: []
    }
  },
  methods: {
    register () {
      this.errors = []
      axios.post('https://yowlteam.herokuapp.com/api/auth/register', {
        pseudo: this.pseudo,
        email: this.email,
        birth_date: this.birth_date,
        password: this.password,
        password_confirmation: this.password_confirmation
      }
      )
        .then((response) => {
          console.log('response is', response.data)
          this.$router.push('/login')
        })
        .catch((error) => {
          const json = JSON.parse(error.response.data)
          for (const property in json) {
            this.errors.push(json[property])
          }
          console.log(this.errors)
        })
    }
  }
}
</script>
