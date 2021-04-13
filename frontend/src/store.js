const navbar = {
    namespaced: true,
    state: () => ({
        is_visible: true,
    }),
    getters: {
        is_visible: state => state.is_visible,
    },
    mutations: {
        set_visible(state, value) {
            state.is_visible = value;
        }
    }
};

module.exports = {
    modules: {
        navbar,
    }
};