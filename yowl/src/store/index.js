import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'

export default createStore({
  plugins: [createPersistedState({
    storage: window.sessionStorage
  })],
  state: {
    user: null,
    token: null
  },
  getters: {
    isLoggedIn (state) {
      return !!state.token
    },
    getToken (state) {
      return state.token
    },
    getUser (state) {
      return state.user
    }
  },
  mutations: {
    setUser (state, user) {
      state.user = user
    },
    setToken (state, token) {
      state.token = token
    }
  },
  actions: {
  },
  modules: {
  }
})
