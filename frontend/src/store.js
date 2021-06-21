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
                case 'Montag':
                    state.calendar.Mo.push({
                        'time_from' : value.time_from,
                        'time_to' : value.time_to
                    })
                    break
                case 'Dienstag':
                    state.calendar.Di.push({
                        'time_from' : value.time_from,
                        'time_to' : value.time_to
                    })
                    break
                case 'Mittwoch':
                    state.calendar.Mi.push({
                        'time_from' : value.time_from,
                        'time_to' : value.time_to
                    })
                    break
                case 'Donnerstag':
                    state.calendar.Do.push({
                        'time_from' : value.time_from,
                        'time_to' : value.time_to
                    })
                    break
                case 'Freitag':
                    state.calendar.Fr.push({
                        'time_from' : value.time_from,
                        'time_to' : value.time_to
                    })
                    break
                case 'Samstag':
                    state.calendar.Sa.push({
                        'time_from' : value.time_from,
                        'time_to' : value.time_to
                    })
                    break
                case 'Sonntag':
                    state.calendar.So.push({
                        'time_from' : value.time_from,
                        'time_to' : value.time_to
                    })
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