<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    public function index()
    {
        //get all the emails
        $values = Email::all();
        return view('backend.mail.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.mail.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name'  =>  'required',
                'subject'   =>  'required|min:5',
                'description'   =>  'required'
            ]
        );
        //check if the email is into the database
        $check = Email::where('name','=',$request['name'])->first();
        if($check != "")
        {
            return back()->with('error','Un email cu acest nume exista deja');
        }
        //if all is good, save the information into the database
        $model = new Email();
        $model->name = $request['name'];
        $model->description = $request['description'];
        $model->subject = $request['subject'];
        $model->type = 'TBD';


        $model->save();

        return redirect()->route('email.index')->with('success', 'Email-ul a fost adaugat cu succes');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //get the email
        $mail = Email::find($id);


        return view('backend.mail.edit')->with(
            [
                'value' =>  $mail,

            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'subject'   =>  'required|min:5',
                'description'   =>  'required',
                'type' => 'nullable|string',
            ]
        );


        //if all is good, save the information into the database
        $model = Email::find($id);
        $model->description = $request['description'];
        $model->subject = $request['subject'];
        $model->type = $request['type'];

        $model->save();

        return redirect()->route('email.index')->with('success','Email-ul a fost modificat cu success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test(int $id): array
    {
        $request = request();
//       auth()->user();
        return [];
    }
}
