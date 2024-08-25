import { createStore } from "vuex";

const store = createStore({
    state: { count: 10 },
    mutations: {
        increment: (state) => {
            state.count++;
        },
    },
    actions: {
        increment(context) {
            context.commit("increment");
        },
    },
    getters: {
        doubleCount: (state) => state.count * 2,
    },
});

export default store;
