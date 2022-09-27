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
    /**
     * @var MailVariableRepository
     */

    protected $repository;
    protected $mailVariableRepository;

    private $templateTitle;
    private $templateBody;


    /**
     * @var $templateVariables
     */
    private $templateVariables = [];

    private $compiledBodyTemplate = "";


    public function __construct(EmailTemplateRepositoryEloquent $emailTemplateRepository, MailVariableRepositoryEloquent  $mailVariableRepository)
    {

        $this->repository = $emailTemplateRepository;
        $this->mailVariableRepository = $mailVariableRepository;

        // $this->templateBody = $this->repository->first()->body;
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



    // public function process($mailVariable)
    // {
    //     $matches = $this->getMatchedTemplateVariables();

    //     if ($matches && count($matches) > 0) {
    //         $this->templateVariables = $this->getParsedTemplateVariables($matches, $mailVariable);
    //     }

    //     $compiledString = $this->replaceKeysWithValues();
    //     // dd(11, $compiledString);
    // }

    // private function getMatchedTemplateVariables()
    // {
    //     $regex = '/\[\w.+?\]/m';

    //     preg_match_all($regex, $this->templateBody, $matches, PREG_SET_ORDER);
    //     return $matches;
    // }

    // private function getParsedTemplateVariables($matches, $mailVariable)
    // {


    //     $templateVariables = [];
    //     foreach ($matches as $match) {



    //         $mailVariable =  $this->mailVariableRepository->where('variable_key', $match[0])->first();


    //         if ($mailVariable) {
    //             $templateVariables[$mailVariable->variable_key] = $this->getRealVariableValue($mailVariable->variable_key, $mailVariable->variable_value);
    //         }

    //         dd($templateVariables);
    //     }

    //     return $templateVariables;
    // }
    // private function getRealVariableValue($variableKey, $variableValue)
    // {
    //     // if variable value not empty return it
    //     if ($variableValue) {
    //         return $variableValue;
    //     }
    //     // else look for this in the reserved variables below
    //     if (array_key_exists($variableKey, $this->reservedVariableKeys())) {
    //         return $this->reservedVariableKeys()[$variableKey];
    //     }
    //     // else if the variable key is a form input
    //     if (Str::contains($variableKey, "INPUT")) {
    //         return $this->getInputTypeVariable($variableKey, $variableValue);
    //     }
    //     // else if the key is a dynamic data variable
    //     if (Str::contains($variableKey, "DYNAMIC")) {
    //         return $this->getDynamicTypeVariable($variableKey, $variableValue);
    //     }
    //     // otherwise return the value as is
    //     return $variableValue;
    // }

    // private function replaceKeysWithValues()
    // {
    //     $emailTemplateData = $this->repository->first();
    //     return str_replace(array_keys($this->templateVariables), array_values($this->templateVariables), $this->templateBody);
    // }
}
