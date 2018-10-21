<template>
    <v-container fluid fill-height>
        <v-layout>
            <v-flex md12>
                <v-layout class="page__hero" row>
                    <v-flex class="page__hero--search" md8>
                        <div class="text__hero">
                            SELEKSI PENERIMAAN CALON PEGAWAI NEGERI SIPIL<br/>
                            PEMERINTAH KABUPATEN TANGERANG<br/>
                            TAHUN 2018
                        </div>
                        <div class="find__hero" :class="{ 'find__hero--focus': focus }">
                            <input type="text" name="find" placeholder="Nomor Register / NIK" @focus="focus = true" @blur="focus = false">
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
                        <v-hover>
                            <v-card slot-scope="{ hover }" :class="`hover-${hover ? 'on' : 'off'}`">
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
                        <v-hover>
                            <v-card slot-scope="{ hover }" :class="`hover-${hover ? 'on' : 'off'}`">
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
                        <v-hover>
                            <v-card slot-scope="{ hover }" :class="`hover-${hover ? 'on' : 'off'}`">
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
                        <v-hover>
                            <v-card slot-scope="{ hover }" :class="`hover-${hover ? 'on' : 'off'}`">
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
        </v-layout>
    </v-container>
</template>


<script>
import Particles from 'particlesjs';

export default {
    name: 'page-home',

    data: () => ({
        focus: false
    }),
    
    mounted() {
        Particles.init({
            selector: '#particles'
        });
    }
};
</script>
