import Vue from 'vue';
import Vuetify from 'vuetify';
import { AxiosHttp } from './http';
import * as Pages from './pages';
import * as Utils from './utils';
import * as Components from './components';

window._ = require('lodash');

Vue.use(Vuetify);
Vue.use(AxiosHttp);
Vue.config.productionTip = false;

Object.keys(Pages).forEach((page) => {
    Vue.component(Pages[page].name, Pages[page]);
});

Object.keys(Utils).forEach((utility) => {
    Vue.component(Utils[utility].name, Utils[utility]);
});

Object.keys(Components).forEach((component) => {
    Vue.component(Components[component].name, Components[component]);
});

new Vue({
    data:() => ({
        menu: false,
        message: { show: false, text: null, type: null, time: 3500 }
    }),

    methods: {
        signOut: function() {
            document.getElementById('logout-form').submit();
        }
    }
}).$mount('#kominfo');