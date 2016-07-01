<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Mail;

class MailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inbox(Request $request, $tab = 'inbox')
    {
        if ($request->ajax()) {

            $per_page = intval($request->get('per_page'), 10);

            switch ($tab) {
                case 'inbox':
                    $mails = Auth::user()->inbox();
                    break;
                case 'sent':
                    $mails = Auth::user()->sent();
                    break;
                case 'trash':
                    $mails = Auth::user()->inbox()->onlyTrashed();
                    break;
            }

            // Sort
            $sortBy = $request->get('sort', 'date');

            if ($sortBy == 'date') {
                $sortBy = 'created_at';
            }

            $mails = $mails->orderBy($sortBy, ($sortBy == 'created_at') ? 'desc' : 'asc');

            $mail = $mails->paginate($per_page);

            return $mails->get();
        }


        return view('inbox', [
            'tab' => $tab,
        ]);
    }

    public function read(Mail $mail)
    {
        if ($mail->from_id != Auth::user()->id) {
            $mail->read = true;
            $mail->save();
        }

        return view('read', [
            'mail' => $mail
        ]);
    }

    public function delete(Mail $mail)
    {
        $mail->delete();
        return redirect('/inbox');
    }

    public function profile()
    {
        return view('profile');

    }

    public function profilePost(Request $request)
    {

        $u = Auth::user();

        if ($request->has('name'))
            $u->name = $request->get('name');

        if ($request->has('password'))
            $u->name = Hash::make($request->get('password'));

        if ($request->hasFile('avatar')) {

            $request->file('avatar')->move('upload/avatar', $u->id . '.png');

        }
        
        $u->save();

        return redirect('/profile')->with(['message' => 'Profile Saved!']);

    }

    public function contacts()
    {

        // All Users
        $b = @Auth::user()->contact_ids;
        if ($b == null)
            $b = [];
        $b[] = Auth::user()->id;
        $all_users = User::whereNotIn('_id', $b)->get();

        // My Contacts
        $contacts = Auth::user()->contacts;

        return view('contacts', [

            'all_users' => $all_users,
            'contacts' => $contacts,

        ]);
    }


    public function add(User $user)
    {

        Auth::user()->contacts()->attach($user);
        return redirect('/contacts');
    }


    public function reject(User $user)
    {

        Auth::user()->contacts()->detach($user->id);
        return redirect('/contacts');
    }

    public function compose(Request $request)
    {
        $to_email = $request->get('to');
        $subject = $request->get('subject');
        $text = $request->get('text');

        $from = Auth::user();
        $to = User::where('email', $to_email)->first();

        if ($to == null) {
            return redirect('/inbox')->with([
                'message' => 'Mail Not Found'
            ]);
        }

        if (!in_array($to->id, Auth::user()->contact_ids)) {
            return redirect('/inbox')->with([
                'message' => 'Contact is not in your contacts!!!'
            ]);
        }

        $mail = new Mail();

        $mail->subject = $subject;
        $mail->text = $text;

        $mail->from_id = $from->id;
        $mail->to_id = $to->id;

        $mail->save();

        return redirect()->back();
    }


}
