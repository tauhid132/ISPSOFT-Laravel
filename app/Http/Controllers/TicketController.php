<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Employee;
use App\Models\TicketComment;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RahulHaque\AdnSms\Facades\AdnSms;

class TicketController extends Controller
{
    public function viewAllTickets(){
        return view('admin.tickets.all-tickets',[
            'ticket_types' => TicketType::all(),
            'employees' => Employee::all()
        ]);
    }
    public function getTickets(Request $request){
        $ticket_type = request('ticket_type');
        $status = request('status');
        $data = Ticket::with('user','type');
        if($ticket_type != 'all'){
            $data = $data->where('ticket_type_id', $ticket_type);
        }
        if($status != 'all'){
            $data = $data->where('status', $status);
        }
       
        $data = $data->latest()->get();
        return datatables($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $btn = '<a href="'.route('trackTicket',$row->id).'"><i class="fa fa-external-link text-info m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Track Ticket"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-edit text-success edit_ticket m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Ticket"></i></a>';
            $btn = $btn.'<a><i id="'.$row->id.'" class="fa fa-trash text-danger delete_ticket m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Ticket"></i></a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            if($row->status == 0){
                $btn = '<span class="badge bg-primary">Created</span>';
            }else if($row->status == 1){
                $btn = '<span class="badge bg-warning">Processing</span>';
            }else if($row->status == 2){
                $btn = '<span class="badge bg-success">Closed</span>';
            }else if($row->status == 4){
                $btn = '<span class="badge bg-danger">Aborted</span>';
            }
            return $btn;
        })
        ->addColumn('priority', function($row){
            if($row->priority == 0){
                $btn = '<span class="badge bg-info">Low</span>';
            }else if($row->priority == 1){
                $btn = '<span class="badge bg-warning">Medium</span>';
            }else if($row->priority == 2){
                $btn = '<span class="badge bg-danger">High</span>';
            }
            return $btn;
        })
        ->addColumn('created_at', function($row){
            return $row->created_at->format('l, j F, Y h:i A');
        })
        ->addColumn('user_id', function($row){
            if($row->user_id == null){
                return '';
            }else{
                return $row->user->username;
            }
        })
        ->rawColumns(['action' => 'action','status' => 'status','user_id' => 'user_id', 'priority' => 'priority'])
        ->make(true);
    }

    public function addUpdateTicket(Request $request){
        if($request->username == null){
            $user_id = null;
        }else{
            $user = User::where('username', $request->username)->first();
            $user_id = $user->id;
        }
        
        if(empty($request->id)){
            $ticket = Ticket::create([
                'user_id' => $user_id,
                'ticket_type_id' => $request->ticket_type,
                'ticket_description' => $request->ticket_description,
                'created_by_id' => Auth::guard('admin')->user()->id,
                'priority' => $request->priority,                
            ]);
            $ticket->assigned_executives()->attach($request->assigned_executives);
            if($request->sendConfirmationSms){
                $response = AdnSms::to($ticket->user->mobile_no)
                ->message("Dear user, Your ticket has been created. Ticket No-$ticket->id - ATS Technology ")
                ->send();
            }
            return 'Ticket Added Successfully!';
        }else{
            $ticket = Ticket::where('id', $request->id)->first();
            $ticket->update([
                'user_id' => $user->id,
                'ticket_type_id' => $request->ticket_type,
                'ticket_description' => $request->ticket_description,
                'priority' => $request->priority,
                'created_by_id' => Auth::guard('admin')->user()->id,
            ]);
            $ticket->assigned_executives()->sync($request->assigned_executives);
            return 'Ticket updated Successfully!';
        }
    }
    public function fetchTicketSingle(Request $request){
        $ticket = Ticket::with('type','user','assigned_executives')->where('id', $request->id)->first();
        return response()->json($ticket);
    }
    public function deleteTicketSingle(Request $request){
        Ticket::destroy($request->id);
    }
    public function trackTicket($id){
        return view('admin.tickets.track-ticket',[
            'ticket' => Ticket::find($id),
            'employees' => Employee::all()
        ]);
    }
    public function startProcessingTicket($id){
        $ticket = Ticket::find($id);
        $ticket->update([
            'status' => 1,
            'start_processing_at' => Carbon::now(),
            'start_processing_by_id' => Auth::guard('admin')->user()->id,
        ]);
        return back();
    }
    public function closeTicket($id){
        $ticket = Ticket::find($id);
        $ticket->update([
            'status' => 2,
            'closed_at' => Carbon::now(),
            'closed_by_id' => Auth::guard('admin')->user()->id,
        ]);
        return back();
    }

    public function assignExecutive(Request $request, $id){
        $ticket = Ticket::find($id);
        $ticket->assigned_executives()->sync($request->assigned_executives);
        return back();
    }

    public function addCommentTicket(Request $request, $ticket_id){
        $ticket = Ticket::find($ticket_id);
        TicketComment::create([
            'ticket_id' => $ticket_id,
            'comment' => $request->comment,
            'comment_by' => Auth::guard('admin')->user()->id,
        ]);
        return back();
    }
    public function deleteCommentTicket($ticket_id, $comment_id){
        TicketComment::find($comment_id)->delete();
        return back();
    }
}
