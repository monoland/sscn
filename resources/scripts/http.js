import Axios from 'axios';

export const AxiosHttp = {
    install (Vue) {
        if (this.installed) return;

        this.installed = true;

        let _token = document.head.querySelector('meta[name="csrf-token"]');

        Object.defineProperty(Vue.prototype, '$http', {
            get() {
                return Axios.create({
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': _token.content
                    }
                });
            }
        });

        Object.defineProperty(Vue.prototype, '$token', {
            get() {
                return _token.content;
            }
        });
    }
};