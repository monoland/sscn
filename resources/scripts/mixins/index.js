const mxCrud = {
    data:() => ({
        headers: [],
        records: [],
        record: {},
        links: {},
        meta: {},
        selected: [],
        pagination: {},
        totalRecords: 0,
        dataurl: null,
        dataid: null,
        
        disabled: { 
            link: true, 
            edit: true, 
            delete: true,
            addnew: false, 
            find: false 
        },

        dialog: false,

        formState: false,
        newState: true,
        findState: false,

        loading: false,
        firstLoad: true,
        
        search: null,
        searchState: false
    }),

    created() {
        this.newRecord();

        this.dataid = this.record.id;
    },

    mounted() {
        this.getData(this.dataurl, this.pagination);
    },

    methods: {
        fetchCombo: async function(dataPath, params, callback) {
            let { data } = await this.$http.get(dataPath, { params: params });

            callback(data);
        },

        newRecord: function() {
            // 
        },

        primaryKey: function() {
            return this.record.id;
        },

        closeLoader: function() {
            window.setTimeout(() => {
                this.loading = false;
                if (this.findState) {
                    this.$refs.elmInput.focus();
                }
            }, 500);
        },

        closeFinder: function() {
            this.search = this.pagination.filter = null;
            this.findState = false;
        },

        bouncing: window._.debounce(function(e) {
            this.search = e.target.value;
        }, 500),

        getData: async function(data_url, data_params) {
            this.loading = true;

            try {
                let {data: {data, links, meta}} = await this.$http.get(data_url, { params: data_params });

                this.records = data;
                this.links = links;
                this.totalRecords = meta.total;
                this.firstLoad = false;
                this.closeLoader();
                this.selected = [];
            } catch (error) {
                this.closeLoader();
                this.errorHandle(error);
            }
        },

        refreshData: function() {
            this.getData(this.dataurl, this.pagination);
        },

        findForm: function() {
            this.findState = true;
            
            this.$nextTick(() => {
                this.$refs.elmInput.focus();
            });
        },

        submitData: function() {
            this.newState ? this.postData() : this.updateData();
        },

        postForm: function() {
            this.newRecord();
            this.newState = true;
            this.formState = true;
        },

        postData: async function() {
            try {
                let { data: {data}} = await this.$http.post(
                    this.dataurl, this.record
                );
                
                this.records.push( data );
                this.formState = false;
                this.$complete = 'Save record was successed!';
            } catch (error) {
                this.errorHandle(error);
            }
        },

        updateForm: function() {
            this.newState = false;
            this.formState = true;
        },

        updateData: async function() {
            try {
                let { data: { data }} = await this.$http.put(
                    this.dataurl + '/' + this.primaryKey(), this.record
                );

                this.record = data;
                this.formState = false;
                this.$complete = 'Update record was successed!';
            } catch (error) {
                this.errorHandle(error);
            }
        },

        destroyForm: function() {
            this.dialog = true;
        },

        destroyData: async function() {
            try {
                let response;

                if (this.selected.length <= 1) {
                    let index = this.records.indexOf(this.record);

                    response = await this.$http.delete(
                        this.dataurl + '/' + this.primaryKey()
                    );

                    if (response) {
                        this.records.splice(index, 1);
                        this.dialog = false;
                    }
                } else {
                    response = await this.$http.post(
                        this.dataurl + '/bulks', this.selected
                    );

                    if (response) {
                        this.selected.forEach((record) => {
                            let index = this.records.indexOf(record);
                            this.records.splice(index, 1);
                        });

                        this.dialog = false;
                    }
                }

                this.$info = 'Delete record is completed!';
                this.stateDefault();
            } catch (error) {
                this.errorHandle(error);
            }
        },

        openLink: function() {},

        stateOveride: function() {},

        stateDefault: function() {
            this.disabled = { 
                link: true, 
                edit: true, 
                delete: true,
                addnew: false,
                find: false
            };
        },

        stateDelete: function() {
            this.disabled = { 
                link: true, 
                edit: true, 
                delete: false,
                addnew: true,
                find: true
            };
        },

        stateSelect: function() {
            this.disabled = { 
                link: false, 
                edit: false, 
                delete: false,
                addnew: true,
                find: true
            };

            this.stateOveride();
        },

        signOut: async function() {
            this.$http.post('/logout');
        },

        errorHandle: function(error) {
            if (error.hasOwnProperty('message')) {
                // Unauthorize
                if (error.message === 'Request failed with status code 401') {
                    this.signOut();
                } else {
                    // something else
                    this.$error = error.message;
                }
            }

            if (error.hasOwnProperty('response')) {
                let { message, errors } = error.response.data;
                
                // Unprocessable Entity
                if (errors) {
                    this.$error = message;
                }
            }
        }
    },

    watch: {
        pagination: {
            handler: function() {
                if (this.firstLoad) { 
                    return;
                }

                this.getData(this.dataurl, this.pagination);
            },

            deep: true
        },

        search: function(newval, oldval) {
            if (newval && (newval.length > 0)) {
                if (!this.pagination.hasOwnProperty('filter')) {
                    this.pagination = Object.assign({
                        filter: this.search
                    }, this.pagination);
                } else {
                    this.pagination.filter = this.search;
                }

                this.searchState = true;
            } else {
                if (oldval && (oldval.length > 0)) {
                    this.pagination.filter = null;
                }

                this.searchState = false;
            }            
        },

        selected: function(newval) {
            switch (newval.length) {
                case 0:
                    if (this.searchState) {
                        this.findState = true;
                    }

                    this.record = {};
                    this.stateDefault();
                    break;
                
                case 1:
                    this.findState = false;
                    this.record = this.selected[0];
                    this.stateSelect();
                    break;
            
                default:
                    this.findState = false;
                    this.stateDelete();
                    break;
            }
        }
    }
};

export default mxCrud;