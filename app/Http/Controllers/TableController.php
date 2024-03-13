<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tavern;
use App\Models\Table;
use App\Models\User;
use App\Models\Person;
use App\Models\Ruleset;

class TableController extends Controller
{
    public function createTableForm(Tavern $tavern)
    {
        return view('components.modals.table', [
            'tavern' => $tavern,
            'rulesets' => Ruleset::get(),
            'gms' => $tavern->users()->get()
        ]);
    }

    public function create(Request $request, Tavern $tavern)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'name' => ['required', 'max:255'],
            'ruleset_id' => ['exists:rulesets,id'],
            'gm_id' => ['exists:users,id'],
            'start_time' => ['date']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 403);
        }

        $tavern->tables()->create([
            'name' => $data['name'],
            'ruleset_id' => $data['ruleset_id'],
            'gm_id' => $data['gm_id'],
            'start_time' => $data['start_time']
        ]);

        return response()->json(['success' => 'Table created'], 200);
    }

    public function addPlayer(Request $request)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'max:255'],
            'table_id' => ['exists:tables,id']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 403);
        }

        $table = Table::find($data['table_id']);
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            $table->users()->attach($user->id);
            return response()->json(['success' => 'User added to table'], 200);
        } else {
            $person = Person::where('email', $data['email'])->first();
            if ($person) {
                $table->people()->attach($person->id);
                return response()->json(['success' => 'Person added to table'], 200);
            } else {
                return response()->json(['error' => 'Person not found. Invite them?'], 403);
            }
        }
    }

    public function removePerson(Request $request, Tavern $tavern)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'max:255'],
            'table_id' => ['exists:tables,id']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 403);
        }

        $table = $tavern->tables()->find($data['table_id']);
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            $table->users()->detach($user->id);
        } else {
            $person = Person::where('email', $data['email'])->first();
            if ($person) {
                $table->people()->detach($person->id);
            }
        }

        return response()->json(['success' => 'Person removed from table'], 200);
    }

    public function addDm(Request $request, Tavern $tavern)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'max:255', 'exists:users,email'],
            'table_id' => ['exists:tables,id']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 403);
        }

        $table = $tavern->tables()->find($data['table_id']);
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            $table->update(['dm_id' => $user->id]);
        }

        return response()->json(['success' => 'DM added to table'], 200);
    }

    public function removeDm(Request $request, Tavern $tavern)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'table_id' => ['exists:tables,id']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 403);
        }

        $table = $tavern->tables()->find($data['table_id']);
        $table->update(['dm_id' => null]);

        return response()->json(['success' => 'DM removed from table'], 200);
    }

    public function delete(Request $request, Tavern $tavern)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'table_id' => ['exists:tables,id']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 403);
        }

        $table = $tavern->tables()->find($data['table_id']);
        $table->delete();

        return response()->json(['success' => 'Table deleted'], 200);
    }
}
