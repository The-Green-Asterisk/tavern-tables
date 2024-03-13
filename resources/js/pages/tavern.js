import FormService from "../services/form";
import { getHtml, post } from "../services/request";

export default function (el, comp) {
    comp.nav(el, comp);

    const formService = new FormService();
    const modal = comp.modal(el);

    el.createTableButton.onclick = (ev) => {
        ev.preventDefault();

        getHtml(`/tavern/${el.tavernId}/table/create`)
            .then((res) => {
                modal.pop(res, 'create-table');
                el.createTableForm.onsubmit = (ev) => {
                    ev.preventDefault();
                    formService.submit(el.createTableForm)
                        .then(res => {
                            if (res.status === 200) {
                                modal.flash('Table created successfully', `/tavern/${el.tavernId}`);
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
                                }
                            }
                        });
                };
            });
    };

    if (el.addPlayerBoxes) {
        [...el.addPlayerBoxes].forEach((box) => {
            const addPlayerInput = box.querySelector('.add-player-input');
            const addPlayerTableId = box.querySelector('.add-player-table-id');

            addPlayerInput.onkeydown = (ev) => {
                if (ev.key === 'Enter') {
                    ev.preventDefault();
                    
                    post(`/table/add-player`, { 
                        email: addPlayerInput.value,
                        table_id: addPlayerTableId.value
                    })
                        .then(res => {
                            if (res.success) {
                                modal.flash(res.success, `/tavern/${el.tavernId}`);
                            } else {
                                modal.flash(res.error);
                            }
                        });
                }
            };
        });
    }
}