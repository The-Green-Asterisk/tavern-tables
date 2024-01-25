export default function (el) {
    const close = () => {
        el.initModal();
        if (!!el.modal) {
            return new Promise(resolve => {
                modal.remove();
                document.removeEventListener('click', clickOutside);
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
    document.addEventListener('click', clickOutside);

    const flash = (res, goToAfter) => {
        res.text()
            .then((data) => {
                let modal = document.createElement('div')
                modal.innerHTML = data;
                el.body.appendChild(modal.firstChild);
                setTimeout(() => {
                    close();
                    if (goToAfter) window.location.href = goToAfter;
                }, 3000);
            });
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
    
    return {
        clickOutside,
        close,
        flash,
        pop
    }
}