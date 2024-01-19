@extends('layout')
@section('content')
<x-nav />

Tavern Tables is an app that allows you to sign up for and schedule tabletop games. It uses the concept of a "tavern owner" that can create multiple tables, assign game masters to them and invite players to join. It's perfect for facilities or organizations that want to host multiple games at once, but it's also great for singular games that want to keep track of their players and schedules.

<div id="join-buttons">
    <button id="tavern-keeper-join">Join as Tavern Keeper</button>
    <button id="player-join">Join as Player</button>
</div>
@endsection