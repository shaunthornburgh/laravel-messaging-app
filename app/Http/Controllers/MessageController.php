<?php

namespace App\Http\Controllers;

use App\Events\NewMessageCreated;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class MessageController extends Controller
{
    /**
     * @param User $user
     * @return Response
     */
    public function index(User $user): Response
    {
        $messages = Message::where( function($query) use ($user) {
            $query->where('from', auth()->id());
            $query->where('to', $user->id);
        })
            ->orWhere( function($query) use($user) {
                $query->where('from', $user->id);
                $query->where('to', auth()->id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return inertia(
            'Dashboard',
            [
                'messages' => $messages,
                'users' => User::whereNot('id', auth()->user()->id)->get(),
                'to' => $user
            ]
        );
    }

    /**
     * @param StoreMessageRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMessageRequest $request): RedirectResponse
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->validated('to'),
            'body' => $request->validated('body')
        ]);

        broadcast(new NewMessageCreated($message))->toOthers();

        return redirect()->back();
    }
}
