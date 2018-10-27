<template>
    <v-container fluid fill-height>
        <v-layout column>
            <v-flex md12 style="max-height: 180px;">
                <v-layout class="page__hero--small" row>
                    <v-flex class="page__hero--search" md12>
                        <div class="text__hero">
                            JADWAL UJIAN CALON PEGAWAI NEGERI SIPIL<br/>
                            PEMERINTAH KABUPATEN TANGERANG<br/>
                            TAHUN 2018
                        </div>
                    </v-flex>
                    <canvas id="particles"></canvas>
                </v-layout>
            </v-flex>

            <v-flex md12>
                <v-card class="v-card__table">
                    <v-card-text>
                        <v-data-table 
                            :headers="records_head"
                            :items="records_data"
                            :loading="loading"
                            :rows-per-page-items="[25, 50]"
                        >
                            <template slot="items" slot-scope="props">
                                <td>{{ props.item.participant_numb }}</td>
                                <td>{{ props.item.register_id }}</td>
                                <td>{{ props.item.name }}</td>
                                <td>{{ props.item.exam_date }}</td>
                                <td>{{ props.item.exam_time }}</td>
                                <td>{{ props.item.sesi }}</td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>


<script>
import Particles from 'particlesjs';

export default {
    name: 'page-exam',

    data: () => ({
        focus: false,
        searchtext: null,
        loading: true,
        records_head: [
            { class: 'column__describe', text: 'No. Peserta', value: 'participant_numb' },
            { class: 'column__describe', text: 'No. Register', value: 'register_id' },
            { class: 'column__describe', text: 'Nama', value: 'name' },
            { class: 'column__describe', text: 'Tgl. Ujian', value: 'exam_date' },
            { class: 'column__describe', text: 'Waktu Ujian', value: 'exam_time' },
            { class: 'column__describe', text: 'Sesi', value: 'sesi' }
        ],
        records_data: []
    }),
    
    mounted() {
        Particles.init({
            selector: '#particles'
        });

        this.fetchExam();
    },

    methods: {
        searching: function() {
        },
        fetchExam: async function() {
            let { data } = await this.$http.get('/ujian');

            this.records_data = data;
            this.loading = false;
        },
    },

    watch: {
        searchtext: function(newval, oldval) {
            if (newval !== oldval) {
                this.mistake = false;
            }
        }
    }
};
</script>
