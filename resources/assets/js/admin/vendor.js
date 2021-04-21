window._ = require('lodash');
window.Popper = require('popper.js').default;


try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    window.select2 = require('select2');
    require('../../components/sb-admin/sb-admin');
} catch (e) {}