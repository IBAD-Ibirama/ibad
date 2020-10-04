try {
    window.Chartisan = require('@chartisan/echarts').Chartisan;
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('jquery-mask-plugin');
    require('bootstrap');
    require('lightbox2');
} catch (e) {}