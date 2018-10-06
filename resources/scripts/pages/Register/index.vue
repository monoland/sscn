<template>
    <v-container fluid fill-height>
        <v-layout column>
            <v-flex class="page__header" md12>
                <div class="page__title">
                    <v-avatar size="56" color="red">
                        <v-icon dark>home</v-icon>
                    </v-avatar>
                    <div class="page__title--text">
                        Data Pendaftaran
                        <div class="subtitle">Some description goes here</div>
                    </div>
                </div>
                <div class="page__actions">
                    <div class="page__actions--wrapper">
                        <v-btn color="red" tag="div" id="button_target" dark>import</v-btn>
                    </div>
                </div>
            </v-flex>

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
                            <td>{{ props.item.nik }}</td>
                            <td>{{ props.item.name }}</td>
                            <td>{{ props.item.register_numb }}</td>
                            <td>{{ props.item.register_date }}</td>
                            <td>{{ props.item.born_place }}</td>
                            <td>{{ props.item.born_date }}</td>
                            <td class="text-xs-right">{{ props.item.updated_at }}</td>
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
    name: 'page-register',

    mixins: [mxCrud],

    data: () => ({
        uploader: false
    }),

    created() {
        this.headers = [
            { class: 'column__describe', text: 'NIK', value: 'nik' },
            { class: 'column__describe', text: 'Nama Lengkap', value: 'name' },
            { class: 'column__describe', text: 'No Register', value: 'type' },
            { class: 'column__describe', text: 'Tgl Daftar', value: 'position' },
            { class: 'column__describe', text: 'Tempat Lahir', value: 'location' },
            { class: 'column__describe', text: 'Tgl Lahir', value: 'education' },
            { class: 'column__date', text: 'Update', value: 'updated_at', align: 'right' }
        ];

        this.dataurl = '/api/register';
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