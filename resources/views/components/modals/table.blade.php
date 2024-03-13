<x-modals.modal>
    <x-slot:title>New Table</x-slot:title>
    <form action="{{ route('create-table', $tavern->id) }}" id="create-table-form">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="ruleset_id">Ruleset</label>
            <select id="ruleset" name="ruleset_id" required>
                <option value="0">Select a ruleset</option>
                @foreach ($rulesets as $ruleset)
                    <option value="{{ $ruleset->id }}">{{ $ruleset->name }}</option>
                @endforeach
            </select>
        </div>
        @if($gms->count() > 0)
            <div class="form-group">
                <label for="gm_id">Game Master</label>
                <select id="gm_id" name="gm_id" required>
                    <option value="0">Select a game master</option>
                    @foreach ($gms as $gm)
                        <option value="{{ $gm->id }}">{{ $gm->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="datetime-local" id="start_time" name="start_time" required>

        <div class="form-group">
            <button type="submit">Create Table</button>
        </div>
    </form>
</x-modals.modal>