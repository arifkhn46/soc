import subjectApi from '@/api/subject.api'

// State object
const state = () => ({
  subjects: [],
  subjectChapters: {}
})

const getters = {
  getSubjects: state => state.subjects,
  getSubjectChapters(state, id) {
    if (id in state.subjectChapters) {  
      return state.subjectChapters[id]
    }
    
    return [];
  } 
}

const actions = {
  fetchSubjects({ commit }) {
    return new Promise ((resolve, reject) => {
      subjectApi.getSubjects()
        .then((response) => {
          commit('setSubjects', response.data.data)
          commit('Task/setTaskTypes', response.data.meta.task_types, { root: true })
          resolve(response)
        })
        .catch( error => {
          reject(error)
        })
    })
  },
  fetchSubjectChapters({ commit, state }, id) {
    return new Promise ((resolve, reject) => {
      if (id in state.subjectChapters) {
        resolve({
          data: {
            data: state.subjectChapters[id]
          }
        })
      }
      else {
        subjectApi.getSubjectChapters(id)
          .then((response) => {
            commit('setSubjectChapters', { chapters: response.data.data, subject_id: id})
            resolve(response)
          })
          .catch( error => {
            reject(error)
          })
      }
    })
  }
}

const mutations = {
  setSubjects (state, subjects) {
    state.subjects = subjects
  },
  setSubjectChapters (state, data) {
    state.subjectChapters[data.subject_id] = data.chapters
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}