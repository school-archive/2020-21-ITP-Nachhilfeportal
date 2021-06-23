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
        get_calendar: state => state.calendar
    },
    mutations: {
        set_visible(state, value) {
            state.is_visible = value;
        },
        add_calendar_all(state, value) {
            state.calendar = value
        },
        add_calendar_entry(state, value) {
            let day = value.day.substr(0, 2)
            state.calendar[day].push({
                'time_from' : value.time_from,
                'time_to' : value.time_to
            })
        },
        del_calendar_entry(state, value) {
            state.calendar[value.day] = state.calendar[value.day].filter(function(obj){
                return value.time_from !== obj.time_from
            });
        }
    }
};

module.exports = {
    modules: {
        daten
    }
};