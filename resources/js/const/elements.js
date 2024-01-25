export default class El {
    body = document.querySelector('body');
    loader = document.querySelector('#loader');
    userId = document.querySelector('#user-id')?.value;
    crfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    signup = document.querySelector('#signup');
    login = document.querySelector('#login');

    initModal = (name) => {
        this.modal = document.querySelector('#modal');
        this.modalFrame = document.querySelector('#modal-frame');
        this.modalClose = document.querySelector('#modal-close');
        this.modalCancel = document.querySelector('#modal-cancel');
        this.modalConfirm = document.querySelector('#modal-confirm');

        switch(name) {
            case 'signup':
                this.signupForm = document.querySelector('#signup-form');
                break;
            default:
                break;
        }
    }

    bar = document.querySelector('#bar');
    tables = document.querySelectorAll('.table');
    
    constructor() {
        //
    }
}