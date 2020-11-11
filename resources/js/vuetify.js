import Vue from 'vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

const opts = {
    theme: {
        themes: {
            light: {
                success: '#f04747'
            }
        }
    }
}

export default new Vuetify(opts)
