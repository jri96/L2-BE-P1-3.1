<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GebruikerBeheerController extends Controller
{
    /**
     * Toont alle accounts met hun rol. Alleen voor de Administrator-rol.
     */
    public function index(): View
    {
        return view('gebruikers.beheer', [
            'gebruikers' => User::orderBy('name')->get(),
            'rollen' => User::rollen(),
        ]);
    }

    /**
     * Wijzigt de rol van een ander account.
     *
     * De eigen rol blijft ongewijzigd, zodat een administrator zichzelf
     * niet per ongeluk de beheerdersrechten afneemt.
     */
    public function wijzigRol(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'rolename' => ['required', 'string', Rule::in(User::rollen())],
        ]);

        if ($user->is($request->user())) {
            return back()->withErrors([
                'rolename' => __('Je kunt je eigen rol niet wijzigen.'),
            ]);
        }

        $user->update(['rolename' => $data['rolename']]);

        return redirect()
            ->route('gebruiker.index')
            ->with('status', __('De rol is bijgewerkt.'));
    }
}
