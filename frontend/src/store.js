const daten = {
    state: () => ({
        is_visible: true,
        calendar: {}
    }),
    getters: {
        is_visible: state => state.is_visible,
        get_mo: state => state.calendar.Mo,
        get_di: state => state.calendar.Di,
        get_mi: state => state.calendar.Mi,
        get_do: state => state.calendar.Do,
        get_fr: state => state.calendar.Fr,
        get_sa: state => state.calendar.Sa,
        get_so: state => state.calendar.So,
    },
    mutations: {
        set_visible(state, value) {
            state.is_visible = value;
        },
        add_calendar_all(state, value) {
            state.calendar = value
        },
        add_calendar_entry(state, value) {
            switch (value.day) {
                case 'Mo':
                    state.calendar.Mo.time_from = value.time_from
                    state.calendar.Mo.time_to = value.time_to
                    break
                case 'Di':
                    state.calendar.Di.time_from = value.time_from
                    state.calendar.Di.time_to = value.time_to
                    break
                case 'Mi':
                    state.calendar.Mi.time_from = value.time_from
                    state.calendar.Mi.time_to = value.time_to
                    break
                case 'Do':
                    state.calendar.Do.time_from = value.time_from
                    state.calendar.Do.time_to = value.time_to
                    break
                case 'Fr':
                    state.calendar.Fr.time_from = value.time_from
                    state.calendar.Fr.time_to = value.time_to
                    break
                case 'Sa':
                    state.calendar.Sa.time_from = value.time_from
                    state.calendar.Sa.time_to = value.time_to
                    break
                case 'So':
                    state.calendar.So.time_from = value.time_from
                    state.calendar.So.time_to = value.time_to
                    break
            }
        }
    }
};

module.exports = {
    modules: {
        daten
    }
};