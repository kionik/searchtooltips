import {Ykajax} from "./ykajax";
import Vue from 'vue';

new Vue({
    el: '#vueApp',
    data: {
        searchResults: [],
        search: '',
        clickFlag: false
    },
    watch: {
        search: function () {
            this.searchResults = [];
            if (!this.clickFlag) {
                if (this.search.length > 2) {
                    let _self = this;
                    new Ykajax().post('/', {text: this.search}, function (jsonResponse) {
                        _self.searchResults = JSON.parse(jsonResponse);
                    });
                }
            }
            this.clickFlag = false;
        }
    },
    methods: {
        setResult: function (searchResult) {
            this.search = searchResult;
            this.searchResults = [];
            this.clickFlag = true;
        }
    }
});
