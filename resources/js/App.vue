<template>
  <v-container>
        <v-row>
            <v-col>
            <v-card width="100%">
                <v-card-title>Add Event</v-card-title>
                <v-card-text>
                    <v-form @submit.prevent="submit">
                        <v-row>
                            <v-col>
                                <v-text-field
                                    label="Event Name"
                                    filled
                                    v-model="name"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <h3>Date</h3>
                                <DatePicker v-model="date_from" label="Date From"/>
                                <DatePicker v-model="date_to" label="Date To"/>
                            </v-col>
                            <v-col>
                                <h3>Days</h3>
                                <v-chip-group
                                    v-model="selected_days"
                                    column
                                    multiple
                                    active-class="primary--text"
                                >
                                <v-chip
                                    outlined
                                    filter
                                    v-for="day in days"
                                    :value="day"
                                    :key="day"
                                >
                                    {{ day }}
                                </v-chip>
                            </v-chip-group>
                            </v-col>
                        </v-row>
                        <v-row justify="end">
                            <v-btn type="submit" outlined color="primary">Add Event</v-btn>
                        </v-row>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-col>
      </v-row>
      <v-row>
          <v-col>
            <v-card>
                <v-card-title>Calendar Events</v-card-title>
                <v-card-text>
                    <v-calendar
                        ref="calendar"
                        color="success"
                        :events="events"
                        type="month"
                    ></v-calendar>
                </v-card-text>
            </v-card>
          </v-col>
      </v-row>
  </v-container>
</template>

<script>
import DatePicker from './DatePicker'
import axios from 'axios'
const parseDate = (date) => {
      const d = new Date(date)
      const day = `0${d.getDate()}`.slice(-2)
      const month = `0${d.getMonth() + 1}`.slice(-2)
      const year = d
        .getFullYear()

      return `${year}-${month}-${day}`
}


export default {
    data () {
        return {
            selected_days: [],
            date_from: '',
            date_to: '',
            name: '',
            events: []
        }
    },
    methods: {
        submit () {
            const {
                selected_days,
                date_from,
                date_to,
                name
            } = this.$data
            axios.post('api/event/save', {
                days: selected_days.join(),
                date_from,
                date_to,
                name
            }).then(({ data }) => {
                this.getAll()
            })
        },
        async getAll () {
            axios.get('api/event/list')
                .then(async ({ data }) => {
                    data.forEach(async event => {
                        for (let date_from = new Date(event.date_from); date_from <= new Date(event.date_to); date_from.setDate(date_from.getDate() + 1)) {
                            const days = event.days.split(',')
                            if (!days.includes(date_from.toLocaleDateString('en', { weekday: 'long' }))) continue 
        
                            this.events.push({
                                name: event.name,
                                start: parseDate(date_from),
                                end: parseDate(date_from)
                            })
                        }
                    })

                })
        }
    },
    created () {
        this.getAll()
    },
    computed: {
        days () {
            return [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            ]
        }
    },
    components: {
        DatePicker
    }
}
</script>

<style>

</style>