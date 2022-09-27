<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmailTemplateRepository;
use App\Repositories\EmailTemplateRepositoryEloquent;
use App\Repositories\MailVariableRepositoryEloquent;
use Str;

class EmailTemplateController extends Controller
{
    /**
     * @var EmailTemplateRepository
     */

    protected $repository;

    public function __construct(EmailTemplateRepositoryEloquent $emailTemplateRepository, MailVariableRepositoryEloquent $mailVariableRepository)
    {

        $this->repository = $emailTemplateRepository;
        $this->mailVariableRepository = $mailVariableRepository;
    }

    public function index()
    {
        $emailTemplateLists = $this->repository->all();

        return view('email-template\index', compact('emailTemplateLists'));
    }

    public function create()
    {
        $mailVariables = $this->mailVariableRepository->all();
        return view('email-template\edit', compact('mailVariables'));
    }

    public function updateOrCreate(Request $request, $id)
    {

        if ($id && $id == "new") {
            $validated = $request->validate([
                'email_title' => 'required|unique:email_templates,title',
                'email_content' => 'required|string',
            ]);

            $this->repository->create([
                'title' => $validated['email_title'],
                'body' => $validated['email_content'],
                'template_key' => Str::slug($validated['email_title'])
            ]);

            return redirect()->route('mail-template.index')->with('message', 'Email Template Created Successfully!');
        }

        dd('update');

        //return redirect()->route('mail-variable.index')->with('Mail Variable Create Successfully.');
    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return redirect()->route('mail-template.index')->with('message', 'Email Template Deleted Successfully!');
    }
}
