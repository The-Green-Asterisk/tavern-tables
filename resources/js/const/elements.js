export default class El {
    body = document.querySelector('body');
    loader = document.querySelector('#loader');
    userId = document.querySelector('#user-id')?.value;
    crfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    bar = document.querySelector('#bar');
    tables = document.querySelectorAll('.table');
    
    constructor() {
        //
    }
}