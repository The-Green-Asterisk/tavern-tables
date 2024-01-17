export default function (el) {
    const close = () => {
        if (el.modal != null) {
            return new Promise(resolve => {
                modal.remove();
                document.removeEventListener('click', clickOutside);
                resolve();
            });
        }
    };
    const clickOutside = (ev) => {
        ev.stopImmediatePropagation();
        if ((el.modalFrame != null && !el.modalFrame.contains(ev.target)) && el.loader.style.display === 'none') {
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

    async function pop(res) {
        function buildModal(data) {
            let incomingModal = document.createElement('div');
            incomingModal.innerHTML = data;
            el.body.appendChild(incomingModal.firstChild);
            document.onclick = e => { clickOutside(e) };
            el.initModal();
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