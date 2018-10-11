<template>
    <v-flex class="page__find">
        <input ref="input" :value="search" @input="bouncing" class="page__find--text" type="text" :placeholder="placeholder">
        <v-spacer></v-spacer>
        <v-btn color="cyan" icon flat @click.native="$emit('close')">
            <v-icon>close</v-icon>
        </v-btn>
    </v-flex>
</template>

<script>
export default {
    name: 'm-search',

    props: {
        placeholder: {
            type: String,
            default: 'Search..'
        },

        value: {
            type: String,
            default: null
        }
    },

    data:() => ({
        search: null
    }),

    created() {
        this.search = this.value;
    },

    methods: {
        bouncing: window._.debounce(function(e) {
            this.search = e.target.value;
            this.$emit('input', this.search);
        }, 500),

        focus: function() {
            this.$refs.input.focus();
        }
    },

    watch: {
        value: function(newval) {
            this.search = newval;
        }
    }
};
</script>
