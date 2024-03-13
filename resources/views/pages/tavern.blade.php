@extends('layout')
<input type="hidden" id="tavern-id" value="{{ $tavern->id ?? '' }}">
<x-nav :taverns="$taverns" />
<div id="bar">
    This is the waiting area
    @foreach($tavern->waitingPeople() as $person)
        <div class="person">
            <p>{{ $person->name }}</p>
        </div>
    @endforeach
</div>
@foreach($tavern->tables as $table)
    <div class="table">
        <div class="gm-label">
            <p>Game Master:</p>
            <p>{{ isset($table->gm) ? $table->gm->name : 'Unknown' }}</p>
        </div>
        @if(isset($table->players))
            @foreach($table->players as $player)
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
        <div class="add-player-box">
            <input type="email" class="add-player-input" placeholder="Enter email to add player">
            <input hidden class="add-player-table-id" value="{{ $table->id }}">
        </div>
    </div>
@endforeach
    <div id="no-tables">
        @if($tavern->tables->count() == 0)
            <p>There are no tables in this tavern yet.</p>
        @endif
        <button id="create-table-button">Create Table</button>
    </div>