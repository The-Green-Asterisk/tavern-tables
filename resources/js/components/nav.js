import { getHtml } from "../services/request";
import FormService from "../services/form";

export default function (el, comp) {
    const formService = new FormService();
    const modal = comp.modal(el);
    
    el.signup.onclick = (ev) => {
        ev.preventDefault();

        getHtml('/signup')
            .then((res) => {
                modal.pop(res, 'signup');

                el.signupForm.onsubmit = (ev) => {
                    ev.preventDefault();
                    formService.submit(el.signupForm)
                        .then(res => {
                            if (res.status === 200) {
                                modal.flash('Account created successfully', '/home');
                            } else {
                                for (let key in res) {
                                    if (key == 'email') {
                                        el.email.classList.add('invalid');
                                        el.email.onfocus = () => {
                                            el.email.classList.remove('invalid');
                                        }

                                        res[key].forEach((error) => {
                                            modal.flash(error);
                                        });
                                    }

                                }
                            }
                        })
                };
            });
    };
}