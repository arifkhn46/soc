import taskApi from '@/api/task.api'
import { filter } from 'lodash'
import moment from "moment"


const DEFAULT_DATE_FORMAT = 'YYYY-MM-DD'
const DEFAULT_TIME_FORMAT = 'hh:mm:ss'

function convertDateTime(datetime, dateFormat) {
  return moment(datetime, dateFormat).format(DEFAULT_DATE_FORMAT + ' ' + DEFAULT_TIME_FORMAT)
}

const state = () => ({
  types: [],
  tasks: [],
  taskStates: [],
  lastSynced: '',
})

const getters = {
  getTypes: state => state.types,
  getTasks: state => state.tasks,
  getStates: state => state.taskStates,
}

const actions = {
  createTask({ commit, state }, data) {
    return new Promise((resolve, reject)  => {
      let {
        title,
        description,
        type,
        start_at,
        end_at,
        optionalData
      } = data
      
      taskApi.createTask(title, description, type, convertDateTime(start_at), convertDateTime(end_at), optionalData)
        .then((response) => {
          if (state.lastSynced === '') {
            taskApi.getTasks()
            .then((res) => {
              commit('setTasks', res.data)
              resolve(response)
            })
            .catch((errors) => {
              reject(errors)
            })
          }
          else {
            commit('addTask', response.data.task)
            resolve(response)
          }
        })
        .catch((errors) => {
          reject(errors)
        })
    })
  },
  fetchTasks({ commit, state }) {
    return new Promise((resolve, reject) => {
      if (state.tasks.length) {
        resolve({
          data: {
            tasks: state.tasks
          }
        })
      }
      else {
        taskApi.getTasks()
          .then((response) => {
            commit('setTasks', response.data)
            resolve(response)
          })
          .catch((errors) => {
            reject(errors)
          })
      }

    })
  },
  updateTask({ commit }, data) {
    return new Promise ((resolve, reject) => {
      let {
        id,
        title,
        description,
        type,
        start_at,
        end_at,
        state
      } = data;
      taskApi.updateTask(id, title, description, type, convertDateTime(start_at), convertDateTime(end_at), state, {})
        .then((response) => {
          commit('updateTask', response.data.task);
          resolve(response)
        })
        .catch((errors) => {
          reject(errors)
        })
    })
  },
  deleteTask({ commit }, id) {
    return new Promise ((resolve, reject) => {
      taskApi.deleteTask(id)
        .then((response) => {
          commit('deleteTask', id);
          resolve(response)
        })
        .catch((errors) => {
          reject(errors)
        })
    })
  }
}

const mutations = {
  setTaskTypes(state, types) {
    state.types = types
  },
  setTasks(state, data) {
    state.tasks = data.tasks
    state.lastSynced = moment().format()
    state.taskStates = data.meta.states
    state.types = data.meta.types
  },
  addTask(state, task) {
    state.tasks.push(task)
  },
  updateTask(state, task) {
    state.tasks = [
        ...state.tasks.filter(element => element.id !== task.id),
        task
    ]
  },
  deleteTask(state, id) {
    state.tasks = state.tasks.filter(element => element.id !== id)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}