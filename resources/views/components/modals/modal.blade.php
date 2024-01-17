<div id="modal">
    <div id="modal-frame">
        <div id="modal-header">
            <h2 id="modal-title">{{ $title }}</h2>
            <span id="modal-close">&times;</span>
        </div>
        <div id="modal-body">
            {{ $slot }}
        </div>
        <div id="modal-footer">
            @if(isset($cancelButton))
                <button id="modal-cancel">{{ $cancelButton }}</button>
            @endif
            @if(isset($confirmButton))
                <button id="modal-confirm">{{ $confirmButton }}</button>
            @endif
        </div>
    </div>
</div>