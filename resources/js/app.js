import './bootstrap';

import toastr from 'toastr';

window.toastr = toastr;
toastr.options = {
    "closeButton": true,
    "timeOut": "7000",
    "extendedTimeOut": "10000",
};

