<template>
   <v-menu
    ref="menu"
    v-model="menu"
    :close-on-content-click="false"
    transition="scale-transition"
    offset-y
    min-width="290px"
    >
    <template v-slot:activator="{ on, attrs }">
        <v-text-field
        v-model="value"
        :label="label"
        prepend-icon="mdi-calendar"
        readonly
        v-bind="attrs"
        v-on="on"
        ></v-text-field>
    </template>
    <v-date-picker
        @change="$emit('input', $event)"
        :value="value"
        no-title
        scrollable
    >
        <v-spacer></v-spacer>
        <v-btn
        text
        color="primary"
        @click="menu = false"
        >
        Cancel
        </v-btn>
        <v-btn
        text
        color="primary"
        @click="$refs.menu.save(value)"
        >
        OK
        </v-btn>
    </v-date-picker>
    </v-menu>
</template>

<script>
export default {
    props: ['value', 'label'],
    data () {
        return {
            menu: null
        }
    }
}
</script>

<style>

</style>