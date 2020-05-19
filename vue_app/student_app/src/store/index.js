import Vue from 'vue'
import Vuex from 'vuex'

// import the auto exporter
import modules from './modules';

Vue.use(Vuex)

export function createStore() {
  return new Vuex.Store({
    modules
  })
}