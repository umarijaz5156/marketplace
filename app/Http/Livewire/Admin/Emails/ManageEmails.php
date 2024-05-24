<?php

namespace App\Http\Livewire\Admin\Emails;

use App\Models\Newsletter;
use App\Rules\MaxWords;
use Livewire\Component;
use Livewire\WithPagination;

class ManageEmails extends Component
{
    use WithPagination;

    public $subject;
    public $body;
    public $templateType;

    public $newsLetterId;

    public $deletingId;
    public $checkModal;
    public $deleteConfirmModal = false;
    public $addEmailTemplateModal = false;
    public $updateEmailTemplateModal = false;


    protected function rules()
    {
        return [
            'subject' => ['required', 'string', new MaxWords(10,true)],
            'body' => 'required',
            'templateType' => 'required|unique:newsletters,type,' . $this->templateType
        ];
    }

    // realtime form valdiation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function closeModal($modal)
    {
        $this->$modal = false;
    }

    public function showModal($modal)
    {
        if($modal == 'addEmailTemplateModal') $this->clearForm();
        $this->$modal = true;
    }

    public function clearForm()
    {
        $this->subject = '';
        $this->body = '';
        $this->templateType = '';
    }

    public function showEditModal($id) {
        $this->clearForm();

        $this->newsLetterId = $id;
        $data = Newsletter::where('id',$id)->first();
        $this->subject = $data->subject;
        $this->body = $data->body;
        $this->dispatchBrowserEvent('updateCkEditorBody');
        $this->updateEmailTemplateModal = true;
    }

    // create new template function
    public function createTemplate()
    {
        $this->validate();

        $this->checkModal = 'create';
        $insert = ['subject'=>$this->subject, 'body'=>$this->body, 'type'=>$this->templateType];
        Newsletter::create($insert);
        $this->addEmailTemplateModal = false;; // close modal after insertion
        session()->flash('success' , 'New email template has been added successfully.');
    }

    // update function
    public function updateEmailTemplate()
    {
        $this->validate([
            'subject' => ['required', 'string', 'min:5', new MaxWords(30)],
            'body' => ['required']
        ]);

        $this->checkModal = 'update';

        $data = ['subject' => $this->subject, 'body' => $this->body];

        if(Newsletter::where('id', $this->newsLetterId)->update($data)){
            $this->updateEmailTemplateModal = false; // close modal after updating table
            session()->flash('success' , 'Record Updated Successfully');
            $this->newsLetterId = '';
        }

    }

    // store delete id function
    public function deleteEmailTemplate($id) {
        $this->deletingId = $id;
        $this->deleteConfirmModal = true;
    }

    // delete function
    public function delete() {
        if(Newsletter::find($this->deletingId)->delete())
            session()->flash('success', 'Template deleted successfully.');
        $this->deleteConfirmModal = false;
    }

    public function render()
    {
        return view('livewire.admin.emails.manage-emails',[
            'templates' => Newsletter::latest()->paginate(15)
        ]);
    }
}

 