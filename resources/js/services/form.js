import { post } from "./request";

export default class FormService {
    async submit(form) {
        const formData = new FormData(form);
        const url = form.getAttribute('action');

        //validate form
        let valid = true;
        form.querySelectorAll('input').forEach((input) => {
            if (input.getAttribute('required') && !input.value) {
                valid = false;
                input.classList.add('invalid');
                input.onfocus = () => {
                    input.classList.remove('invalid');
                }
            }
        });
        if (!valid) return;

        return post(url, Object.fromEntries(formData.entries()));
    }
}