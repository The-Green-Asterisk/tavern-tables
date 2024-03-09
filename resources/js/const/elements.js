export default class El {
    modalStandby = [];
    body = document.querySelector('body');
    loader = document.querySelector('#loader');
    userId = document.querySelector('#user-id')?.value;
    crfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    signup = document.querySelector('#signup');
    login = document.querySelector('#login');

    initModal = (name) => {
        this.modal = document.querySelectorAll('#modal');
        if (this.modal.length > 1) {
            this.modal.forEach((modal, i) => {
                if (i < this.modal.length - 1) {
                    modal.id = `modal-standby-${i}`;
                    this.modalStandby.push(modal);
                    // this.body.removeChild(modal);
                }
            });
            this.modal = this.modal[this.modal.length - 1];
        } else if (this.modalStandby.length > 0) {
            this.modal = this.modalStandby.shift();
            this.modal.id = 'modal';
            // this.body.appendChild(this.modal);
        } else {
            this.modal = this.modal[0];
        }
        if (!this.modal) return;
        this.modalFrame = this.modal.querySelector('#modal-frame');
        this.modalClose = this.modal.querySelector('#modal-close');
        this.modalCancel = this.modal.querySelector('#modal-cancel');
        this.modalConfirm = this.modal.querySelector('#modal-confirm');

        switch(name) {
            case 'signup':
                this.signupForm = document.querySelector('#signup-form');
                this.email = document.querySelector('#email');
                this.password = document.querySelector('#password');
                this.passwordConfirm = document.querySelector('#password-confirm');
                this.name = document.querySelector('#name');
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