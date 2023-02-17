<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Resources\TicketResource;
use App\Http\Requests\TicketRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function __construct() {
        $this->middleware('jwt_auth');
    }
    public function index()
    {
        return response()->json(TicketResource::collection(Ticket::latest()->get()), 200);
    }
    public function create(TicketRequest $request)
    {
        $ticket_images_path = store_image($request, 'image', 'ticket_images');
        $data = $request->all();
        $data['image'] = $ticket_images_path;
        return response()->json(new TicketResource(Ticket::create($data)), 201);
    }
    public function show(Ticket $ticket)
    {
        return response()->json(new TicketResource($ticket), 200);
    }
    public function update(Ticket $ticket, TicketRequest $request)
    {
        $ticket->update($request->all());
        return response()->json(new TicketResource($ticket), 200);
    }
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response([], 204);
    }
    public function update_pic(Ticket $ticket, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $ticket_images_path = store_image($request, 'image', 'ticket_images');
        $ticket->update([
            "image" => $ticket_images_path
        ]);
        return response()->json(new TicketResource($ticket), 200);
    }
}
