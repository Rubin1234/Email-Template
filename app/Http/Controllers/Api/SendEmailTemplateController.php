<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\EmailTemplateRepository;
use App\Repositories\EmailTemplateRepositoryEloquent;
use App\Repositories\MailVariableRepository;
use App\Repositories\MailVariableRepositoryEloquent;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailTemplate;
use App\Entities\EmailTemplate as EmailTemplateModel;
use Str;

class SendEmailTemplateController extends Controller
{

    protected $repository;
    protected $mailVariableRepository;

    private $templateTitle;
    private $templateBody;

    private $compiledBodyTemplate = "";

    public function __construct(EmailTemplateRepositoryEloquent $emailTemplateRepository, MailVariableRepositoryEloquent  $mailVariableRepository)
    {

        $this->repository = $emailTemplateRepository;
        $this->mailVariableRepository = $mailVariableRepository;
    }

    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'field' => 'bail|required|array|min:1',
            'value' => 'bail|required|array|min:1',
            'field.*' => 'bail|required|string',
            'value.*' => 'bail|required|string',
            'template_key' => 'bail|required|string',
            'receiving_email_address' => 'bail|required|email|string'
        ]);

        $templateDetail = $this->repository->where('template_key', $validated['template_key'])->firstOrFail();
        $this->templateTitle = $templateDetail->title;
        $this->templateBody = $templateDetail->body;

        $this->compiledBodyTemplate = $this->templateBody;
        $this->process($request);

        $response = Mail::to($validated['receiving_email_address'])
            ->send(new EmailTemplate($this->templateTitle, $this->compiledBodyTemplate));
    }

    public function process($request)
    {
        foreach ($request->field as $key => $field) {
            $this->compiledBodyTemplate = str_replace('[' . $field . ']', $request->value[$key], $this->compiledBodyTemplate);
        }
    }
}
