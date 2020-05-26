// State object
const state = () => ({
    notifications: [],
})

const getters = {
    notifications(state) {
        return state.notifications
    }
}

const actions = {
    notify({commit}, notification) {
        commit('setNotification', notification)
    }
}

const mutations = {
    setNotification(state, notification) {
        state.notifications.push(notification)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}
