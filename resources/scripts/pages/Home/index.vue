<template>
    <v-container fluid fill-height>
        <v-layout column>
            <v-flex md12>
                <v-layout class="page__hero" row>
                    <v-flex class="page__hero--search" md8>
                        <div class="text__hero">
                            SELEKSI PENERIMAAN CALON PEGAWAI NEGERI SIPIL<br/>
                            PEMERINTAH KABUPATEN TANGERANG<br/>
                            TAHUN 2018
                        </div>
                        <div class="find__hero" :class="{ 'find__hero--focus': focus, 'find__hero--error': mistake }">
                            <input type="text" name="find" placeholder="Nomor Register / NIK" 
                                @focus="focus = true" 
                                @blur="focus = false"
                                @keyup.enter = "searching"
                                v-model="searchtext"
                            >
                        </div>
                        <div class="caption mt-2">
                            TEKAN ENTER UNTUK MELIHAT HASIL
                        </div>
                    </v-flex>
                    <v-flex class="page__hero--image" md4>
                        <img src="/images/all.png" alt="map">
                    </v-flex>
                    <canvas id="particles"></canvas>
                </v-layout>

                <v-layout class="page__statistic">
                    <v-flex md3>
                        <v-hover :close-delay="1" :open-delay="1">
                            <v-card @click.native="fetchRecap('UMUM')" slot-scope="{ hover }" :class="{ 'v-card__active': type === 'UMUM', 'hover-on': hover, 'hover-off': !hover }">
                                <div class="page__statistic--icon">
                                    <v-icon large dark>people</v-icon>
                                </div>
                                <div class="page__statistic--text">
                                    UMUM
                                    <div class="page__statistic--numb mt-1">
                                        <div class="page__statistic--list">FORMASI <span>230</span></div>
                                        <div class="page__statistic--list">PENDAFTAR <span>8917</span></div>
                                        <div class="page__statistic--list">LULUS <span>5693</span></div>
                                    </div>
                                </div>
                            </v-card>
                        </v-hover>
                    </v-flex>
                    <v-flex md3>
                        <v-hover :close-delay="1" :open-delay="1">
                            <v-card @click.native="fetchRecap('HONORER')" slot-scope="{ hover }" :class="{ 'v-card__active': type === 'HONORER', 'hover-on': hover, 'hover-off': !hover }">
                                <div class="page__statistic--icon">
                                    <v-icon large dark>assignment_ind</v-icon>
                                </div>
                                <div class="page__statistic--text">
                                    HONORER
                                    <div class="page__statistic--numb mt-1">
                                        <div class="page__statistic--list">FORMASI <span>187</span></div>
                                        <div class="page__statistic--list">PENDAFTAR <span>157</span></div>
                                        <div class="page__statistic--list">LULUS <span>156</span></div>
                                    </div>
                                </div>
                            </v-card>
                        </v-hover>
                    </v-flex>
                    <v-flex md3>
                        <v-hover :close-delay="1" :open-delay="1">
                            <v-card @click.native="fetchRecap('LULUSAN TERBAIK')" slot-scope="{ hover }" :class="{ 'v-card__active': type === 'LULUSAN TERBAIK', 'hover-on': hover, 'hover-off': !hover }">
                                <div class="page__statistic--icon">
                                    <v-icon large dark>school</v-icon>
                                </div>
                                <div class="page__statistic--text">
                                    LULUSAN TERBAIK
                                    <div class="page__statistic--numb mt-1">
                                        <div class="page__statistic--list">FORMASI <span>6</span></div>
                                        <div class="page__statistic--list">PENDAFTAR <span>19</span></div>
                                        <div class="page__statistic--list">LULUS <span>14</span></div>
                                    </div>
                                </div>
                            </v-card>
                        </v-hover>
                    </v-flex>
                    <v-flex md3>
                        <v-hover :close-delay="1" :open-delay="1">
                            <v-card @click.native="fetchRecap('PENYANDANG DISABILITAS')" slot-scope="{ hover }" :class="{ 'v-card__active': type === 'PENYANDANG DISABILITAS', 'hover-on': hover, 'hover-off': !hover }">
                                <div class="page__statistic--icon">
                                    <v-icon large dark>accessible</v-icon>
                                </div>
                                <div class="page__statistic--text">
                                    DISABILITAS
                                    <div class="page__statistic--numb mt-1">
                                        <div class="page__statistic--list">FORMASI <span>4</span></div>
                                        <div class="page__statistic--list">PENDAFTAR <span>1</span></div>
                                        <div class="page__statistic--list">LULUS <span>0</span></div>
                                    </div>
                                </div>
                            </v-card>
                        </v-hover>
                    </v-flex>
                </v-layout>
            </v-flex>

            <v-flex>
                <v-card class="v-card__table" color="cyan lighten-5">
                    <v-card-text>
                        <v-data-table 
                            :headers="recaps_head"
                            :items="recaps_data"
                        >
                            <template slot="items" slot-scope="props">
                                <td>{{ props.item.position }}</td>
                                <td>{{ props.item.location }}</td>
                                <td>{{ props.item.formation }}</td>
                                <td>{{ props.item.registrar }}</td>
                                <td>{{ props.item.pass }}</td>
                                <td>{{ props.item.fail }}</td>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>

    

        <v-dialog v-model="dialog.pass" max-width="500px" persistent>
            <v-card>
                <v-card-text class="announcement">
                    <div class="announcement--head">SELAMAT</div>
                    <div class="announcement--text mt-2">Pendaftar atas nama: `<strong>{{ person.nama }}</strong>` dengan No Register: `<strong>{{ person.id }}</strong>` dan NIK: `<strong>{{ person.nik }}</strong>` dinyatakan: `<strong class="green--text">Memenuhi Syarat</strong>` untuk mengikuti seleksi CPNS Kabupaten Tangerang tahun 2018 dalam jabatan: `<strong>{{ person.posisi }}</strong>` pada lokasi: `<strong>{{ person.lokasi }}</strong>` dengan nomor peserta: `<strong>{{ person.nomor }}</strong>`</div>
                    <v-divider class="my-3"></v-divider>
                    <div class="announcement--link">
                        <v-btn color="purple" dark :href="`/cetak/${person.id}`" target="_blank">cetak pengumuman</v-btn>
                        <v-btn color="cyan" dark @click.native="closeDialog">tutup</v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialog.fail" max-width="500px" persistent>
            <v-card>
                <v-card-text class="announcement">
                    <div class="announcement--head">MOHON MAAF</div>
                    <div class="announcement--text mt-2 mb-3">Pendaftar atas nama: `<strong>{{ person.nama }}</strong>` dengan No Register: `<strong>{{ person.id }}</strong>` dan NIK: `<strong>{{ person.nik }}</strong>` dinyatakan: `<strong class="red--text">Tidak Memenuhi Syarat</strong>` untuk mengikuti seleksi CPNS Kabupaten Tangerang tahun 2018 dalam jabatan: `<strong>{{ person.posisi }}</strong>` pada lokasi: `<strong>{{ person.lokasi }}</strong>`.</div>
                    <v-textarea box v-model="person.alasan" auto-grow label="Keterangan" hide-details></v-textarea>
                    <div class="announcement--link mt-3">
                        <v-btn color="cyan" dark @click.native="closeDialog">tutup</v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-container>
</template>


<script>
import Particles from 'particlesjs';

export default {
    name: 'page-home',

    data: () => ({
        focus: false,
        dialog: {
            pass: false,
            fail: false
        },
        mistake: false,
        searchtext: null,
        type: 'UMUM',
        person: {
            id: null,
            nik: null,
            nama: null,
            posisi: null,
            lokasi: null,
            nomor: null,
            alasan: null
        },
        recaps_head: [
            { text: 'Posisi', align: 'left', sortable: true, value: 'position' },
            { text: 'Lokasi', align: 'left', sortable: true, value: 'location' },
            { text: 'Formasi', align: 'left', sortable: true, value: 'formation', class: 'column__number' },
            { text: 'Pendaftar', align: 'left', sortable: true, value: 'registrar', class: 'column__number' },
            { text: 'Lulus', align: 'left', sortable: true, value: 'pass', class: 'column__number' },
            { text: 'Gagal', align: 'left', sortable: true, value: 'fail', class: 'column__number' }
        ],
        recaps_data: []
    }),
    
    mounted() {
        Particles.init({
            selector: '#particles'
        });

        this.fetchRecap('UMUM');
    },

    methods: {
        searching: async function() {
            try {
                this.mistake = false;

                let { data } = await this.$http.post('/validate', {
                    searchtext: this.searchtext
                });

                if (data.status === 'Lulus Verifikasi') {
                    this.person = data;
                    this.dialog.pass = true;
                } else {
                    this.person = data;
                    this.dialog.fail = true;
                }    
            } catch (error) {
                this.mistake = true;
            }
        },

        fetchRecap: async function(type) {
            this.type = type;

            let { data } = await this.$http.get('/rekapitulasi', {
                params: {
                    type: type
                }
            });

            this.recaps_data = data;
        },

        closeDialog: function() {
            this.searchtext = null;
            this.dialog.fail = false;
            this.dialog.pass = false;
        },

        download: function() {
            this.$http({
                url: '/download',
                method: 'GET',
                responseType: 'blob'
            }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'samples.pdf'); //or any other extension
                document.body.appendChild(link);
                link.click();
            });
        }
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
