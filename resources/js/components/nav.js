import { getHtml } from "../services/request";

export default function (el, comp) {
    const modal = comp.modal(el);
    
    el.signup.onclick = (ev) => {
        ev.preventDefault();

        getHtml('/signup')
            .then((res) => {
                modal.pop(res);
            });
    };
}