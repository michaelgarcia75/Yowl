<template>
  <div>
    <h1>REGISTER</h1>
    <form @submit.prevent="register">
      <input v-model="pseudo" placeholder="Pseudo" />
      <br />
      <br />
      <input v-model="email" placeholder="Email" />
      <br />
      <br />
      <input v-model="password" placeholder="Password" type="password" />
      <br />
      <br />
      <input v-model="password_confirmation" placeholder="Confirm Password" type="password" />
      <br />
      <br />
      <button type="submit">Register</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'RegisterView',
  data () {
    return {
      pseudo: '',
      email: '',
      password: '',
      user: {}
    }
  },
  methods: {
    register () {
      axios.post('https://yowlteam.herokuapp.com/api/auth/register', {
        pseudo: this.pseudo,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      }
      )
        .then((response) => {
          console.log('response is', response)
          this.$router.push('/login')
        })
        .catch((error) => console.log(error))
    }
  }
}
</script>
