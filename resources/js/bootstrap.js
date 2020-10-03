window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('jquery-mask-plugin');
    require('bootstrap');
} catch (e) {}

window.Chartisan = require('@chartisan/echarts').Chartisan;

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';