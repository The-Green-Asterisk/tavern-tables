@extends('layout')
<div id="bar">
    This is the waiting area
</div>
<div class="table">
    <div class="gm-label">
        <p>Game Master:</p>
        <p>{{ isset($gm) ? $gm : 'Unknown' }}</p>
    </div>
    @if(isset($players))
        @foreach($players as $player)
            <div class="player">
                <p>{{ $player->name }}</p>
                <select class="character-names">
                    <option value="0">None</option>
                    @foreach($player->character_names as $character_name)
                        <option value="{{ $character_name }}" selected="{{ $character_name->selected }}">{{ $character_name }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
    @endif
    <input type="text" id="add-player" placeholder="Add player">
</div>