<template>
    <v-container fluid fill-height>
        <v-layout column>
            <v-flex class="page__header" md12>
                <div class="page__title">
                    <v-avatar size="56" color="red">
                        <v-icon dark>home</v-icon>
                    </v-avatar>
                    <div class="page__title--text">
                        Dashboard
                        <div class="subtitle">Some description goes here</div>
                    </div>
                </div>
                <div class="page__actions">
                    <div class="page__actions--wrapper">
                        <v-btn color="red" dark>Addnew</v-btn>
                    </div>
                </div>
            </v-flex>

            <v-flex class="page__data" md12>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex md3 v-for="(recap, index) in recaps" :key="index">
                            <m-statistic
                                :icon="icons[index]"
                                :title="recap.type"
                                :value="recap.formation + '/' + recap.registrar"
                            ></m-statistic>
                        </v-flex>

                        <v-flex md8>
                            <line-chart
                                title="STATISTIK PENDAFTARAN"
                                v-model="timeline"
                            ></line-chart>
                        </v-flex>

                        <v-flex md4>
                            <pie-chart
                                title="STATISTIK VERIFIKASI"
                                v-model="summary"
                            ></pie-chart>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import Chart from 'chart.js';

export default {
    name: 'page-dashboard',

    data:() => ({
        recaps: null,
        timeline: null,
        summary: null,
        icons: [ 'assignment_ind', 'school', 'accessible', 'people']
    }),

    mounted() {
        this.getRecap();
        this.registerTimeline();
        this.registerSummary();
    },

    methods: {
        getRecap: async function() {
            let { data } = await this.$http.post('/api/recaps/summary');
            this.recaps = data;
        },

        registerTimeline: async function() {
            let { data } = await this.$http.post('/api/register/timeline');
            this.timeline = data;
        },

        registerSummary: async function() {
            let { data } = await this.$http.post('/api/register/summary');
            this.summary = data;
        }
    }
};
</script>
