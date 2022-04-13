<template>
  <div>
    <h1>LOGIN</h1>
    <form @submit.prevent="login">
      <input v-model="email" placeholder="Email" />
      <br />
      <br />
      <input v-model="password" placeholder="Password" type="password" />
      <br />
      <br />
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
import { mapMutations } from 'vuex'

export default {
  name: 'LoginView',
  data () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    ...mapMutations(['setUser', 'setToken']),
    login () {
      axios.post('https://yowlteam.herokuapp.com/api/auth/login',
        {
          email: this.email,
          password: this.password
        }
      )
        .then((response) => {
          this.setUser(response.data.user)
          this.setToken(response.data.access_token)
          console.log('user is', response.data.user)
          this.$router.push('/')
        })
        .catch((error) => console.log(error))
    }
  }
}
</script>
