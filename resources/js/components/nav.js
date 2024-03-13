import { getHtml } from "../services/request";
import FormService from "../services/form";

export default function (el, comp) {
    const formService = new FormService();
    const modal = comp.modal(el);
    
    if (el.signup)
        el.signup.onclick = (ev) => {
            ev.preventDefault();

            getHtml('/signup')
                .then((res) => {
                    modal.pop(res, 'signup');
                    el.roleRadioButtons.forEach((radio) => {
                        radio.onclick = () => {
                            if (radio.value !== 'TK') {
                                el.tavernCodeBox.style.display = 'block';
                            } else {
                                el.tavernCodeBox.style.display = 'none';
                            }
                        }
                    });

                    el.signupForm.onsubmit = (ev) => {
                        ev.preventDefault();
                        formService.submit(el.signupForm)
                            .then(res => {
                                if (res.status === 200) {
                                    modal.flash('Account created successfully', '/home');
                                } else {
                                    for (let key in res) {
                                        if (key == 'name') {
                                            el.name.classList.add('invalid');
                                            el.name.onfocus = () => {
                                                el.name.classList.remove('invalid');
                                            }

                                            res[key].forEach((error) => {
                                                modal.flash(error);
                                            });
                                        }
                                        if (key == 'email') {
                                            el.email.classList.add('invalid');
                                            el.email.onfocus = () => {
                                                el.email.classList.remove('invalid');
                                            }

                                            res[key].forEach((error) => {
                                                modal.flash(error);
                                            });
                                        }
                                        if (key == 'password') {
                                            el.password.classList.add('invalid');
                                            el.password.onfocus = () => {
                                                el.password.classList.remove('invalid');
                                            }

                                            res[key].forEach((error) => {
                                                modal.flash(error);
                                            });
                                        }
                                        if (key == 'error') {
                                            modal.flash(res[key]);
                                        }
                                    }
                                }
                            })
                    };
                });
        };

    if (el.login)
        el.login.onclick = (ev) => {
            ev.preventDefault();

            getHtml('/login')
                .then((res) => {
                    modal.pop(res, 'login');
                    el.loginForm.onsubmit = (ev) => {
                        ev.preventDefault();
                        formService.submit(el.loginForm)
                            .then(res => {
                                if (res.status === 200) {
                                    modal.flash('Login successful', '/home');
                                } else {
                                    if (res.error) {
                                        modal.flash(res.error);
                                    }
                                }
                            });
                    };
                });
        };
}