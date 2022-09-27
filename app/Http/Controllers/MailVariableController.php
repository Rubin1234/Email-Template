<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MailVariableRepository;
use App\Repositories\MailVariableRepositoryEloquent;

class MailVariableController extends Controller
{
    /**
     * @var MailVariableRepository
     */

    protected $repository;

    public function __construct(MailVariableRepositoryEloquent $mailVariableRepository)
    {

        $this->repository = $mailVariableRepository;
    }

    public function index()
    {
        $mailVariableLists = $this->repository->all();
        return view('mail-variable\index', compact('mailVariableLists'));
    }

    public function create()
    {
        return view('mail-variable\edit');
    }

    public function updateOrCreate(Request $request, $id)
    {
        if ($id && $id == "new") {
            $validated = $request->validate([
                'variable_key' => 'required|unique:mail_variables,variable_key',
                'variable_value' => 'required|string',
            ]);

            $this->repository->create($validated);
            return redirect()->route('mail-variable.index')->with('message', 'Mail Variable Created Successfully!');
        }

        dd('update');

        //return redirect()->route('mail-variable.index')->with('Mail Variable Create Successfully.');
    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return redirect()->route('mail-variable.index')->with('message', 'Mail Variable Deleted Successfully!');
    }
}
