export default function (el) {
    const close = () => {
        if (!!el.modal) {
            return new Promise(resolve => {
                modal.remove();
                el.initModal();
                resolve();
            });
        }
    };
    const clickOutside = (ev) => {
        el.initModal();
        ev.stopImmediatePropagation();
        if ((!!el.modalFrame && !el.modalFrame.contains(ev.target)) && el.loader.style.display === 'none') {
            close();
        }
    };

    const flash = (res, goToAfter) => {
        if (res.status) {
            res.text()
                .then((data) => {
                    document.onclick = null;
                    let modal = document.createElement('div')
                    modal.innerHTML = data;
                    el.body.appendChild(modal.firstChild);
                    el.initModal();
                    setTimeout(() => {
                        close();
                        if (goToAfter) window.location.href = goToAfter;
                        if (el.modal) document.onclick = e => { clickOutside(e) };
                    }, 3000);
                });
        } else if (typeof res === 'string') {
            document.onclick = null;
            let modal = blankModal(res);
            el.body.appendChild(modal);
            el.initModal();
            setTimeout(() => {
                close();
                if (goToAfter) window.location.href = goToAfter;
                if (el.modal) document.onclick = e => { clickOutside(e) };
            }, 3000);
        }
    }

    async function pop(res, name) {
        function buildModal(data) {
            let incomingModal = document.createElement('div');
            incomingModal.innerHTML = data;
            el.body.appendChild(incomingModal.firstChild);
            document.onclick = e => { clickOutside(e) };
            el.initModal(name);
            if (el.modalClose) el.modalClose.onclick = () => { close() };
        }
        document.activeElement.blur();

        if (res.status === 200) {
            await res.text()
                .then((data) => {
                    buildModal(data);
                });
        } else if (typeof res === 'string') {
            buildModal(res);
        }
    }

    function blankModal(text) {
        let modal = document.createElement('div');
        modal.id = 'modal';
        modal.classList.add('modal');
        modal.innerHTML = `
            <div id="modal-frame" class="modal-frame">
                <div="modal-body" class="modal-body">
                    <p>${text}</p>
                </div=>
            </div>
        `;

        return modal;
    }
    
    return {
        clickOutside,
        close,
        flash,
        pop
    }
}