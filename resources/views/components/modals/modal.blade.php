<div id="modal" class="modal">
    <div id="modal-frame" class="modal-frame">
        <div id="modal-header" class="modal-header">
            <h2 id="modal-title" class="modal-title">{{ $title }}</h2>
            <span id="modal-close" class="modal-close">&times;</span>
        </div>
        <div id="modal-body" class="modal-body">
            {{ $slot }}
        </div>
        <div id="modal-footer" class="modal-footer">
            @if(isset($cancelButton))
                <button id="modal-cancel" class="modal-cancel">{{ $cancelButton }}</button>
            @endif
            @if(isset($confirmButton))
                <button id="modal-confirm" class="modal-confirm">{{ $confirmButton }}</button>
            @endif
        </div>
    </div>
</div>