import userApi from '@/api/user.api'

// State object
const state = () => ({
  user:  {
    name: '',
    email: '',
    id: null,
    updated_at: '',
    created_at: ''
  },
  isAuthenticated: false,
  access_token: localStorage.getItem('access_token') || '',
})

// Getter functions
const getters = {
  getUser: state => state.user,
  isAuthenticated: state => !!state.isAuthenticated,
}

// Actions
const actions = {
  authenticate({ commit }, data) {
    return new Promise( (resolve, reject) => {
      // Make network request and fetch data
      // and commit the data
      userApi.login(data.email, data.password)
        .then((response) => {
          commit('setUser', response.data.data)
          resolve(response.data.data)
        })
        .catch( error => {
          reject(error)
        })
    })
  },
  getUserDetails({ commit }) {
    return new Promise( (resolve, reject) => {
      if (localStorage.getItem('access_token')) {
        userApi.getUser()
          .then((response) => {
            commit('setUser', response.data)
            resolve(response)
          })
          .catch(error => {
            reject(error)
          })
      }
      else {
        reject("Token not found")
      }
    })
  },
  register({commit}, data) {
    return new Promise( (resolve, reject) => {
      const {
        email,
        password,
        password_confirmation,
        name
      } = data

      userApi.register(name, email, password, password_confirmation)
      .then((response) => {
          resolve(response)
        })
        .catch(error => {
          reject(error)
        })
    })
  }
}


// Mutations
const mutations = {
  setUser(state, data) {
    const {
      email,
      name,
      created_at,
      updated_at,
      access_token
    } = data

    state.user = {
      email: email,
      name: name,
      created_at: created_at,
      updated_at: updated_at
    }
    state.access_token = access_token
    state.isAuthenticated = true

    if (access_token) {
      localStorage.setItem('access_token', access_token)
    }

  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}