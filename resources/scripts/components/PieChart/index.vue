<template>
    <v-card :color="color" class="v-card__chart" :height="height" flat>
        <v-card-text>{{ title }}</v-card-text>
        <canvas :id="context" :height="height - 73"></canvas>
    </v-card>
</template>

<script>
import Chart from 'chart.js';
import shortid from 'shortid';

export default {
    name: 'pie-chart',

    props: {
        color: {
            type: String,
            default: 'light-green lighten-5'
        },

        flat: {
            type: Boolean,
            default: true
        },

        height: {
            type: Number,
            default: 370
        },

        title: {
            type: String,
            default: 'Untitled'
        },

        value: null
    },

    data:() => ({
        chart: null,
        context: shortid.generate()
    }),

    mounted() {
        this.chart = new Chart(this.context, {
            "type":"pie",
            "data": this.value,

            "options":{
                animation: {
                    duration: 0,
                },
                hover: {
                    animationDuration: 0,
                },
                responsiveAnimationDuration: 0,
            }
        });
    },

    watch: {
        value: function(newVal) {
            this.chart.data = newVal;
            this.chart.update();
        }
    }
}
</script>