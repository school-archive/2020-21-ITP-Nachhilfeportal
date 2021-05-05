module.exports = {
    get_auth_data(vm) {
        return vm.axios.get(`${vm.$config.backend_host}/api/user/@me`)
    }
}