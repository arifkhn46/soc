import taskApi from '@/api/task.api'
import { filter } from 'lodash'
import moment from "moment"

const state = () => ({
  types: [],
  tasks: []
})

const getters = {
  getTypes: state => state.types,
  getTasks: state => state.tasks,
  getTodaysTasks(state) {
    
    if (state.tasks.length) {
      const now = moment();
      let todayDate = now.format('DD-MM-YYYY');
      let tasks = filter(state.tasks, function(task){
        let taskDate = moment(task.start_at, 'DD-MM-YYYY hh:mm:ss').format('DD-MM-YYYY')
        return (taskDate === todayDate);
      
      });
      return tasks;
    }

    return []
  }
}

const actions = {
  createTask({ commit }, data) {
    return new Promise((resolve, reject)  => {
      let {
        title,
        description,
        type,
        start_at,
        end_at,
        subject_id,
        chapter_id
      } = data

      taskApi.createTask(title, description, type, start_at, end_at, subject_id, chapter_id)
        .then((response) => {
          commit('addTask', response.data.task)
          resolve(response)
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
            commit('setTasks', response.data.tasks)
            resolve(response)
          })
          .catch((errors) => {
            reject(errors)
          })
      }

    })
  } 
}

const mutations = {
  setTaskTypes(state, types) {
    state.types = types
  },
  setTasks(state, tasks) {
    state.tasks = tasks
  },
  addTask(state, task) {
    state.tasks.push(task)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}