import Vue from 'vue';
import userApi from '@/api/user.api'

// State object
const state = () => ({
  email: '',
  name: '',
  access_token: localStorage.getItem('access_token') || '',
  isAuthenticated: false,
  isRegisteredFresh: false,
})

// Getter functions
const getters = {
  getName(state) {
    return state.name;
  },
  getEmail(state) {
    return state.email;
  },
  isAuthenticated: state => !!state.isAuthenticated,
  isRegisteredFresh: state => state.isRegisteredFresh,
}

// Actions
const actions = {
  authenticate({ commit }, data) {
    return new Promise( (resolve, reject) => {
      // Make network request and fetch data
      // and commit the data
      userApi.login(data.email, data.password)
        .then((response) => {
          commit('setUser', {
            isAuthenticated: true,
            ...response.data
          });
          resolve(response);
        })
        .catch( error => {
          reject(error);
        })
    })
  },
  register({commit}, data) {
    return new Promise( (resolve, reject) => {
      const {
        email,
        password,
        password_confirmation,
        name
      } = data;

      userApi.register(name, email, password, password_confirmation)
      .then((response) => {
          commit('setFreshRegistration', {
            isRegisteredFresh: true,
          });
          resolve(response);
        })
        .catch(error => {
          reject(error);
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
      isAuthenticated,
      access_token
    } = data

    Vue.set(state, 'name', name)
    Vue.set(state, 'email', email)
    Vue.set(state, 'isAuthenticated', isAuthenticated)
    Vue.set(state, 'access_token', access_token)
  },
  setFreshRegistration(state, isRegisteredFresh) {
    Vue.set(state, 'isRegisteredFresh', isRegisteredFresh);
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}