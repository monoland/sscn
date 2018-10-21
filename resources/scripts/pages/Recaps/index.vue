<template>
    <v-container fluid fill-height>
        <v-layout column>
            <v-flex class="page__header" md12>
                <div class="page__title">
                    <v-avatar size="56" color="red">
                        <v-icon dark>home</v-icon>
                    </v-avatar>
                    <div class="page__title--text">
                        Rekap Pendaftaran
                        <div class="subtitle">Some description goes here</div>
                    </div>
                </div>
                <div class="page__actions">
                    <div class="page__actions--wrapper">
                        <v-btn color="cyan" tag="div" id="button_target" dark>import</v-btn>

                        <v-btn @click="findForm" color="cyan" flat icon>
                            <v-icon>search</v-icon>
                        </v-btn>
                    </div>
                </div>
            </v-flex>

            <m-search v-model="search" @close="closeFinder" v-show="findState" ref="elmInput"
                placeholder="Pencarian Lokasi"
            ></m-search>

            <v-flex class="page__data" md12>
                <v-data-table
                    :headers="headers"
                    :items="records"
                    :pagination.sync="pagination"
                    :total-items="totalRecords"
                    :rows-per-page-items="[10, 25, 50]"
                >
                    <template slot="items" slot-scope="props">
                        <tr>
                            <td>{{ props.item.type }}</td>
                            <td>{{ props.item.position }}</td>
                            <td>{{ props.item.location }}</td>
                            <td>{{ props.item.education }}</td>
                            <td>{{ props.item.formation }}</td>
                            <td>{{ props.item.registrar }}</td>
                            <td>{{ props.item.pass }}</td>
                            <td>{{ props.item.fail }}</td>
                        </tr>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>

        <utils-uploader v-model="uploader"
            :completed="updateTable"
        ></utils-uploader>
    </v-container>
</template>

<script>
import mxCrud from './../../mixins';


export default {
    name: 'page-recaps',

    mixins: [mxCrud],

    data: () => ({
        uploader: false
    }),

    created() {
        this.headers = [
            { class: 'column__describe', text: 'Jenis Formasi', value: 'type' },
            { class: 'column__describe', text: 'Jabatan', value: 'position' },
            { class: 'column__describe', text: 'Lokasi', value: 'location' },
            { class: 'column__describe', text: 'Pendidikan', value: 'education' },
            { class: 'column__describe', text: 'Formasi', value: 'formation' },
            { class: 'column__describe', text: 'Pendaftar', value: 'registrar' },
            { class: 'column__describe', text: 'Lulus', value: 'pass' },
            { class: 'column__describe', text: 'Tidak Lulus', value: 'fail' }
        ];

        this.dataurl = '/api/recaps';
    },

    methods: {
        updateTable: async function(response) {
            try {
                let {data} = await this.$http.post(this.dataurl + '/'+ response.fileinfo.path +'/import');

                if (data.success) {
                    this.getData(this.dataurl, this.pagination);
                    this.uploader = false;
                }
            } catch (error) {
                
            }
        }
    }
};
</script>