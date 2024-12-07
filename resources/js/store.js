import { createStore } from 'vuex';

const store = createStore({
  state() {
    return {
      count: 0,
      message: 'Hello from Vuex!',
    };
  },
  getters: {
    count(state) {
      return state.count;
    },
    message(state) {
      return state.message;
    }
  },
  mutations: {
    increment(state) {
      state.count++;
    },
    decrement(state) {
      state.count--;
    },
    setMessage(state, payload) {
      state.message = payload;
    }
  },
  actions: {
    async incrementAsync({ commit }) {
      setTimeout(() => {
        commit('increment');
      }, 1000);
    },
    async updateMessage({ commit }, newMessage) {
      setTimeout(() => {
        commit('setMessage', newMessage);
      }, 1000);
    }
  }
});

export default store;
